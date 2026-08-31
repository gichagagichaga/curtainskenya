<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ url('/') }}</loc></url>
    <url><loc>{{ route('shop.index') }}</loc></url>
    <url><loc>{{ route('story') }}</loc></url>
    <url><loc>{{ route('contact') }}</loc></url>
    <url><loc>{{ route('testimonials.index') }}</loc></url>
    <url><loc>{{ route('blog.index') }}</loc></url>
    @foreach ($shopCategories as $category)<url><loc>{{ route('shop.category', $category) }}</loc><lastmod>{{ $category->updated_at->toAtomString() }}</lastmod></url>@endforeach
    @foreach ($products as $product)<url><loc>{{ route('products.show', $product) }}</loc><lastmod>{{ $product->updated_at->toAtomString() }}</lastmod></url>@endforeach
    @foreach ($services as $service)<url><loc>{{ route('services.show', $service) }}</loc><lastmod>{{ $service->updated_at->toAtomString() }}</lastmod></url>@endforeach
    @foreach ($blogCategories as $category)<url><loc>{{ route('blog.category', $category) }}</loc><lastmod>{{ $category->updated_at->toAtomString() }}</lastmod></url>@endforeach
    @foreach ($posts as $post)<url><loc>{{ route('blog.show', $post) }}</loc><lastmod>{{ $post->updated_at->toAtomString() }}</lastmod></url>@endforeach
</urlset>
