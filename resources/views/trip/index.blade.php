<x-app-layout>
    <h1 class="text-3xl font-bold text-center text-gray-800 pt-3 mb-5">
        Liste des voyages de {{ Auth::user()->name }}
    </h1>
    <div class="text-center mb-5">
        <a href="{{route('trip.create')}}" class="text-blue-600 underline cursor-pointer text-xl">Ajouter un voyage</a>
    </div>
    <div class="flex flex-wrap justify-center gap-4 w-3/4 mx-auto">
        @foreach($trips as $trip)
        <div class="border border-gray-300 rounded-lg shadow-lg p-5 bg-white w-72">
            <div class="text-center mb-3">
                <h2 class="text-xl font-semibold text-gray-700 mb-1">
                    <i class="fas fa-map-marked-alt text-blue-500"></i> {{$trip->title}}
                </h2>
            </div>
            <div class="text-gray-600 mb-2">
                <p>
                    <i class="fas fa-calendar-alt text-green-500"></i>
                    Départ : {{$trip->start_date->format('d-m-Y')}}
                </p>
                <p>
                    <i class="fas fa-calendar-check text-red-500"></i>
                    Retour : {{$trip->end_date->format('d-m-Y')}}
                </p>
            </div>
            <div class="text-gray-600 mb-4">
                <span>
                    <i class="fas fa-users text-purple-500"></i> Voyageurs :
                    {{ $trip->users->pluck('name')->join(', ') }}
                </span>
            </div>
            <div class="mt-4">
                <button onclick="copyInviteLink('{{ route('trip.invite', ['invite_token' => $trip->invite_token]) }}')"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg py-2 px-4 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                    <i class="fas fa-link"></i> Générer le lien
                </button>
            </div>
        </div>
    @endforeach
    
    </div>
    <script>
        function copyInviteLink(link) {
            navigator.clipboard.writeText(link)
                .then(() => {
                    alert("Lien d'invitation copié !");
                })
                .catch(err => {
                    console.error("Erreur lors de la copie du lien : ", err);
                    alert("Impossible de copier le lien.");
                });
        }
    </script>
</x-app-layout>
