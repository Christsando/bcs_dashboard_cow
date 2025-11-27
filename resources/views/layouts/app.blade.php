<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- Scripts -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/charts/linechart_dashboard.js', 'resources/js/charts/piechart_dashboard.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-softblue" x-data>
            @include('layouts.navigation')

            <!-- Page Heading -->
            <div id="page-container" :class="$el.parentElement.querySelector('aside').classList.contains('w-20') ? 'ml-20' : 'ml-60'">
                @isset($header)
                    <header>
                        <div class="min-w-screen mx-auto -mb-6 py-8 px-4 sm:px-6 lg:px-6">
                            {{ $header }}
                            <hr class="border-t border-gray-300 mt-2">
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            // Reactive margin sync dengan Alpine.js
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.querySelector('aside');
                const pageContainer = document.getElementById('page-container');
                
                if (!sidebar || !pageContainer) return;

                // Fungsi untuk update margin
                const updateMargin = () => {
                    if (sidebar.classList.contains('w-20')) {
                        pageContainer.classList.remove('ml-60');
                        pageContainer.classList.add('ml-20');
                    } else {
                        pageContainer.classList.remove('ml-20');
                        pageContainer.classList.add('ml-60');
                    }
                };

                // Observer untuk deteksi perubahan class di sidebar
                const observer = new MutationObserver(updateMargin);
                observer.observe(sidebar, { 
                    attributes: true, 
                    attributeFilter: ['class'] 
                });

                // Initial call
                updateMargin();
            });
        </script>

        <style>
            #page-container {
                margin-left: 15rem; /* w-60 */
                transition: all 0.3s ease-in-out;
            }

            #page-container.ml-20 {
                margin-left: 5rem;
            }

            #page-container.ml-60 {
                margin-left: 15rem;
            }
        </style>
    </body>
</html>