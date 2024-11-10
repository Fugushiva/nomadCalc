<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl  sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl ">Dépense de la semaine : {{$exchangeRate}} € </h2>
                    <hr>
                    <div id='showCategories'>
                        <canvas id="chartCanva">

                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite(['resources/js/showChart.js'])
