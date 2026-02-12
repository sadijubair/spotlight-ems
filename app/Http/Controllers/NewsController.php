<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of all news.
     */
    public function index(Request $request)
    {
        $news = News::with(['category', 'user'])->get();
            
        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new news.
     */
    public function create()
    {
        $categories = NewsCategory::active()->ordered()->get();
        return view('backend.news.create', compact('categories'));
    }

    /**
     * Store a newly created news in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'nullable|exists:news_categories,id',
            'status' => 'required|in:draft,published,archived',
            'publish_date' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('news', 'public');
        }

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $validated['published_at'] = $request->publish_date ?? now();
        }

        $validated['user_id'] = auth()->id();

        $news = News::create($validated);

        return redirect()
            ->route('news.index')
            ->with('success', 'News created successfully!');
    }

    /**
     * Display the news categories page.
     */
    public function categories()
    {
        $categories = NewsCategory::withCount('news')
            ->ordered()
            ->get();
            
        return view('backend.news.categories', compact('categories'));
    }

    /**
     * Store a new category.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name',
            'slug' => 'nullable|string|max:255|unique:news_categories,slug',
            'description' => 'nullable|string',
            'color' => 'required|string|in:primary,success,danger,warning,info,secondary',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        NewsCategory::create($validated);

        return redirect()
            ->route('news.categories')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified news.
     */
    public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->with(['category', 'user'])
            ->firstOrFail();
            
        $news->incrementViews();
        
        return view('backend.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified news.
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = NewsCategory::active()->ordered()->get();
        
        return view('backend.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified news in storage.
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'nullable|exists:news_categories,id',
            'status' => 'required|in:draft,published,archived',
            'publish_date' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            
            $validated['featured_image'] = $request->file('featured_image')
                ->store('news', 'public');
        }

        // Set published_at if status is published
        if ($validated['status'] === 'published' && !$news->published_at) {
            $validated['published_at'] = $request->publish_date ?? now();
        }

        // Update slug if title changed
        if ($validated['title'] !== $news->title) {
            $news->slug = News::generateUniqueSlug($validated['title'], $news->id);
        }

        $news->update($validated);

        return redirect()
            ->route('news.index')
            ->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified news from storage.
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        // Delete featured image if exists
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }
        
        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('success', 'News deleted successfully!');
    }

    /**
     * Delete a category.
     */
    public function destroyCategory($id)
    {
        $category = NewsCategory::findOrFail($id);
        
        // Check if category has news
        if ($category->news()->count() > 0) {
            return redirect()
                ->route('news.categories')
                ->with('error', 'Cannot delete category with existing news!');
        }
        
        $category->delete();

        return redirect()
            ->route('news.categories')
            ->with('success', 'Category deleted successfully!');
    }
}
