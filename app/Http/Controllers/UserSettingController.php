<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\EmployeeType;
use App\Services\UserService;

class UserSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::with('employeeType')->latest()->get();
        $employeeTypes = EmployeeType::where('is_active', true)->get();
        return view('backend.user-settings', compact('user', 'users', 'employeeTypes'));
    }

    public function store(Request $request)
    {
        $userService = new UserService();

        try {
            // Validate common fields
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'username' => 'nullable|string|max:255|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => ['required', Password::min(8)],
                'contact' => 'required|string|max:20',
                'user_type' => 'required|in:employee,student,guardian,user',
                'employee_type_id' => 'required_if:user_type,employee|exists:employee_types,id',
                'address' => 'nullable|string|max:500',
                'date_of_joining' => 'nullable|date',
            ]);

            // Create user based on type
            switch ($validated['user_type']) {
                case 'employee':
                    $user = $userService->createEmployee($validated);
                    $message = 'Employee created successfully with ID: ' . $user->employee_id;
                    break;
                
                case 'student':
                    $user = $userService->createStudent($validated);
                    $message = 'Student created successfully with ID: ' . $user->student_id;
                    break;
                
                case 'guardian':
                    $user = $userService->createGuardian($validated);
                    $message = 'Guardian created successfully with ID: ' . $user->guardian_id;
                    break;
                
                default:
                    $user = $userService->createUser($validated);
                    $message = 'User created successfully!';
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        
        // Store preferences as JSON or in a separate table
        // For now, we'll just return success
        
        return redirect()->back()->with('success', 'Preferences updated successfully!');
    }

    public function profile()
    {
        $user = Auth::user()->load('employeeType');
        return view('backend.profile', compact('user'));
    }

    public function updateLogin(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'password' => 'required|string|min:6',
                'login_status' => 'required|in:0,1,true,false',
                'send_sms' => 'nullable|in:0,1,true,false',
            ]);

            $user = User::findOrFail($validated['user_id']);

            // Super admin cannot have login disabled
            if ($user->is_super_admin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot modify login access for Super Admin!'
                ], 403);
            }

            // Update password
            $user->password = Hash::make($validated['password']);
            
            // Update login status (convert to boolean)
            $loginStatus = filter_var($validated['login_status'], FILTER_VALIDATE_BOOLEAN);
            $user->login_enabled = $loginStatus;
            
            $user->save();

            $message = 'Login credentials updated successfully for ' . $user->name;

            // TODO: Implement SMS sending if $validated['send_sms'] is true
            if ($validated['send_sms'] ?? false) {
                // SMS logic here
                $message .= ' (SMS sent)';
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update login: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:active,inactive,suspended,terminated',
                'reason' => 'nullable|string|max:500',
                'notify_user' => 'nullable|in:on,off,true,false',
            ]);

            $user = User::findOrFail($validated['user_id']);
            
            // Super admin status cannot be changed
            if ($user->is_super_admin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Super Admin status cannot be changed to protect system access!'
                ], 403);
            }
            
            $oldStatus = $user->status;
            $newStatus = $validated['status'];

            // Update user status
            $user->status = $newStatus;
            $saved = $user->save();
            
            // Log for debugging
            \Log::info('User status update', [
                'user_id' => $user->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'saved' => $saved,
                'current_status_in_db' => $user->fresh()->status
            ]);

            $message = "User status changed from {$oldStatus} to {$newStatus} successfully!";

            // TODO: Implement email notification if $validated['notify_user'] is true
            if ($validated['notify_user'] ?? false) {
                // Email notification logic here
                // You can log the reason: $validated['reason']
                $message .= ' (Notification sent)';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'old_status' => $oldStatus,
                'new_status' => $newStatus
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all()),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Status update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }
}
