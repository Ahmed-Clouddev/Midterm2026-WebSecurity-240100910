<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Book</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('manage.books.update', $book) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" :value="'Title'" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="author" :value="'Author'" />
                        <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $book->author)" required />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="isbn" :value="'ISBN'" />
                        <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" :value="old('isbn', $book->isbn)" required />
                        <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="copies" :value="'Copies'" />
                        <x-text-input id="copies" name="copies" type="number" min="0" class="mt-1 block w-full" :value="old('copies', $book->copies)" required />
                        <x-input-error :messages="$errors->get('copies')" class="mt-2" />
                    </div>

                    <x-primary-button>Update Book</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
