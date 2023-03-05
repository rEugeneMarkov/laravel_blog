@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edicas-page-title" data-aos="fade-up">Категории</h1>
            <section class="featured-posts-section">
                <ul class="navbar-nav">
                    @foreach ($categories as $category)
                        <li class="navbar-nav">
                            <a href="{{ route('category.post.index', $category->id) }}">{{ $category->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </main>
@endsection
