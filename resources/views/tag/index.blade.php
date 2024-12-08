<x-app-layout>
    <section class="p-4 bg-gray-50">
        <div class="rounded-lg shadow-lg">

            <!-- Tableau visible uniquement sur les écrans classiques -->
            <div class="hidden sm:block">
                <table class="table-auto border-collapse border border-gray-200 w-full text-sm text-left">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            @foreach ($categories as $category)
                                <th class="border border-blue-400 px-6 py-3 text-center font-semibold">
                                    <div class="flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        <span>{{ $category->name }}</span>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-blue-50">
                            @foreach ($categories as $category)
                                <td class="border border-gray-200 px-6 py-4">
                                    <ul class="space-y-2">
                                        @foreach ($category->tags as $tag)
                                            <li class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="flex-1 truncate">{{ $tag->name }}</span>
                                                <form action="{{ route('tag.delete', $tag->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                        type="button" 
                                                        class="bg-transparent text-red-600 p-2 rounded-lg hover:text-red-700 focus:outline-none transition"
                                                        aria-label="Supprimer"
                                                        onclick="confirmDeletion(event, this)"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-1 1v1H4.5a.5.5 0 000 1h11a.5.5 0 000-1H12V3a1 1 0 00-1-1H9zM5 7a1 1 0 011-1h8a1 1 0 011 1v7a3 3 0 01-3 3H8a3 3 0 01-3-3V7z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Cartes visibles uniquement sur mobile -->
            <div class="sm:hidden space-y-4">
                @foreach ($categories as $category)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow">
                        <h3 class="text-lg font-semibold text-blue-600 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span>{{ $category->name }}</span>
                        </h3>
                        <ul class="mt-2 space-y-2">
                            @foreach ($category->tags as $tag)
                                <li class="flex items-center justify-between">
                                    <span class="text-gray-700">{{ $tag->name }}</span>
                                    <form action="{{ route('tag.delete', $tag->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="button" 
                                            class="text-red-600 hover:text-red-700 focus:outline-none transition"
                                            onclick="confirmDeletion(event, this)"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-1 1v1H4.5a.5.5 0 000 1h11a.5.5 0 000-1H12V3a1 1 0 00-1-1H9zM5 7a1 1 0 011-1h8a1 1 0 011 1v7a3 3 0 01-3 3H8a3 3 0 01-3-3V7z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Script de confirmation -->
    <script>
        function confirmDeletion(event, button) {
            event.preventDefault(); // Empêche la soumission immédiate du formulaire
            const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet élément ?");
            if (confirmation) {
                // Trouve le parent formulaire et le soumet
                button.closest("form").submit();
            }
        }
    </script>
</x-app-layout>
