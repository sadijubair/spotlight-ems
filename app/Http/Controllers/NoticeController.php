<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\NoticeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
    /**
     * Display a listing of all notices.
     */
    public function index(Request $request)
    {
        $notices = Notice::with(['category', 'user'])->get();
            
        return view('backend.notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new notice.
     */
    public function create()
    {
        $categories = NoticeCategory::active()->ordered()->get();
        return view('backend.notices.create', compact('categories'));
    }

    /**
     * Store a newly created notice in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file_attachment' => 'nullable|url|max:500',
            'category_id' => 'nullable|exists:notice_categories,id',
            'status' => 'required|in:draft,published,archived',
            'publish_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $validated['published_at'] = $request->publish_date ?? now();
        }

        $validated['user_id'] = auth()->id();

        $notice = Notice::create($validated);

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice created successfully!');
    }

    /**
     * Display the notice categories page.
     */
    public function categories()
    {
        $categories = NoticeCategory::withCount('notices')
            ->ordered()
            ->get();
            
        return view('backend.notices.categories', compact('categories'));
    }

    /**
     * Store a new category.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:notice_categories,name',
            'slug' => 'nullable|string|max:255|unique:notice_categories,slug',
            'description' => 'nullable|string',
            'color' => 'required|string|in:primary,success,danger,warning,info,secondary',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        NoticeCategory::create($validated);

        return redirect()
            ->route('notices.categories')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified notice.
     */
    public function show($slug)
    {
        $notice = Notice::where('slug', $slug)
            ->with(['category', 'user'])
            ->firstOrFail();
            
        $notice->incrementViews();
        
        return view('backend.notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified notice.
     */
    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        $categories = NoticeCategory::active()->ordered()->get();
        
        return view('backend.notices.edit', compact('notice', 'categories'));
    }

    /**
     * Update the specified notice in storage.
     */
    public function update(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file_attachment' => 'nullable|url|max:500',
            'category_id' => 'nullable|exists:notice_categories,id',
            'status' => 'required|in:draft,published,archived',
            'publish_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        // Set published_at if status is published
        if ($validated['status'] === 'published' && !$notice->published_at) {
            $validated['published_at'] = $request->publish_date ?? now();
        }

        // Update slug if title changed
        if ($validated['title'] !== $notice->title) {
            $notice->slug = Notice::generateUniqueSlug($validated['title'], $notice->id);
        }

        $notice->update($validated);

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice updated successfully!');
    }

    /**
     * Remove the specified notice from storage.
     */
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        
        $notice->delete();

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice deleted successfully!');
    }

    /**
     * Delete a category.
     */
    public function destroyCategory($id)
    {
        $category = NoticeCategory::findOrFail($id);
        
        // Check if category has notices
        if ($category->notices()->count() > 0) {
            return redirect()
                ->route('notices.categories')
                ->with('error', 'Cannot delete category with existing notices!');
        }
        
        $category->delete();

        return redirect()
            ->route('notices.categories')
            ->with('success', 'Category deleted successfully!');
    }
}
