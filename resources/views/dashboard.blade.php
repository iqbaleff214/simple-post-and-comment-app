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

            @if(auth()->user()->role == 'user')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('posts.store') }}" method="post">
                            @csrf
                            <div class="mt-2">
                            <textarea
                                name="content"
                                rows="3"
                                placeholder="What are you thinking now?"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                <span class="text-red-600 text-sm">{{ $errors->first('content') }}</span>

                                <input type="text" name="title" placeholder="Give it a nice title"
                                       class="block mt-4 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <span class="text-red-600 text-sm">{{ $errors->first('title') }}</span>
                            </div>
                            <p class="my-3 text-sm leading-6 text-gray-600">Write a few sentences about what you
                                think.</p>

                            <select name="tag_id" placeholder="Select tag" class="block mb-4 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected disabled>Select a tag for your post.</option>
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>

                            <x-primary-button>{{ __('Post') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-4">
                <div class="md:col-span-1">
                    @if(auth()->user()->role == 'user')
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
                    @endif

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900">
                            <h1 class="font-semibold text-lg">Tags</h1>
                            <hr class="my-4">

                            <a
                                href="{{ request()->fullUrlWithQuery(['filter' => '']) }}"
                                @class([
                                    'bg-blue-100' => $filters['filter'] == '' || !$filters['filter'],
                                    'text-blue-800' => $filters['filter'] == '' || !$filters['filter'],
                                    'bg-gray-100' => $filters['filter'] != '' || $filters['filter'],
                                    'text-gray-800' => $filters['filter'] != '' || $filters['filter'],
                                    'text-sm' => true,
                                    'font-medium' => true,
                                    'mr-2' => true,
                                    'px-2.5' => true,
                                    'py-0.5' => true,
                                    'rounded-full' => true,
                                ])>All</a>
                            @foreach($tags as $tag)
                            <a
                                href="{{ request()->fullUrlWithQuery(['filter' => $tag->id]) }}"
                                @class([
                                    'bg-blue-100' => $filters['filter'] == $tag->id,
                                    'text-blue-800' => $filters['filter'] == $tag->id,
                                    'bg-gray-100' => $filters['filter'] != $tag->id,
                                    'text-gray-800' => $filters['filter'] != $tag->id,
                                    'text-sm' => true,
                                    'font-medium' => true,
                                    'mr-2' => true,
                                    'px-2.5' => true,
                                    'py-0.5' => true,
                                    'rounded-full' => true,
                                ])>
                                {{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3">
                    @foreach($posts as $post)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                            <div class="p-6 text-gray-900">
                                <h1 class="font-semibold text-xl mb-4">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h1>
                                <p class="text-sm">
                                    {{ $post?->author?->name }} | {{ $post->created_at }} @if($post?->tag) | {{ $post->tag?->name }} @endif
                                </p>
                                <hr class="mt-4 mb-4">
                                <p>{{ \Illuminate\Support\Str::limit($post->content, 225) }}</p>

                                <div class="mt-4 text-sm">
                                    <a href="{{ route('posts.show', $post) }}"
                                       class="text-indigo-600 underline">Comment ({{ count($post->comments) }})</a>
                                    @if(auth()->user()->id == $post->user_id)
                                        | <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 underline">Edit</a>
                                    @endif
                                    @if(auth()->user()->id == $post->user_id || auth()->user()->role == 'admin')
                                        |
                                        <form action="{{ route('posts.destroy', $post) }}" method="post"
                                              style="display: inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class=" text-indigo-600 underline">Delete</button>
                                        </form>
                                    @endif
                                </div>
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
