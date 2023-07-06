<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="">
                <x-text-input name="search" placeholder="Search" type="search" class="mb-4 block w-full"
                              :value="old('search', $filters['search'])"
                              autofocus autocomplete="search"/>
            </form>
            <div class="my-2">
                Sort By:
                <a href="{{ request()->fullUrlWithQuery(['order' => 'latest']) }}" @class([
                    'text-indigo-600 underline' => $filters['order'] != 'latest',
                    'text-indigo-900' => $filters['order'] == 'latest',
                ])>Latest</a> |
                <a href="{{ request()->fullUrlWithQuery(['order' => 'oldest']) }}" @class([
                    'text-indigo-600 underline' => $filters['order'] != 'oldest',
                    'text-indigo-900' => $filters['order'] == 'oldest',
                ])>Oldest</a>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-4">
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900">
                            <a href="{{ request()->fullUrlWithQuery(['mine' => 'false']) }}" @class([
                                'text-indigo-600 underline' => $filters['mine'] != 'false',
                                'text-indigo-900' => $filters['mine'] != 'true' || $filters['mine'] == '',
                            ])>All</a> |
                            <a href="{{ request()->fullUrlWithQuery(['mine' => 'true']) }}" @class([
                                'text-indigo-600 underline' => $filters['mine'] != 'true',
                                'text-indigo-900' => $filters['mine'] == 'true',
                            ])>Mine Only</a>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900">
                            <h1 class="font-semibold text-lg mb-4">Tags</h1>
                            <hr>

                        </div>
                    </div>
                </div>

                <div class="md:col-span-3">
                    @foreach($posts as $post)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                            <div class="p-6 text-gray-900">
                                <h1 class="font-semibold text-xl mb-4">{{ $post->title }}</h1>
                                <p class="text-sm">{{ $post?->author?->name }} | {{ $post?->author?->created_at }}</p>
                                <hr class="mt-4 mb-4">
                                <p>{{ \Illuminate\Support\Str::limit($post->content, 225) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
