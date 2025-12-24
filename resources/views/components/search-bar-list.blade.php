<div class="flex items-center gap-2">
    {{-- add button --}}
    <x-primary-button @click="$dispatch('open-modal', 'add-bcs-modal')"
        class="flex bg-inactiveblue !rounded-full shadow-md w-10 h-10 cursor-pointer justify-center items-center ">
        <i class="fas fa-plus fa-lg text-white"></i>
    </x-primary-button>

    <div x-data="{ open: false }" class="relative w-full max-w-xs">

        <!-- Search Bar -->
        <div class="flex items-center justify-between w-full">

            <!-- Search capsule -->
            <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-2 w-full max-w-xs">
                <div
                    class="flex items-center flex-grow px-4 py-1 rounded-full border border-[#B9C3D3] bg-white shadow-sm">
                    <i class="fa-solid fa-magnifying-glass text-[#7A8AA1] text-lg"></i>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Tag ID..."
                        class="w-full ml-2 text-sm border-none outline-none focus:ring-0">
                </div>
            </form>


            <!-- Filter Icon -->
            <i @click="open = !open" class="fa-solid fa-sliders text-[#7A8AA1] cursor-pointer text-lg ml-3"></i>
        </div>

        <!-- Filter Dropdown -->
        <div x-show="open" x-transition @click.outside="open = false"
            class="absolute right-0 mt-3 w-64 rounded-xl shadow-xl bg-white p-4 space-y-3">
            @php
                $items = [
                    ['label' => 'Body Condition Score 1', 'color' => '#E4DEFF'],
                    ['label' => 'Body Condition Score 2', 'color' => '#8F7FD5'],
                    ['label' => 'Body Condition Score 3', 'color' => '#4B30C0'],
                    ['label' => 'Body Condition Score 4', 'color' => '#1C0094'],
                    ['label' => 'Body Condition Score 5', 'color' => '#10034B'],
                ];
            @endphp

            @foreach ($items as $item)
                <a href="{{ request()->fullUrlWithQuery(['bcs' => $loop->iteration]) }}"
                    class="flex items-center gap-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $item['color'] }}"></span>
                    <span class="text-[14px] text-[#2F3A4A]">{{ $item['label'] }}</span>
                </a>
            @endforeach

        </div>
    </div>
</div>
