<nav x-data="{ open: false }" class="bg-blue-100 border-b shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <span class="font-bold text-black text-lg tracking-wide">PoliKlinik</span>
                </a>
                <div class="hidden space-x-4 sm:ml-10 sm:flex">
                    @if (Auth::user()->role == 'dokter')
                        <x-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')" class="text-black">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ __('Dashboard') }}
                            </span>
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.obat.index')" :active="request()->routeIs('dokter.obat.index')" class="text-black">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="7" rx="3.5"/><path d="M8 11V7a4 4 0 018 0v4"/></svg>
                                {{ __('Obat') }}
                            </span>
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.jadwalperiksa.index')" :active="request()->routeIs('dokter.jadwalperiksa.index')" class="text-black">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                {{ __('Jadwal Periksa') }}
                            </span>
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.memeriksa.index')" :active="request()->routeIs('dokter.memeriksa.index')" class="text-black">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 2h6v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V2zM4 6h16v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                                {{ __('Memeriksa Pasien') }}
                            </span>
                        </x-nav-link>
                    @elseif(Auth::user()->role == 'pasien')
                        <x-nav-link :href="route('pasien.dashboard')" :active="request()->routeIs('pasien.dashboard')" class="text-black">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ __('Dashboard') }}
                            </span>
                        </x-nav-link>
                        <x-nav-link :href="route('pasien.janjiperiksa.index')" :active="request()->routeIs('pasien.janjiperiksa.index')" class="text-black">
                             <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                {{ __('Janji Periksa') }}
                            </span>
                        </x-nav-link>
                        <x-nav-link :href="route('pasien.riwayat-periksa.index')" :active="request()->routeIs('pasien.riwayat-periksa.index')">
                                <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 2h6v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V2zM4 6h16v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                                {{ __('Riwayat Periksa') }}
                            </span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="mr-2">{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white shadow rounded-md py-1">
                            <x-dropdown-link :href="route('profile.edit')" class="text-blue-600 hover:underline">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-red-600 hover:underline"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black hover:text-blue-600 hover:bg-blue-200 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden bg-white">
        <div class="pt-2 pb-3 space-y-1 px-2">
            @if (Auth::user()->role == 'dokter')
                <x-responsive-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')" class="text-black">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dokter.obat.index')" :active="request()->routeIs('dokter.obat.index')" class="text-black">
                    {{ __('Obat') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dokter.jadwalperiksa.index')" :active="request()->routeIs('dokter.jadwalperiksa.index')" class="text-black">
                    {{ __('Jadwal Periksa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dokter.memeriksa.index')" :active="request()->routeIs('dokter.memeriksa.index')" class="text-black">
                    {{ __('Memeriksa Pasien') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->role == 'pasien')
                <x-responsive-nav-link :href="route('pasien.dashboard')" :active="request()->routeIs('pasien.dashboard')" class="text-black">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pasien.janjiperiksa.index')" :active="request()->routeIs('pasien.janjiperiksa.index')" class="text-black">
                    {{ __('Janji Periksa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pasien.janjiperiksa.index')" :active="request()->routeIs('pasien.janjiperiksa.index')" class="text-black">
                    {{ __('Riwayat Periksa') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-blue-400 px-4">
            <div class="font-medium text-base text-black">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-blue-600">{{ Auth::user()->email }}</div>
        </div>
        <div class="mt-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('profile.edit')" class="text-blue-600 hover:underline">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" class="text-red-600 hover:underline"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
