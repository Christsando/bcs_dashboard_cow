<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <div>
                <p class="text-xs text-basicfont mb-1">
                    Pages / {{ __('Lists') }}
                </p>
                <h1 class="text-3xl font-bold text-darkblue">
                    {{ __('Lists') }}
                </h1>
            </div>

            <div class="flex items-center gap-6">
                <!-- Notification Bell -->
                <button class="relative text-gray-600 hover:text-gray-900 transition">
                    <i class="fa-solid fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                </button>

                <div x-data="{ open: false }" class="relative">
                    <!-- Profile Button -->
                    <button @click="open = !open"
                        class="h-10 w-10 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center text-white font-bold hover:shadow-lg transition">
                        <i class="fa-solid fa-user text-sm"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-50">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                        </div>

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition flex items-center gap-2">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="px-6 -mt-2">
            <div class="rounded-lg overflow-hidden min-h-[85vh] bg-white overflow-x-auto">
                <div class="flex items-center justify-between pt-6 px-6">
                    <div class="items-center">
                        <h1 class="text-lg font-bold text-darkblue">
                            Body Condition Score - Lists    
                        </h1>
                        <p class="text-xs text-basicfont mb-1">
                            Today - Lists Summary
                        </p>
                    </div>
                    <x-search-bar-list />
                </div>
                <x-table-list-data />
            </div>

            <!-- Pagination -->
            @if (isset($bcsData) && $bcsData->count() > 0)
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $bcsData->firstItem() ?? 0 }} hingga {{ $bcsData->lastItem() ?? 0 }} dari
                        {{ $bcsData->total() }} data
                    </div>

                    @if ($bcsData->hasPages())
                        <div class="flex items-center gap-2">
                            <!-- Previous Button -->
                            @if ($bcsData->onFirstPage())
                                <button disabled class="p-2 text-gray-300 cursor-not-allowed">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                            @else
                                <a href="{{ $bcsData->previousPageUrl() }}"
                                    class="p-2 text-gray-600 hover:text-gray-900 transition">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($bcsData->getUrlRange(1, $bcsData->lastPage()) as $page => $url)
                                @if ($page == $bcsData->currentPage())
                                    <button disabled
                                        class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded cursor-not-allowed">
                                        {{ $page }}
                                    </button>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            <!-- Next Button -->
                            @if ($bcsData->hasMorePages())
                                <a href="{{ $bcsData->nextPageUrl() }}"
                                    class="p-2 text-gray-600 hover:text-gray-900 transition">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            @else
                                <button disabled class="p-2 text-gray-300 cursor-not-allowed">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
