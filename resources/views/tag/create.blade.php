<x-app-layout>
    <section class="p-8 bg-gray-50 min-h-screen flex items-center justify-center">
        <form action="{{route('tag.store')}}" method="post" class="w-full max-w-md bg-white shadow-md rounded-lg p-6 space-y-6">
            @csrf

            <!-- Title -->
            <h2 class="text-2xl font-semibold text-gray-700 text-center">Créer un Tag</h2>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du Tag</label>
                <input 
                    type="text" 
                    placeholder="Entrez le nom du tag" 
                    id="name" 
                    name="name" 
                    required 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                >
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                <select 
                    name="category_id" 
                    id="category_id" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                >
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-300"
                >
                    Créer le Tag
                </button>
            </div>
        </form>
    </section>
</x-app-layout>
