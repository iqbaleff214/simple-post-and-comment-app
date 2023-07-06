<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tags.update', $tag) }}" method="post" class="mb-4">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" placeholder="Name your new tag"
                               value="{{ old('name', $tag->name) }}"
                               class="block mt-4 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>

                        <x-primary-button class="mt-6">{{ __('Save') }}</x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
