@extends('layouts.landing')

@section('page-css')

<style>
    *{
        box-sizing:border-box;
    }

    .blog-wrapper{
        width:80%;
        margin:40px auto;
        padding-top: 10px;
    }

    .blog-header{
        text-align: center;
    }

    .blog-title{
        font-size:2rem;
        font-weight:500;
        color:#111;
        margin-top:50px;
    }

    .blog-subtitle{
        font-size:1.3rem;
        color:#888;
        margin:0;
    }

    .blog-grid{
        display:grid;
        grid-template-columns:repeat(4, 1fr);
        gap:24px;
    }

    .blog-link{
        text-decoration:none;
        color:inherit;
    }

    .blog-card{
        border-radius:12px;
        overflow:hidden;
        border:0.5px solid #e5e5e5;
        background:#fff;
        transition:box-shadow 0.2s, transform 0.2s;
        min-height:300px;
    }

    .blog-card:hover{
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
        transform:translateY(-3px);
    }

    .blog-image-wrap{
        width:100%;
        height:160px;
        overflow:hidden;
    }

    .blog-image{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }

    .blog-body{
        padding:14px;
    }

    .blog-card-title{
        font-size:0.95rem;
        font-weight:500;
        color:#111;
        margin:0 0 10px;
        line-height:1.4;
        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
    }

    .blog-summary{
        font-size:0.85rem;
        color:#444;
        margin:0 0 12px;
        line-height:1.4;
        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
    }

    .blog-footer{
        display:flex;
        align-items:center;
        justify-content:space-between;
        font-size:0.75rem;
        color:#999;
    }

    .blog-author{
        background:#f3f3f3;
        color:#555;
        padding:2px 8px;
        border-radius:20px;
        font-size:0.7rem;
    }

    .pagination-wrap{
        margin-top:40px;
        display:flex;
        justify-content:center;
    }

    @media (max-width: 992px){
        .blog-grid{
            grid-template-columns:repeat(2, 1fr);
        }

        .blog-wrapper{
            width:90%;
            padding-top: 20px;
        }
    }

    @media (max-width: 640px){
        .blog-grid{
            grid-template-columns:1fr;
        }

        .blog-wrapper{
            width:92%;
            margin:10px auto !important;
            padding-top: 10px !important;
        }

        .blog-header{
            padding-top: 40px !important;
        }

        .blog-title{
            font-size:1.3rem;
        }

        .blog-image-wrap{
            height:180px;
        }
    }
</style>

<script type="application/ld+json">{!! $meta['schema'] !!}</script>
@endsection

@section('content')
<div class="blog-wrapper" itemscope itemtype="https://schema.org/CollectionPage">

    <section class="blog-header">
        <h1 class="blog-title" itemprop="name">All Blogs</h1>
        <p class="blog-subtitle" itemprop="description">Browse the latest blogs</p>
    </section>

    <div class="blog-grid">

        @forelse ($blogs as $blog)

            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-link" itemprop="url">

                <article class="blog-card" itemscope itemtype="https://schema.org/BlogPosting">

                    <div class="blog-image-wrap">
                        <img src="{{ asset($blog->banner) }}" alt="{{ $blog->image_caption ?? $blog->title }}" class="blog-image" itemprop="image" loading="lazy" width="400" height="160">
                    </div>

                    <div class="blog-body">

                        <h2 class="blog-card-title" itemprop="headline"> {{ $blog->title }} </h2>
                        <p class="blog-summary" itemprop="description"> {{ $blog->summary ?? '' }}</p>

                        <div class="blog-footer">
                            <span class="blog-author"
                                  itemprop="author"
                                  itemscope
                                  itemtype="https://schema.org/Person">
                                <span itemprop="name">{{ $blog->contributor ?? 'Staff' }}</span>
                            </span>
                            <time itemprop="datePublished"
                                  datetime="{{ $blog->created_at->toIso8601String() }}">
                                {{ $blog->created_at->diffForHumans() }}
                            </time>
                        </div>

                    </div>

                </article>

            </a>

        @empty

            <div style="grid-column:1/-1; text-align:center; padding:60px 0; color:#aaa; font-size:0.95rem;">
                No articles found.
            </div>

        @endforelse

    </div>

    @if($blogs instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="pagination-wrap">
            {{ $blogs->links() }}
        </div>
    @endif

</div>
@endsection
