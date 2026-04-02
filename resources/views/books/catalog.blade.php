<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Available Catalog</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="surface-card overflow-hidden">
                <div class="p-6 text-gray-900">
                    @if ($errors->has('book'))
                        <div class="mb-4 rounded-xl border border-[var(--color-danger)]/30 bg-[var(--color-danger)]/10 px-4 py-3 text-[var(--color-danger)]">
                            {{ $errors->first('book') }}
                        </div>
                    @endif

                    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                        @forelse ($books as $book)
                            <article class="surface-card p-6 flex flex-col h-full">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="font-semibold text-2xl leading-tight text-[var(--color-primary)]" style="font-family: var(--font-display)">{{ $book->title }}</h3>
                                        <p class="mt-2 text-sm text-[var(--color-muted)]">By {{ $book->author }}</p>
                                    </div>

                                    @if ($book->copies > 0)
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-[var(--color-success)]/10 text-[var(--color-success)] border border-[var(--color-success)]/25">
                                            In Stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-[var(--color-danger)]/10 text-[var(--color-danger)] border border-[var(--color-danger)]/25">
                                            Book Currently Unavailable
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-5 space-y-2 text-sm text-[var(--color-muted)]">
                                    <p><span class="font-semibold text-[var(--color-text)]">ISBN:</span> {{ $book->isbn }}</p>
                                    <p><span class="font-semibold text-[var(--color-text)]">Copies available:</span> {{ $book->copies }}</p>
                                </div>

                                <div class="mt-auto pt-6">
                                    @if (auth()->user()->role === 'Member' && $book->copies > 0)
                                        <form method="POST" action="{{ route('borrowings.store', $book) }}">
                                            @csrf
                                            <button type="submit" class="btn-accent w-full">Borrow Book</button>
                                        </form>
                                    @else
                                        <button type="button" disabled class="w-full rounded-full px-5 py-2.5 font-semibold border border-[var(--color-border)] text-[var(--color-muted)] bg-[var(--color-surface-strong)] cursor-not-allowed">
                                            {{ $book->copies > 0 ? 'Borrow Unavailable' : 'Book Currently Unavailable' }}
                                        </button>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="surface-card p-6">No books available right now.</div>
                        @endforelse
                    </div>

                    <div class="mt-4">{{ $books->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
