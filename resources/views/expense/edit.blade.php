<x-app-layout>
    <section>
        <form method="POST" action="{{route('expense.update', $expense->id)}}">
            @csrf
            @method('PUT')
            
            <h1 class="text-2xl text-center py-4">Modifier {{$expense->title}}</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-3/4 mx-auto">
                <div class="flex flex-col">
                    <label for="title" class="text-gray-600">Titre</label>
                    <input type="text" id="title" name="title" class="border border-gray-300 rounded-lg p-2" value="{{ @old('title', $expense->title) }}">
                </div>
                <div class="flex flex-col">
                    <label for="category" class="text-gray-600">Categorie</label>
                    <select name="category" id="category" class="border border-gray-300 rounded-lg p-2">
                        <option value="alimentation" {{ old('category', $expense->category) == 'alimentation' ? 'selected' : '' }}>Alimentation</option>
                        <option value="transport" {{ old('category', $expense->category) == 'transport' ? 'selected' : '' }}>Transport</option>
                        <option value="logement" {{ old('category', $expense->category) == 'logement' ? 'selected' : '' }}>Logement</option>
                        <option value="loisir" {{ old('category', $expense->category) == 'loisir' ? 'selected' : '' }}>Loisir</option>
                        <option value="santé" {{ old('category', $expense->category) == 'santé' ? 'selected' : '' }}>Santé</option>
                        <option value="autre" {{ old('category', $expense->category) == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>
                
                <div class="flex flex-col">
                    <label for="amount" class="text-gray-600">Montant</label>
                    <input type="number" id="amount" name="amount" class="border border-gray-300 rounded-lg p-2" value={{old('amount', $expense->amount)}}>
                </div>
                <div class="flex flex-col">
                    <label for="currency" class="text-gray-600">Devise</label>
                    <select name="currency" id="currency" class="border border-gray-300 rounded-lg p-2">
                        <option value="THB" {{old('currency', $expense->currency) == 'THB' ? 'selected' : ''}}>THB</option>
                        <option value="CNY" {{old('currency', $expense->currency) == 'CNY' ? 'selected' : ''}}>CNY</option>
                        <option value="EUR" {{old('currency', $expense->currency) == 'EUR' ? 'selected' : ''}}>EUR</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="date" class="text-gray-600">Date</label>
                    <input type="date" id="date" name="date" class="border border-gray-300 rounded-lg p-2" value={{ @old('date', $expense->date) }}>
                </div>
                <div class="flex flex-col">
                    <label for="description" class="text-gray-600">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="border border-gray-300 rounded-lg p-2" value={{ old('description', $expense->description)}}></textarea>
                </div>
                <div class="flex flex-col">
                    <button class="bg-green-500 text-white p-2 rounded-lg">Modifier</button>
                </div>
        </form>
    </section>
</x-app-layout>