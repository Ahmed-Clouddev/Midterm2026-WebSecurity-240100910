<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Borrowed Books</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <div class="mb-4 text-green-700">{{ session('status') }}</div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="text-left p-2">Title</th>
                                    <th class="text-left p-2">ISBN</th>
                                    <th class="text-left p-2">Borrowed At</th>
                                    <th class="text-left p-2">Due At</th>
                                    <th class="text-left p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowings as $borrowing)
                                    <tr class="border-t">
                                        <td class="p-2">{{ $borrowing->book->title }}</td>
                                        <td class="p-2">{{ $borrowing->book->isbn }}</td>
                                        <td class="p-2">{{ optional($borrowing->borrowed_at)->format('Y-m-d H:i') }}</td>
                                        <td class="p-2">{{ optional($borrowing->due_at)->format('Y-m-d') }}</td>
                                        <td class="p-2">{{ $borrowing->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-2">No borrowed books yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $borrowings->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
