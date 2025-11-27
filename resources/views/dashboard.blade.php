<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <div>
                <p class="text-xs text-basicfont mb-1">
                    Pages / {{ __('Dashboard') }}
                </p>
                <h1 class="text-3xl font-bold text-darkblue">
                    {{ __('Dashboard') }}
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
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-4">
                <div class="bg-white p-4 rounded-lg lg:col-span-3">
                    <div>
                        <h1 class="text-lg font-bold text-darkblue">
                            Body Condition Score - Graph
                        </h1>
                        <p class="text-xs text-basicfont mb-1">
                            Today - Body Condition Score (BCS) Summary
                        </p>
                    </div>
                    <div class="h-[310px] lg:h-86"> {{-- Fixed height on mobile, dynamic on desktop --}}
                        <canvas id="conditionScoreChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg lg:col-span-2">
                    <div>
                        <h1 class="text-lg font-bold text-darkblue">
                            Body Condition Score - Classification
                        </h1>
                        <p class="text-xs text-basicfont mb-1">
                            Today - Body Condition Score (BCS) Summary
                        </p>
                    </div>
                    <div class="h-[310px] lg:h-86 flex items-center justify-center"> {{-- Fixed height on mobile, dynamic on desktop --}}
                        <canvas id="classificationPieChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg lg:col-span-2">
                <div class="pl-4 pt-4">
                    <h1 class="text-lg font-bold text-darkblue">
                        Body Condition Score - Details
                    </h1>
                    <p class="text-xs text-basicfont mb-1">
                        Today - Body Condition Score (BCS) Summary
                    </p>
                </div>
                <div class="h-[310px] lg:h-86 flex items-center justify-center"> {{-- Fixed height on mobile, dynamic on desktop --}}
                    <x-table-list-dashboard-data/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
