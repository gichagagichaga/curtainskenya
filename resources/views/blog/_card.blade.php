<article class="overflow-hidden rounded-2xl border border-black/8 bg-white shadow-sm">
    <a href="{{ route('blog.show', $post) }}" class="block aspect-[16/10] bg-ck-cream">
        @if ($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->featured_image_alt }}" class="size-full object-cover" loading="lazy" width="640" height="400">
        @else
            <div class="flex size-full items-center justify-center font-serif text-2xl text-ck-brown">Curtains Kenya Journal</div>
        @endif
    </a>
    <div class="space-y-3 p-5">
        <div class="flex items-center justify-between gap-3 text-[0.65rem] font-medium tracking-[0.14em] text-ck-brown uppercase">
            <a href="{{ $post->category ? route('blog.category', $post->category) : route('blog.index') }}">{{ $post->category?->name ?? 'Home inspiration' }}</a>
            <span>{{ $post->reading_time }} min read</span>
        </div>
        <h2 class="font-serif text-2xl leading-tight"><a href="{{ route('blog.show', $post) }}" class="hover:text-ck-brown">{{ $post->title }}</a></h2>
        <p class="line-clamp-3 text-sm leading-6 text-ck-muted">{{ $post->excerpt }}</p>
        <div class="flex items-center justify-between text-xs text-ck-muted"><span>{{ $post->published_at->format('j M Y') }}</span><a href="{{ route('blog.show', $post) }}" class="font-medium text-ck-dark underline underline-offset-4">Read article</a></div>
    </div>
</article>
