<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('tags.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">New Tag</a>

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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 pb-4">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $tag->created_at }}
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $tag->name }}
                                </th>
                                <td class="px-6 py-4">
                                    <a href="{{ route('tags.edit', $tag) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>
                                    <form action="{{ route('tags.destroy', $tag) }}" method="post" onsubmit="return confirm('Are you sure?')" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="ml-3">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            {!! $tags->links() !!}
        </div>
    </div>
</x-app-layout>
