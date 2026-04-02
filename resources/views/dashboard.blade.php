<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">Welcome, {{ auth()->user()->name }} ({{ auth()->user()->role }})</div>

                    <div class="space-y-2">
                        <div><a href="{{ route('books.index') }}" class="text-indigo-600">View All Books</a></div>

                        @if (auth()->user()->isMember())
                            <div><a href="{{ route('catalog.index') }}" class="text-indigo-600">Browse Available Catalog</a></div>
                            <div><a href="{{ route('borrowings.index') }}" class="text-indigo-600">My Borrowed Books</a></div>
                        @endif

                        @if (auth()->user()->isAdmin() || auth()->user()->isLibrarian())
                            <div><a href="{{ route('manage.books.create') }}" class="text-indigo-600">Add New Book</a></div>
                            <div><a href="{{ route('members.index') }}" class="text-indigo-600">View Members</a></div>
                        @endif

                        @if (auth()->user()->isAdmin())
                            <div><a href="{{ route('admin.librarians.create') }}" class="text-indigo-600">Create Librarian</a></div>
                            <div><a href="{{ route('admin.roles.index') }}" class="text-indigo-600">View Roles & Permissions</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
