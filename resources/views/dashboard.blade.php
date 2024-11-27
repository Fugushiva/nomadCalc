<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4">
        <!-- Last Week Expenses -->
        <div class="py-12">
            <div class="max-w-3xl sm:px-6 lg:px-8 mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold text-blue-600">
                            Dépense de la semaine : {{$exchangeRate}} €
                        </h2>
                        <hr class="my-4 border-gray-300">
                        <div id='showCategories'>
                            <canvas id="chartCanva"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today Expenses -->
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-50 overflow-hidden shadow-lg rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-semibold text-blue-600 flex items-center gap-2">
                            <i class="fas fa-wallet text-blue-500"></i> Dépenses de la journée
                        </h2>
                        <hr class="my-4 border-gray-300">
                        <div class="flex flex-col-reverse gap-4">
                            @foreach ($todayExpenses as $expense)
                                <div class="flex items-center border border-gray-300 rounded-lg p-4 gap-4 bg-white shadow-sm">
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-tag text-green-500"></i>
                                        <h2 class="font-medium text-lg">{{$expense->title}}</h2>
                                    </div>
                                    <p class="text-gray-400">|</p>
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-euro-sign text-yellow-500"></i>
                                        <p class="font-medium">{{$expense->converted_amount}} €</p>
                                    </div>
                                    <p class="text-gray-400">|</p>
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-folder text-blue-500"></i>
                                        <p class="font-medium">{{$expense->category->name}}</p>
                                    </div>
                                    <p class="text-gray-400">|</p>
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-user text-purple-500"></i>
                                        <p class="font-medium">{{$expense->user->name}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr class="my-4 border-gray-300">
                        <div class="flex items-center justify-between text-xl font-semibold">
                            <span>Total :</span>
                            <span class="text-green-600">{{$todayConvertedAmount}} €</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite(['resources/js/showChart.js'])
