<x-app-layout>
    <section class="p-6 bg-gray-50">
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="table-auto border-collapse border border-gray-200 w-full text-sm text-left">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        @foreach ($categories as $category)
                            <th class="border border-blue-400 px-6 py-3 text-center font-semibold">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Ajouter une icône pour chaque catégorie -->
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
                                            <!-- Ajouter une puce ou icône devant chaque tag -->
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>{{ $tag->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
