<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <div>
                <p class="text-xs text-basicfont mb-1">
                    Pages / {{ __('Detail') }} / [TAG_ID_SAPI]
                </p>
                <h1 class="text-3xl font-bold text-darkblue">
                    {{ __('Detail') }}
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
            <div class="flex items-center justify-between mb-4">
                <div class="items-center flex gap-4">
                    <i onclick="history.back()"
                        class="fa-solid fa-chevron-left fa-2x text-basicfont cursor-pointer"></i>
                    <div>
                        <h1 class="text-lg font-bold text-darkblue">
                            Body Condition Score - Details
                        </h1>
                        <p class="text-xs text-basicfont mb-1">
                            Today - Body Condition Score (BCS) Summary
                        </p>
                    </div>
                </div>
            </div>

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
                        <img alt="Placeholder Cow Image" class="h-48 w-48">
                    </div>
                </div>
            </div>
            <div class="bg-white h-[320px] rounded-lg lg:col-span-2">
                <div class="pl-4 pt-4">
                    <h1 class="text-lg font-bold text-darkblue">
                        [ID_SAPI] - Condition
                    </h1>
                    <p class="text-xs text-basicfont mb-1">
                        Today - Body Condition Score (BCS) Summary
                    </p>
                </div>
                <div class="flex flex-col px-4"> {{-- Fixed height on mobile, dynamic on desktop --}}
                    <div class="pt-4 flex flex-row gap-6 items-center">
                        <i class="fa-solid fa-circle fa-2x"></i>
                        
                        <div>
                            <p class="text-sm font-semibold text-darkblue">Body Condition Score (BCS)</p>
                            <p class="text-xs text-basicfont">Today - [DD/MM/YYYY]</p>
                        </div>

                        <p  class="text-sm font-semibold text-darkblue"> : 1 (Score) </p>
                    </div>

                    <div class="pt-4 flex flex-row gap-6 items-center">
                        <i class="fa-solid fa-circle fa-2x"></i>
                        
                        <div>
                            <p class="text-sm font-semibold text-darkblue">Need Attention</p>
                            <p class="text-xs text-basicfont">Today - [DD/MM/YYYY]</p>
                        </div>

                        <p  class="text-sm font-semibold text-darkblue"> : 1 (Score) </p>
                    </div>

                    <div class="pt-4 flex flex-col gap-2">
                        <p class="text-lg font-bold text-darkblue">Note :</p>
                        {{-- ganti by data nanti --}}
                        <p  class="text-sm text-basicfont">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, 
                            consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur 
                            adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
