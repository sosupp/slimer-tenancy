<?php

namespace Sosupp\SlimerTenancy\Http\Controllers\Slimer\Site;

use Illuminate\Routing\Controller;
use Sosupp\SlimerTenancy\Models\Landlord\Blog;
use Sosupp\SlimerTenancy\Services\Landlord\BlogsCrudService;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function banner(Blog $blog)
    {
        abort_if(blank($blog->banner), 404);

        $path = storage_path('app/private/' . ltrim($blog->banner, '/'));

        abort_unless(is_file($path), 404);

        return response()->file($path, [
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    public function index()
    {
        $blogs = Blog::latest()->paginate(20);

        $meta = [
            'title' => 'All Blogs | ' . 'SUSU CRM',
            'description' => 'Browse the latest articles, tips and insights from ' . 'SUSU CRM' . '.',
            'url' => request()->url(),
            'schema' => json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'CollectionPage',
                'name' => 'All Blogs | ' . 'SUSU CRM',
                'description' => 'Browse the latest articles, tips and insights from ' . 'SUSU CRM' . '.',
                'url' => request()->url(),
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'SUSU CRM',
                    'logo' => ['@type' => 'ImageObject', 'url' => asset('brand/susu-favicon.png')],
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ];

        return view('slimer-tenancy::blogs.blog-list', compact('blogs', 'meta'));
    }

    public function show($slug)
    {
        // dd($slug)
        $blog = Blog::query()
            ->where('slug', $slug)
            ->first();

        $blog->increment('views');

        $imageUrl = asset($blog->banner);

        $meta = [
            'title' => $blog->title . ' | ' . 'SUSU CRM',
            'description' => Str::limit(strip_tags($blog->content), 160),
            'keywords' => $blog->keywords,
            'author' => $blog->contributor,
            'url' => request()->url(),
            'image'=> $imageUrl,
            'image_alt' => $blog->image_caption ?? $blog->title,
            'published' => $blog->created_at->toIso8601String(),
            'modified' => $blog->updated_at->toIso8601String(),
            'tags' => $blog->keywords ? array_map('trim', explode(',', $blog->keywords)) : [],
            'schema' => json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $blog->title,
                'description' => Str::limit(strip_tags($blog->content), 160),
                'image' => $imageUrl,
                'author' => ['@type' => 'Person', 'name' => $blog->contributor],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'SUSU CRM',
                    'logo' => ['@type' => 'ImageObject', 'url' => asset('brand/susu-favicon.png')],
                ],
                'datePublished' => $blog->created_at->toIso8601String(),
                'dateModified' => $blog->updated_at->toIso8601String(),
                'mainEntityOfPage'=> ['@type' => 'WebPage', '@id' => request()->url()],
                'keywords' => $blog->keywords,
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ];

        return view('slimer-tenancy::blogs.show', compact('blog', 'meta'));
    }

    // public function all(){
    //     $blogs = Blog::latest()->paginate(20);
    //     return view('blogs.blog-list',compact('blogs') );
    // }

    public function all()
    {
        // dd("yes");
        $blogs = Blog::latest()->paginate(20);

        $meta = [
            'title' => 'All Blogs | ' . 'SUSU CRM',
            'description' => 'Browse the latest articles, tips and insights from ' . 'SUSU CRM' . '.',
            'url' => request()->url(),
            'schema' => json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'CollectionPage',
                'name' => 'All Blogs | ' . 'SUSU CRM',
                'description' => 'Browse the latest articles, tips and insights from ' . 'SUSU CRM' . '.',
                'url' => request()->url(),
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'SUSU CRM',
                    'logo' => ['@type' => 'ImageObject', 'url' => asset('brand/susu-favicon.png')],
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ];

        return view('slimer-tenancy::blogs.blog-list', compact('blogs', 'meta'));
    }
}
