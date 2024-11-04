<x-app-layout>
    <section class="w-3/4 mx-auto bg-white rounded-lg shadow-lg p-6 mt-8">
        <div class="border-b pb-4 mb-4">
            <div class="flex gap-2">
                <i class="fa-solid fa-layer-group mt-1"></i>
                <p class="text-gray-500">Type : <span class="text-gray-700">{{ $expense->category }}</span></p>
            </div>
            <!--Price-->
            <div class="flex gap-2">
                <i class="fas fa-money-bill mt-1"></i>
                <p class="text-gray-500">Prix : <span class="text-gray-700">{{ $expense->amount }} {{$expense->currency}} </span></p>
                <i class="fa-solid fa-arrow-right mt-1"></i>
                <p> {{$convertedAmount}} €</p>
            </div>
            <!--date-->
            <div class="flex gap-2">
                <i class="fa-solid fa-calendar-days mt-1"></i>
                <p class="text-gray-500">Date : <span class="text-gray-700">{{ $expense->date->format('d-m-Y') }}</span></p>
        </div>
        <div class="flex gap-4">
            <a class="text-blue-600 hover:text-blue-800 font-medium flex items-center" href="{{route('expense.edit', $expense->id)}}">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M...Z"></path></svg>
                Modifier
            </a>
            <form method="post" action="{{route('expense.delete', $expense->id)}}">
                @csrf
                @method('DELETE')
                <input type="submit" value="Supprimer" >
            </form>
        </div>
    </section>
</x-app-layout>
