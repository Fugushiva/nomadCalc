<x-app-layout>
    <section>
        <form method="POST" action="{{route('expense.store')}}">
            @csrf
            
            <h1 class="text-2xl text-center py-4">Ajouter une Dépense</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-3/4 mx-auto">
                <div class="flex flex-col">
                    <label for="title" class="text-gray-600">Titre</label>
                    <input type="text" id="title" name="title" class="border border-gray-300 rounded-lg p-2">
                </div>
                <div class="flex flex-col">
                    <label for="category" class="text-gray-600">Categorie</label>
                    <select name="category" id="category" class="border border-gray-300 rounded-lg p-2">
                        <option value="alimentation">Alimentation</option>
                        <option value="transport">Transport</option>
                        <option value="logement">Logement</option>
                        <option value="loisir">Loisir</option>
                        <option value="santé">Santé</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                
                <div class="flex flex-col">
                    <label for="amount" class="text-gray-600">Montant</label>
                    <input type="number" id="amount" name="amount" class="border border-gray-300 rounded-lg p-2">
                </div>
                <div class="flex flex-col">
                    <label for="currency" class="text-gray-600">Devise</label>
                    <select name="currency" id="currency" class="border border-gray-300 rounded-lg p-2">
                        <option value="THB">THB</option>
                        <option value="CNY">CNY</option>
                        <option value="EUR">EUR</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="date" class="text-gray-600">Date</label>
                    <input type="date" id="date" name="date" class="border border-gray-300 rounded-lg p-2">
                </div>
                <div class="flex flex-col">
                    <label for="description" class="text-gray-600">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="border border-gray-300 rounded-lg p-2"></textarea>
                </div>
                <div class="flex flex-col">
                    <button class="bg-green-500 text-white p-2 rounded-lg">Ajouter</button>
                </div>
        </form>
    </section>
</x-app-layout>