@props(['search' => false])
<header class="flex justify-between items-center space-x-5 text-slate-900 pl-10 pr-10 pt-1">
    {{-- Logo --}}
    <a href="{{ route('index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-16">
            <path
                d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
            <path
                d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
        </svg>
    </a>
    {{-- Formulaire de recherche --}}

    <form action=""
        class="pb-3 pr-2 flex items-center border-b border-b-slate-300 text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900 transition">
        <input id="search" value="{{ request()->search }}"
            class="px-2 w-full outline-none leading-none placeholder-slate-400" type="search" name="search"
            placeholder="Rechercher un article">
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd"
                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </form>
    {{-- Navigation --}}

    <nav x-data="{ open: false }" x-cloak class="relative w-1/4">
        <div class="flex justify-end">
            @auth
                <div class="flex flex-col items-end">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <span class="mr-2 text-2xs">{{ Auth::user()->email }}</span>
                </div>
            @endauth

            <button @click="open = !open" @click.outside="open = false" @class([
                'mt-1.5 w-8 h-8 flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
                'md:hidden' => Auth::guest(),
            ])>
                @auth
                    {{-- <img class="h-8 w-8 rounded-full" src="{{ asset('images/profile.png') }}" alt="Image de profil"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class=" p-1 rounded-full text-slate-50 bg-indigo-700"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M5.5 21h13a2 2 0 0 0 2 -2c0 -4.418 -3.582 -8 -8 -8s-8 3.582 -8 8a2 2 0 0 0 2 2z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                @endauth
            </button>
        </div>

        @auth
            <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" @class([
                    'absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-0 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none',
                    'md:hidden' => Auth::guest(),
                ]) tabindex="-1">
                <li>
                    <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon compte</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        @csrf
                        <button class="block text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </li>
            </ul>
        @endauth

        @guest
            <ul class="hidden md:flex space-x-12 font-semibold">
                <li><a href="{{ route('login') }}">Sign in</a></li>
                <li>
                    <a href="{{ route('register') }}" class="flex items-center group text-indigo-700">
                        Sign up
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6 mx-1 group-hover:ml-2 group-hover:mr-0 transition-all">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </li>
            </ul>
        @endguest
    </nav>

</header>
