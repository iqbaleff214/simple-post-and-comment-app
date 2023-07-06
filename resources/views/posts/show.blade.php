<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-3">
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 text-gray-900">
                            <h1 class="font-semibold text-xl mb-4">{{ $post->title }}</h1>
                            <p class="text-sm">{{ $post?->author?->name }} | {{ $post->created_at }}</p>
                            <hr class="mt-4 mb-4">
                            <p>{{ $post->content }}</p>

                            <div class="mt-4 text-sm">
                                @if(auth()->user()->id == $post->user_id)
                                    <a href="{{ route('posts.edit', $post) }}"
                                       class="text-indigo-600 underline">Edit</a>
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
                            <form action="{{ route('comments.store', ['post' => $post]) }}" method="post" class="mb-4">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea
                                    name="content"
                                    rows="3"
                                    placeholder="What do you think about this post?"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                <span class="text-red-600 text-sm">{{ $errors->first('content') }}</span>

                                <p class="my-3 text-sm leading-6 text-gray-600">Write your comment.</p>

                                <x-primary-button>{{ __('Comment') }}</x-primary-button>
                            </form>

                            <hr class="my-4">

                            @foreach($post->comments as $comment)
                                <div class="mb-4 text-gray-600">
                                    <h1 class="font-semibold text-md">{{ $comment->content }}</h1>
                                    <p class="text-xs">{{ $comment->author?->name }} | {{ $comment->created_at }}</p>

                                    @if(auth()->user()->id == $comment->user_id)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="post"
                                              style="display: inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-indigo-600 underline">Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
