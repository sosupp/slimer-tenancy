@extends('layouts.landing')

    <style>
        .faqs {
            padding: 5rem 1.5rem;
            background: #fff;
            margin-top: 100px;
        }

        .faqs .container {
            /* max-width: 720px; */
            margin: 0 auto;
        }

        .faqs .section-title {
            font-size: 1.75rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2.5rem;
            color: #111;
        }

        .faqs-list {
            border-top: 1px solid #e5e5e5;
        }

        .faq-item {
            border-bottom: 1px solid #e5e5e5;
        }

        .faq-question {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.25rem 0;
            font-size: 1rem;
            font-weight: 500;
            color: #111;
            cursor: pointer;
            list-style: none;
        }

        .faq-question::-webkit-details-marker {
            display: none;
        }

        .faq-icon {
            flex-shrink: 0;
            transition: transform 0.2s ease;
            color: #888;
        }

        .faq-item[open] .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 0 1.25rem;
            color: #555;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .faq-answer p {
            margin: 0 0 0.5rem;
        }

        .faq-category {
            display: inline-block;
            font-size: 0.75rem;
            color: #fff;
            background: var(--primary-dark);
            padding: 0.15rem 0.6rem;
            border-radius: 999px;
        }

        .faq-empty {
            text-align: center;
            color: #888;
            padding: 2rem 0;
        }
    </style>
@section('content')
        <section class="faqs" id="faqs">
        <div class="container">
            <h2 class="section-title">Frequently Asked Questions</h2>

            <div class="faqs-list">
                @forelse ($faqs as $faq)
                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>{{ $faq->question }}</span>
                            <svg class="faq-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 9l6 6 6-6"/>
                            </svg>
                        </summary>
                        <div class="faq-answer">
                            <p>{{ $faq->answer }}</p>
                            {{-- @if($faq->category)
                                <span class="faq-category">{{ $faq->category }}</span>
                            @endif --}}
                        </div>
                    </details>
                @empty
                    <p class="faq-empty">No FAQs available yet.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection