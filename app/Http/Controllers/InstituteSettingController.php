<?php

namespace App\Http\Controllers;

use App\Models\InstituteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstituteSettingController extends Controller
{
    /**
     * Display the institute settings form.
     */
    public function index()
    {
        $setting = InstituteSetting::first();
        
        return view('backend.settings.institute', compact('setting'));
    }

    /**
     * Update the institute settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Primary Information
            'name' => 'required|string|max:255',
            'name_bangla' => 'nullable|string|max:255',
            'short_form' => 'nullable|string|max:50',
            'motto' => 'nullable|string|max:255',
            'medium' => 'nullable|string|max:100',
            'establish_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'eiin' => 'nullable|string|max:50',
            'mpo_code' => 'nullable|string|max:50',
            'institute_code' => 'nullable|string|max:50',
            'institute_type' => 'nullable|string|max:100',
            'board' => 'nullable|string|max:100',
            'affiliation' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            
            // Contact Information
            'telephone' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'office_hours' => 'nullable|string|max:100',
            'website_url' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'google_map_embed' => 'nullable|string',
            
            // Social Networks
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'tiktok' => 'nullable|url|max:255',
            'telegram' => 'nullable|url|max:255',
        ]);

        $setting = InstituteSetting::first();

        if (!$setting) {
            $setting = new InstituteSetting();
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $validated['logo'] = $request->file('logo')->store('institute', 'public');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('institute', 'public');
        }

        $setting->fill($validated);
        $setting->save();

        return redirect()
            ->route('settings.institute')
            ->with('success', 'Institute settings updated successfully!');
    }
}
