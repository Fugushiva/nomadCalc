<x-app-layout>
    <section class="w-11/12 max-w-7xl mx-auto py-8">
        <!-- Search Form -->
        <div class="mt-4 bg-gray-100 p-6 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Rechercher des dépenses</h2>
            <form 
                method="get" 
                action="{{ route('expense.search') }}" 
                class="flex flex-wrap gap-4 items-center lg:flex-nowrap"
            >
                @csrf
                <!-- Title -->
                <div class="flex-none w-full lg:w-auto">
                    <input
                        type="text"
                        name="title"
                        placeholder="Titre"
                        class="w-[250px] p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300"
                    />
                </div>
                <!-- Category -->
                <div class="flex-none w-full lg:w-auto">
                    <select
                        name="category"
                        class="w-[250px] p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300"
                    >
                        <option>Faites votre choix</option>
                        <option>------------------</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Price Range -->
                <div class="flex gap-4 flex-wrap lg:flex-nowrap">
                    <div class="flex-none">
                        <input
                            type="number"
                            name="price[]"
                            placeholder="Min (€)"
                            class="w-[120px] p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300"
                        />
                    </div>
                    <div class="flex-none">
                        <input
                            type="number"
                            name="price[]"
                            placeholder="Max (€)"
                            class="w-[120px] p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300"
                        />
                    </div>
                </div>
                <!-- Date Range -->
                <div class="flex gap-4 flex-wrap lg:flex-nowrap">
                    <div class="flex-none">
                        <label class="block text-sm font-medium text-gray-700">De</label>
                        <input
                            type="date"
                            name="schedule[]"
                            class="w-[150px] p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300"
                        />
                    </div>
                    <div class="flex-none">
                        <label class="block text-sm font-medium text-gray-700">À</label>
                        <input
                            type="date"
                            name="schedule[]"
                            class="w-[150px] p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300"
                        />
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="flex-none">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-500 transition-all"
                    >
                        Rechercher
                    </button>
                </div>
            </form>
        </div>

        <!-- Actions -->
        <div class="flex flex-wrap mt-6 gap-4 items-center justify-between">
            <a
                href="{{ route('expense.create') }}"
                class="text-green-600 hover:text-green-800 underline font-semibold"
            >
                Ajouter une dépense
            </a>
            <a
                href="{{ route('expense.download') }}"
                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-800"
            >
                Télécharger en CSV
            </a>
        </div>

        <!-- Expenses List -->
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($expenses->isNotEmpty())
                @foreach ($expenses as $expense)
                    <div class="border border-gray-200 rounded-lg shadow-sm p-6 bg-white hover:shadow-md transition-shadow duration-200">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $expense->title }}</h2>
                        <!-- Category -->
                        <div class="flex items-center gap-2 mt-2">
                            <i class="fa-solid fa-layer-group text-blue-600"></i>
                            <p class="text-gray-600">
                                Type : <span class="text-gray-800">{{ $expense->category->name }}</span>
                            </p>
                        </div>
                        <!-- Price -->
                        <div class="flex items-center gap-2 mt-2">
                            <i class="fas fa-money-bill text-green-600"></i>
                            <p class="text-gray-600">
                                Prix : <span class="text-gray-800">{{ $expense->amount }} {{ $expense->currency->code }}</span>
                            </p>
                        </div>
                        <!-- Date -->
                        <div class="flex items-center gap-2 mt-2">
                            <i class="fa-solid fa-calendar-days text-yellow-600"></i>
                            <p class="text-gray-600">
                                Date : <span class="text-gray-800">{{ $expense->date->format('d-m-Y') }}</span>
                            </p>
                        </div>
                        <a
                            href="{{ route('expense.show', $expense) }}"
                            class="text-blue-600 hover:text-blue-800 underline mt-4 inline-block font-medium"
                        >
                            Voir
                        </a>
                    </div>
                @endforeach
            @else
                <div class="bg-red-100 border border-red-400 p-4 rounded text-center">
                    <p>Aucune dépense avec ce(s) critère(s).</p>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
