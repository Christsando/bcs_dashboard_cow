<aside class="fixed left-0 top-0 h-screen bg-white shadow-md transition-all duration-300" x-data="{
    open: localStorage.getItem('sidebar-open') !== 'false'
}"
    @open.window="localStorage.setItem('sidebar-open', open)" :class="open ? 'w-60' : 'w-20'">
    <!-- Toggle Button -->
    <button @click="open = !open; localStorage.setItem('sidebar-open', open)"
        class="absolute -right-4 top-3/4 bg-white border border-gray-300 rounded-full p-2 hover:bg-gray-100 transition-all shadow-md">
        <i class="fa-solid text-gray-600 transition-transform duration-300"
            :class="open ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
    </button>

    <div>
        <div class="p-4 mt-4 flex justify-center">
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center">
                <div :class="open ? 'w-auto' :
                    'w-12 h-12 rounded-lg bg-gradient-to-br flex items-center justify-center flex-shrink-0'"
                    class="transition-all duration-300">
                    <div x-show="open" class="transition-opacity duration-300">
                        <x-application-logo class="h-16 w-auto" />
                    </div>
                    <div x-show="!open" class="text-white font-bold text-lg mt-4">
                        <x-application-logo class="h-12 w-14" />
                    </div>
                </div>
            </a>
        </div>

        <div class="mt-6 flex flex-col space-y-5 ml-7">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="fa-solid fa-house mr-3 text-xl w-5 inline-block text-center"></i>
                <span x-show="open" class="transition-opacity duration-300">{{ __('Dashboard') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('list')" :active="request()->routeIs('list')">
                <i class="fa-solid fa-list mr-3 text-xl w-5 inline-block text-center"></i>
                <span x-show="open" class="transition-opacity duration-300">{{ __('List') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                <i class="fa-solid fa-user mr-3 text-xl w-5 inline-block text-center"></i>
                <span x-show="open" class="transition-opacity duration-300">{{ __('Profile') }}</span>
            </x-nav-link>
        </div>
    </div>
</aside>
