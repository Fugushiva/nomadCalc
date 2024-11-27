<x-app-layout>
    <h1 class="text-3xl font-bold text-center text-gray-800 pt-3 mb-5">
        Ajouter un nouveau voyage
    </h1>
    <form method="post" action="{{route('trip.store')}}" class="w-3/4 mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <!-- Titre -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">
                <i class="fas fa-font text-blue-500"></i> Titre du voyage
            </label>
            <input
                type="text"
                name="title"
                id="title"
                placeholder="Titre du voyage"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                required
            >
        </div>
        <!-- Date de début -->
        <div class="mb-4">
            <label for="start_date" class="block text-gray-700 font-medium mb-2">
                <i class="fas fa-calendar-alt text-green-500"></i> Date de début
            </label>
            <input
                type="date"
                name="start_date"
                id="start_date"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                required
            >
        </div>
        <!-- Date de fin -->
        <div class="mb-4">
            <label for="end_date" class="block text-gray-700 font-medium mb-2">
                <i class="fas fa-calendar-check text-red-500"></i> Date de fin
            </label>
            <input
                type="date"
                name="end_date"
                id="end_date"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400"
                required
            >
        </div>
        <!-- Bouton de soumission -->
        <div class="text-center">
            <button
                type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
                <i class="fas fa-paper-plane"></i> Ajouter le voyage
            </button>
        </div>
    </form>
</x-app-layout>
