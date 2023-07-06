<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-3">
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900">
                            <form action="{{ route('posts.update', $post) }}" method="post" class="mb-4">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                                <h1 class="font-semibold text-xl mb-4">
                                    <input type="text" name="title" placeholder="Give it a nice title"
                                           value="{{ old('title', $post->title) }}"
                                           class="block mt-4 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <span class="text-red-600 text-sm">{{ $errors->first('title') }}</span>
                                </h1>
                                <p class="text-sm">{{ $post?->author?->name }} | {{ $post->created_at }} | <select name="tag_id" placeholder="Select tag" style="display: inline" class="mb-4 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option @if($post->tag_id == null) selected @endif disabled>Select a tag for your post.</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" @if($post->tag_id == $tag->id) selected @endif>{{ $tag->name }}</option>
                                        @endforeach
                                    </select></p>
                                <hr class="mt-4 mb-4">
                                <textarea
                                    name="content"
                                    rows="20"
                                    placeholder="What are you thinking now?"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('content', $post->content) }}</textarea>
                                <span class="text-red-600 text-sm">{{ $errors->first('content') }}</span>

                                <x-primary-button class="mt-6">{{ __('Save') }}</x-primary-button>

                            </form>
                            <div class="mt-4 text-sm">
                                @if(auth()->user()->id == $post->user_id)
                                    <a href="{{ route('posts.show', $post) }}"
                                       class="text-indigo-600 underline">Comment ({{ count($post->comments) }})</a>
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
                </div>
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900">
                            <h1 class="font-semibold text-lg mb-4">Comments ({{ count($post->comments) }})</h1>
                            <hr class="my-4">

                            @foreach($post->comments as $comment)
                                <div class="mb-4 text-gray-600">
                                    <h1 class="font-semibold text-md">{{ $comment->content }}</h1>
                                    <p class="text-xs">{{ $comment->author?->name }} | {{ $comment->created_at }}</p>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
