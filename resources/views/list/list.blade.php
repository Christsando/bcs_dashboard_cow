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

    {{-- x-data --}}
    <div class="py-4" x-data="{ openAddModal: false }">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="px-6 mb-4">
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()"
                        class="absolute right-4 text-green-700 hover:text-green-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="px-6 mb-4">
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()"
                        class="absolute right-4 text-red-700 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="px-6 mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- content --}}
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
                    <x-table-list-data :bcsData="$bcsData" />
                </div>
            </div>
        </div>

        <x-add-data-modal-form :show="$errors->any()" />
        {{-- end of x-data --}}
    </div>
</x-app-layout>
