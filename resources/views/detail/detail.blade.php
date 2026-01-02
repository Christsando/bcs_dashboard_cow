<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <div>
                <p class="text-xs text-basicfont mb-1">
                    Pages / {{ __('Detail') }} / {{ $cow->tag_id }}
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
                        <canvas id="detailConditionScoreChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg lg:col-span-2">
                    <div>
                        <h1 class="text-lg font-bold text-darkblue">
                            Body Condition Score - Image
                        </h1>
                        <p class="text-xs text-basicfont mb-1">
                            Today - Body Condition Score (BCS) Summary
                        </p>
                    </div>
                    {{-- <div class="h-[310px] lg:h-86 flex items-center justify-center">
                        <img src="{{ asset($cow->cow_img_path) }}" alt="Placeholder Cow Image" class="h-48 w-48">
                    </div> --}}
                    @php
                        $imageUrl =
                            $cow->image_source === 'dataset'
                                ? asset($cow->cow_img_path)
                                : Storage::url($cow->cow_img_path);
                    @endphp

                    <div class="h-[310px] lg:h-86 flex items-center justify-center">
                        <img src="{{ $imageUrl }}" class="h-48 w-48 object-cover" alt="Cow Image">
                    </div>

                </div>
            </div>
            <div class="bg-white h-[410px] lg:h-[375px] rounded-lg lg:col-span-2">
                <div class="pl-4 pt-4">
                    <h1 class="text-lg font-bold text-darkblue">
                        {{ $cow->tag_id }} - Condition
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
                            <p class="text-xs text-basicfont">Today - {{ $latestBCS->assessment_date }}</p>
                        </div>

                        <p class="text-sm font-semibold text-darkblue"> : {{ $latestBCS->bcs_score ?? '-' }} (BodyCondition Score) </p>
                    </div>

                    <div class="pt-4 flex flex-row gap-6 items-center">
                        <i class="fa-solid fa-circle fa-2x"></i>

                        <div>
                            <p class="text-sm font-semibold text-darkblue">Need Attention</p>
                            <p class="text-xs text-basicfont">Today - {{ $latestBCS->assessment_date }}</p>
                        </div>

                        <p class="text-sm font-semibold text-darkblue"> : {{ $latestBCS->attention_text ?? '-' }}</p>
                    </div>

                    <div class="pt-4 flex flex-col gap-2">
                        <p class="text-lg font-bold text-darkblue">Note :</p>

                        @if ($latestBCS)
                            <form action="{{ route('bcs.notes.update', $latestBCS->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <textarea name="notes" rows="3"
                                    class="w-full rounded-lg border border-gray-300 p-3 text-sm text-basicfont focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent"
                                    placeholder="Tulis catatan kondisi sapi di sini...">{{ old('notes', $latestBCS->notes) }}</textarea>

                                <button type="submit"
                                    class="mt-2 px-4 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                                    Save Notes
                                </button>
                            </form>
                        @else
                            <p class="text-sm text-gray-500">Belum ada data BCS</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
</x-app-layout>

<script>
    window.COW_ID = {{ $cow->id }};
</script>
