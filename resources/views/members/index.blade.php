<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registered Members</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="text-left p-2">Name</th>
                                    <th class="text-left p-2">Email</th>
                                    <th class="text-left p-2">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($members as $member)
                                    <tr class="border-t">
                                        <td class="p-2">{{ $member->name }}</td>
                                        <td class="p-2">{{ $member->email }}</td>
                                        <td class="p-2">{{ $member->role }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-2">No members found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $members->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
