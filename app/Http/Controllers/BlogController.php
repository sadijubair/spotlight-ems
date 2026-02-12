<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of all blogs.
     */
    public function index(Request $request)
    {
        $blogs = Blog::with(['category', 'user'])->get();
            
        return view('backend.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        $categories = BlogCategory::active()->ordered()->get();
        return view('backend.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'required|in:draft,published,archived',
            'publish_date' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blogs', 'public');
        }

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $validated['published_at'] = $request->publish_date ?? now();
        }

        $validated['user_id'] = auth()->id();

        $blog = Blog::create($validated);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog created successfully!');
    }

    /**
     * Display the blog categories page.
     */
    public function categories()
    {
        $categories = BlogCategory::withCount('blogs')
            ->ordered()
            ->get();
            
        return view('backend.blogs.categories', compact('categories'));
    }

    /**
     * Store a new category.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug',
            'description' => 'nullable|string',
            'color' => 'required|string|in:primary,success,danger,warning,info,secondary',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        BlogCategory::create($validated);

        return redirect()
            ->route('blogs.categories')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified blog.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with(['category', 'user'])
            ->firstOrFail();
            
        $blog->incrementViews();
        
        return view('backend.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::active()->ordered()->get();
        
        return view('backend.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'required|in:draft,published,archived',
            'publish_date' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blogs', 'public');
        }

        // Set published_at if status is published
        if ($validated['status'] === 'published' && !$blog->published_at) {
            $validated['published_at'] = $request->publish_date ?? now();
        }

        // Update slug if title changed
        if ($validated['title'] !== $blog->title) {
            $blog->slug = Blog::generateUniqueSlug($validated['title'], $blog->id);
        }

        $blog->update($validated);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        
        // Delete featured image if exists
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        
        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog deleted successfully!');
    }

    /**
     * Delete a category.
     */
    public function destroyCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        
        // Check if category has blogs
        if ($category->blogs()->count() > 0) {
            return redirect()
                ->route('blogs.categories')
                ->with('error', 'Cannot delete category with existing blogs!');
        }
        
        $category->delete();

        return redirect()
            ->route('blogs.categories')
            ->with('success', 'Category deleted successfully!');
    }
}
