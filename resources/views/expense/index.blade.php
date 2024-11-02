<x-app-layout>
    <section class="w-3/4 mx-auto ">
        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($expenses as $expense)
                <div
                    class="border border-gray-300 rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition-shadow duration-200">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $expense->title }}</h2>
                    <!--Category-->
                    <div class="flex gap-2">
                        <i class="fa-solid fa-layer-group mt-1"></i>
                        <p class="text-gray-500">Type : <span class="text-gray-700">{{ $expense->category }}</span></p>
                    </div>
                    <!--Price-->
                    <div class="flex gap-2">
                        <i class="fas fa-money-bill mt-1"></i>
                        <p class="text-gray-500">Prix : <span class="text-gray-700">{{ $expense->amount }}
                                {{ $expense->currency }}</span></p>
                    </div>
                    <!--date-->
                    <div class="flex gap-2">
                        <i class="fa-solid fa-calendar-days mt-1"></i>
                        <p class="text-gray-500">Date : <span
                                class="text-gray-700">{{ $expense->date->format('d-m-Y') }}</span></p>
                    </div>
                    <a class="text-blue-600 hover:text-blue-800 underline mt-3 inline-block font-medium"
                        href='{{ route('expense.show', $expense) }}'>Voir</a>
                </div>
            @endforeach
        </div>
        <div class="w-fit ">
            <a class="text-l text-green-700 underline p-2" href={{ route('expense.create') }}>Ajouter</a>
        </div>
    </section>
</x-app-layout>
