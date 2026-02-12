<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\News;
use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNotices = Notice::count();
        $totalNews = News::count();
        $totalBlogs = Blog::count();
        
        // Published counts
        $publishedNotices = Notice::where('status', 'published')->count();
        $publishedNews = News::where('status', 'published')->count();
        $publishedBlogs = Blog::where('status', 'published')->count();
        
        return view('backend.dashboard', compact(
            'totalNotices',
            'totalNews',
            'totalBlogs',
            'publishedNotices',
            'publishedNews',
            'publishedBlogs'
        ));
    }
}
