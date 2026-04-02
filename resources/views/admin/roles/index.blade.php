<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles and Permissions</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        @foreach ($rolePermissions as $role => $permissions)
                            <div>
                                <h3 class="font-semibold text-lg">{{ $role }}</h3>
                                <ul class="list-disc ms-6 mt-2">
                                    @foreach ($permissions as $permission)
                                        <li>{{ $permission }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
