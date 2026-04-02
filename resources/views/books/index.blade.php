<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Books</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <div class="mb-4 text-green-700">{{ session('status') }}</div>
                    @endif

                    @if (auth()->user()->isAdmin() || auth()->user()->isLibrarian())
                        <div class="mb-4">
                            <a href="{{ route('manage.books.create') }}" class="text-indigo-600">Add New Book</a>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="text-left p-2">Title</th>
                                    <th class="text-left p-2">Author</th>
                                    <th class="text-left p-2">ISBN</th>
                                    <th class="text-left p-2">Copies</th>
                                    <th class="text-left p-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr class="border-t">
                                        <td class="p-2">{{ $book->title }}</td>
                                        <td class="p-2">{{ $book->author }}</td>
                                        <td class="p-2">{{ $book->isbn }}</td>
                                        <td class="p-2">{{ $book->copies }}</td>
                                        <td class="p-2">
                                            @if (auth()->user()->isAdmin() || auth()->user()->isLibrarian())
                                                <a href="{{ route('manage.books.edit', $book) }}" class="text-indigo-600">Edit</a>
                                                <form method="POST" action="{{ route('manage.books.destroy', $book) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 ms-2">Delete</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">View only</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-2">No books found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $books->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
