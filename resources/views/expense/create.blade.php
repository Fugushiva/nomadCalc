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
                    <select name="category_id" id="category" class="border border-gray-300 rounded-lg p-2">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <!--Show tags here-->
                    <div id="tagsContainer" class="grid grid-rows-3 grid-flow-col gap-4 py-4 cursor-pointer  ">
                       
                    </div>
                </div>
                <!--amount-->
                <div class="flex flex-col">
                    <label for="amount" class="text-gray-600">Montant</label>
                    <input type="number" id="amount" name="amount" class="border border-gray-300 rounded-lg p-2">
                </div>
                <!--Currency-->
                <div class="flex flex-col">
                    <label for="currency" class="text-gray-600">Devise</label>
                    <select name="currency_id" id="currency" class="border border-gray-300 rounded-lg p-2">
                        @foreach ($currencies as $currency )
                            <option value="{{$currency->id}}">{{$currency->name}}</option>                            
                        @endforeach
                    </select>
                </div>
                <!--date-->
                <div class="flex flex-col">
                    <label for="date" class="text-gray-600">Date</label>
                    <input type="date" id="date" name="date" class="border border-gray-300 rounded-lg p-2">
                </div>
                <!--Trip-->
                <div>
                    <label for="trip">Voyage</label>
                    <select name="trip_id" id="trip" class="border border-gray-300 rounded-lg p-2">
                        @foreach ($trips as $trip)
                            <option value="{{$trip->id}}">{{$trip->title}}</option>
                        @endforeach
                    </select>
                </div>
                <!--description-->
                <div class="flex flex-col">
                    <label for="description" class="text-gray-600">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="border border-gray-300 rounded-lg p-2"></textarea>
                </div>
            </div>
            <!--Bouton d'envoi-->
                <div class="flex flex-col mx-auto w-6/12 mt-4">
                    <button class="bg-green-500 text-white p-2 rounded-lg">Ajouter</button>
                </div>
        </form>
    </section>
</x-app-layout>
@vite(['resources/js/showTags.js'])
