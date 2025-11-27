<div x-data="{ open: false }" class="relative w-full max-w-xs">
    <!-- Search Bar -->
    <div class="flex items-center justify-between w-full">

        <!-- Search capsule -->
        <div class="flex items-center flex-grow px-4 py-1 rounded-full border border-[#B9C3D3] bg-white shadow-sm">
            <i class="fa-solid fa-magnifying-glass text-[#7A8AA1] text-lg"></i>

            <input type="text" placeholder="Search..."
                class="w-full ml-2 text-sm border-none outline-none focus:ring-0 placeholder-[#AAB5C4]">
        </div>

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
            <div class="flex items-center gap-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                <span class="w-3 h-3 rounded-full" style="background-color: {{ $item['color'] }}">
                </span>
                <span class="text-[14px] text-[#2F3A4A]">{{ $item['label'] }}</span>
            </div>
        @endforeach
    </div>
</div>
