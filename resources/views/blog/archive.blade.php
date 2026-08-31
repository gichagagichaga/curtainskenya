@extends('layouts.public')
@section('title', $heading.' | Curtains Kenya Journal')
@section('description', $description)
@section('robots', $robots)
@section('content')
<section class="bg-ck-cream py-14 sm:py-20"><div class="ck-container"><a href="{{ route('blog.index') }}" class="text-sm text-ck-muted hover:text-ck-brown">← Back to Journal</a><h1 class="mt-5 font-serif text-4xl sm:text-6xl">{{ $heading }}</h1>@if($description)<p class="mt-5 max-w-2xl leading-7 text-ck-muted">{{ $description }}</p>@endif</div></section>
<section class="ck-container py-12 sm:py-16"><nav aria-label="Blog categories" class="flex flex-wrap gap-2">@foreach($categories as $category)<a href="{{ route('blog.category', $category) }}" class="rounded-full border border-black/10 px-4 py-2 text-sm hover:border-ck-brown">{{ $category->name }}</a>@endforeach</nav><div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">@forelse($posts as $post) @include('blog._card') @empty <p class="col-span-full rounded-xl bg-ck-cream p-8 text-ck-muted">No published articles yet.</p> @endforelse</div>@if($posts->hasPages())<div class="mt-10">{{ $posts->links() }}</div>@endif</section>
@endsection
