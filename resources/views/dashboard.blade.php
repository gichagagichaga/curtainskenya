<x-layouts::app :title="__('Dashboard')">
    <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="border-b border-zinc-200 pb-6 dark:border-zinc-700">
            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Curtains Kenya administration</p>
            <h1 class="mt-1 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Dashboard</h1>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">A quick overview of your catalogue.</p>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('admin.products.index') }}" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Products</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white">{{ $productCount }}</p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $activeProductCount }} active in the shop</p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Categories</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white">{{ $categoryCount }}</p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $activeCategoryCount }} visible in the shop</p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="{{ route('admin.blog.posts.index') }}" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Blog</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white">{{ $publishedPostCount }}</p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $draftPostCount }} {{ $draftPostCount === 1 ? 'draft article' : 'draft articles' }}</p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="{{ route('admin.enquiries.index') }}" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Customer enquiries</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white">{{ $newEnquiryCount }}</p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $newEnquiryCount === 1 ? 'awaiting a response' : 'awaiting responses' }}</p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">New orders</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white">{{ $pendingOrderCount }}</p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $pendingOrderCount === 1 ? 'awaiting review' : 'awaiting review' }}</p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
        </div>

        <section class="mt-6 rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900 sm:p-6">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Catalogue actions</h2>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Add products or organise the categories customers browse.</p>
            <div class="mt-5 flex flex-wrap gap-3"><a href="{{ route('admin.products.create') }}" class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">Add product</a><a href="{{ route('admin.categories.create') }}" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Add category</a></div>
            <div class="mt-3 flex flex-wrap gap-3"><a href="{{ route('admin.blog.posts.index') }}" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Manage blog</a><a href="{{ route('admin.blog.posts.create') }}" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Add article</a><a href="{{ route('admin.story.edit') }}" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Edit our story</a><a href="{{ route('admin.enquiries.index') }}" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">View enquiries</a><a href="{{ route('admin.orders.index') }}" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">View orders</a></div>
        </section>
    </div>
</x-layouts::app>
