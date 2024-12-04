<x-app-layout>
    <section class="w-11/12 max-w-5xl mx-auto bg-white rounded-lg shadow-lg p-6 mt-8">
        <!-- Header -->
        <div class="border-b pb-4 mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Détails de la dépense</h2>
        </div>

        <!-- Expense Information -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Category -->
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-layer-group text-blue-600 text-xl"></i>
                <p class="text-gray-500">
                    <span class="font-medium text-gray-700">Type :</span> {{ $expense->category->name }}
                </p>
            </div>

            <!-- Price -->
            <div class="flex items-center gap-3">
                <i class="fas fa-money-bill text-green-600 text-xl"></i>
                <p class="text-gray-500">
                    <span class="font-medium text-gray-700">Prix :</span> {{ $expense->amount }} {{ $expense->currency->code }}
                </p>
                <i class="fa-solid fa-arrow-right text-gray-400"></i>
                <p class="text-gray-500">
                    <span class="font-medium text-gray-700">Converti :</span> {{ $convertedAmount }} €
                </p>
            </div>

            <!-- Date -->
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-calendar-days text-yellow-500 text-xl"></i>
                <p class="text-gray-500">
                    <span class="font-medium text-gray-700">Date :</span> {{ $expense->date->format('d-m-Y') }}
                </p>
            </div>

            <!-- Tags -->
            <div class="flex items-start gap-3 flex-wrap">
                <i class="fa-solid fa-tag text-purple-600 text-xl"></i>
                <div class="flex gap-2 flex-wrap">
                    @if ($expense->tags->isEmpty())
                        <p class="text-gray-500 italic">Aucun tag</p>
                    @else
                        @foreach ($expense->tags as $tag)
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-lg text-sm font-medium">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex flex-wrap gap-4">
            <a
                href="{{ route('expense.edit', $expense->id) }}"
                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M...Z"></path>
                </svg>
                Modifier
            </a>
            <form method="post" action="{{ route('expense.delete', $expense->id) }}" class="inline-block">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition"
                >
                    Supprimer
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
