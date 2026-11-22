@extends('layouts.landing')

@section('page-css')
<style>
    * { box-sizing: border-box; }

    .blog-container {
        max-width: 1200px;
        margin: 40px auto;
        box-sizing: border-box !important;
        padding-top: 100px !important;
        padding-bottom: 100px !important;
    }

    .blog-header {
        text-align: center !important;
        box-sizing: border-box !important;
    }

    .blog-title {
        font-size: 2rem;
        font-weight: 500;
        color: #111;
        line-height: 1.3;
        margin: 0 0 16px;
        text-align: center;
    }

    .blog-keywords {
        font-size: 0.8rem;
        color: #aaa;
        display: block;
        margin-bottom: 10px;
    }

    .blog-author {
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        margin: 0 0 4px;
    }

    .blog-date {
        font-size: 0.85rem;
        color: #999;
        margin: 0;
    }

    .blog-banner {
        margin-bottom: 36px;
        border-radius: 14px;
        overflow: hidden;
    }

    .blog-banner img {
        width: 100%;
        max-height: 480px;
        object-fit: cover;
        display: block;
    }

    .blog-caption {
        font-size: 0.78rem;
        color: #aaa;
        text-align: center;
        margin: 8px 0 0;
    }

    .blog-content {
        font-size: 1.3rem;
        line-height: 1.9;
        color: #222;
    }

    @media (max-width: 992px) {
        .blog-header { padding-top: 20px !important; width: 100%; }
        .blog-title { font-size: 1.7rem; }
    }

    @media (max-width: 640px) {
        .blog-container { width: 92%; margin: 10px auto; }
        .blog-header { padding-top: 10px !important; width: 100%; }
        .blog-title { font-size: 1.3rem; }
        .blog-content { font-size: 1rem; line-height: 1.8; }
        .blog-banner img { max-height: 260px; margin-top: 0}
    }
</style>
@endsection


@section('meta')
<title>{{ $meta['title'] }}</title>
<meta name="description" content="{{ $meta['description'] }}">
<meta name="keywords" content="{{ $meta['keywords'] }}">
<meta name="author" content="{{ $meta['author'] }}">
<link rel="canonical" href="{{ $meta['url'] }}">

<meta property="og:type" content="article">
<meta property="og:title" content="{{ $meta['title'] }}">
<meta property="og:description" content="{{ $meta['description'] }}">
<meta property="og:image" content="{{ $meta['image'] }}">
<meta property="og:image:alt" content="{{ $meta['image_alt'] }}">
<meta property="og:url" content="{{ $meta['url'] }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="article:published_time" content="{{ $meta['published'] }}">
<meta property="article:author" content="{{ $meta['author'] }}">
{{ implode('', array_map(fn($t) => '<meta property="article:tag" content="'.$t.'">', $meta['tags'])) }}



<script type="application/ld+json">{!! $meta['schema'] !!}</script>
@endsection


@section('content')

<article class="blog-container" itemscope itemtype="https://schema.org/BlogPosting">

    <div class="blog-header">

        <h1 class="blog-title" itemprop="headline">
            {{ $blog->title }}
        </h1>

        <span class="blog-keywords" itemprop="keywords">
            {{ $blog->keywords }}
        </span>

        <p class="blog-author">
            By <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                <span itemprop="name">{{ $blog->contributor }}</span>
            </span>
        </p>

        <p class="blog-date">
            <time itemprop="datePublished" datetime="{{ $blog->created_at->toIso8601String() }}">
                {{ euroDate($blog->created_at, false) }}
            </time>
        </p>

    </div>

    <figure class="blog-banner" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">

        <img src="{{ asset($blog->banner) }}"
             alt="{{ $blog->image_caption ?? $blog->title }}"
             itemprop="url"
             width="1200"
             height="480"
             loading="eager"
             fetchpriority="high">

        @if($blog->image_caption)
            <figcaption class="blog-caption" itemprop="caption">
                {{ $blog->image_caption }}
            </figcaption>
        @endif

    </figure>

    <div class="blog-content" itemprop="articleBody">
        {!! $blog->content !!}
    </div>

</article>

@endsection
