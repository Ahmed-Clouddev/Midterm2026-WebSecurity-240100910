<nav x-data="{ open: false }" class="app-topbar">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="app-brand">
                        <span class="app-brand-mark">📚</span>
                        <span>
                            <span class="app-brand-title block">Online Library</span>
                            <span class="app-brand-subtitle block">Management System</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-6">
                    <a href="{{ route('dashboard') }}" class="top-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    @if (Auth::user()->role === 'Admin')
                        <a href="{{ route('members.index') }}" class="top-nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                            Members
                        </a>
                        <a href="{{ route('books.index') }}" class="top-nav-link {{ request()->routeIs('books.*') || request()->routeIs('manage.books.*') ? 'active' : '' }}">
                            Books
                        </a>
                        <a href="{{ route('admin.librarians.create') }}" class="top-nav-link {{ request()->routeIs('admin.librarians.*') ? 'active' : '' }}">
                            Create Librarian
                        </a>
                        <a href="{{ route('admin.roles.index') }}" class="top-nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                            Roles &amp; Permissions
                        </a>
                    @elseif (Auth::user()->role === 'Librarian')
                        <a href="{{ route('members.index') }}" class="top-nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                            Members
                        </a>
                        <a href="{{ route('books.index') }}" class="top-nav-link {{ request()->routeIs('books.*') || request()->routeIs('manage.books.*') ? 'active' : '' }}">
                            Books
                        </a>
                    @elseif (Auth::user()->role === 'Member')
                        <a href="{{ route('catalog.index') }}" class="top-nav-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}">
                            Library Catalogue
                        </a>
                        <a href="{{ route('profile.edit') }}" class="top-nav-link {{ request()->routeIs('profile.*') || request()->routeIs('borrowings.*') ? 'active' : '' }}">
                            My Account
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="top-user-chip inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-full hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-amber-100 hover:text-white hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/10 bg-[#13211b]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="!text-amber-50">
                Dashboard
            </x-responsive-nav-link>

            @if (Auth::user()->role === 'Admin')
                <x-responsive-nav-link :href="route('members.index')" :active="request()->routeIs('members.*')" class="!text-amber-50">
                    Members
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('books.index')" :active="request()->routeIs('books.*') || request()->routeIs('manage.books.*')" class="!text-amber-50">
                    Books
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.librarians.create')" :active="request()->routeIs('admin.librarians.*')" class="!text-amber-50">
                    Create Librarian
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.*')" class="!text-amber-50">
                    Roles &amp; Permissions
                </x-responsive-nav-link>
            @elseif (Auth::user()->role === 'Librarian')
                <x-responsive-nav-link :href="route('members.index')" :active="request()->routeIs('members.*')" class="!text-amber-50">
                    Members
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('books.index')" :active="request()->routeIs('books.*') || request()->routeIs('manage.books.*')" class="!text-amber-50">
                    Books
                </x-responsive-nav-link>
            @elseif (Auth::user()->role === 'Member')
                <x-responsive-nav-link :href="route('catalog.index')" :active="request()->routeIs('catalog.*')" class="!text-amber-50">
                    Library Catalogue
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*') || request()->routeIs('borrowings.*')" class="!text-amber-50">
                    My Account
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/10">
            <div class="px-4">
                <div class="font-medium text-base text-amber-50">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-amber-100/80">{{ Auth::user()->email }}</div>
                <div class="font-medium text-sm text-amber-100/80">{{ Auth::user()->role }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
