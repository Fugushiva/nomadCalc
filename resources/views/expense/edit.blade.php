<x-app-layout>
    <section>
        <form method="POST" action="{{ route('expense.update', $expense->id) }}">
            @csrf
            @method('PUT')

            <h1 class="text-2xl text-center py-4">Modifier {{ $expense->title }}</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-3/4 mx-auto">
                <div class="flex flex-col">
                    <label for="title" class="text-gray-600">Titre</label>
                    <input type="text" id="title" name="title" class="border border-gray-300 rounded-lg p-2"
                        value="{{ @old('title', $expense->title) }}">
                </div>
                <div class="flex flex-col">
                    <label for="category" class="text-gray-600">Categorie</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $expense->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <!--Show tages here-->
                    <div id="tagsContainer" class="grid grid-rows-3 grid-flow-col gap-4 py-4 cursor-pointer"
                        data-expense-tags="{{ json_encode($expenseTags) }}">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="amount" class="text-gray-600">Montant</label>
                    <input type="number" id="amount" name="amount" class="border border-gray-300 rounded-lg p-2"
                        value={{ old('amount', $expense->amount) }}>
                </div>
                <div class="flex flex-col">
                    <label for="currency" class="text-gray-600">Devise</label>
                    <select name="currency_id" id="currency" class="border border-gray-300 rounded-lg p-2">
                        @foreach ( $currencies as $currency )
                            <option value="{{$currency->id}}"
                                {{old('currency_id', $expense->currency_id) == $currency->id ? 'selected' : ''}}>
                                {{$currency->code}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="date" class="text-gray-600">Date</label>
                    <input type="date" id="date" name="date" class="border border-gray-300 rounded-lg p-2"
                        value={{ @old('date', $expense->date) }}>
                </div>
                <div class="flex flex-col">
                    <label for="description" class="text-gray-600">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="border border-gray-300 rounded-lg p-2" value={{ old('description', $expense->description) }}></textarea>
                </div>
                <div class="flex flex-col">
                    <button class="bg-green-500 text-white p-2 rounded-lg">Modifier</button>
                </div>
        </form>
    </section>
</x-app-layout>
@vite(['resources/js/showTags.js'])
