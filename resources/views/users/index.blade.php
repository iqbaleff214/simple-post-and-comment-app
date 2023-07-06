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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="relative overflow-x-auto p-6">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-6">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 pb-4">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Joined At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $user->created_at }}
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('users.destroy', $user) }}" method="post" onsubmit="return confirm('Are you sure?')">
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

                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
