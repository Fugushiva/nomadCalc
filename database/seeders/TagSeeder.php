<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Tag::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $tags = [
            //Logement 
            ['categoryName' => 'logement','name'=> 'Hôtel'],
            ['categoryName' => 'logement','name'=> 'Luxe'],
            ['categoryName' => 'logement','name'=> 'Économique'],
            ['categoryName' => 'logement','name'=> 'Nuitée supplémentaire'],
            ['categoryName' => 'logement','name'=> 'Airbnb'],
            //Alimentation
            ['categoryName' => 'alimentation','name'=> 'Restaurant'],
            ['categoryName' => 'alimentation','name'=> 'Café'],
            ['categoryName' => 'alimentation','name'=> 'CofeeShop'],
            ['categoryName' => 'alimentation','name'=> 'Fast-food'],
            ['categoryName' => 'alimentation','name'=> 'Snack'],
            ['categoryName' => 'alimentation','name'=> 'Super marché'],
            ['categoryName' => 'alimentation','name'=> 'Petit déjeuner'],
            ['categoryName' => 'alimentation','name'=> 'Déjeuner'],
            ['categoryName' => 'alimentation','name'=> 'Dîner'],
            ['categoryName' => 'alimentation','name'=> 'Déjeuner'],
            ['categoryName' => 'alimentation','name'=> 'Livraison'],
            ['categoryName' => 'alimentation','name'=> 'Boissons'],
            ['categoryName' => 'alimentation','name'=> 'Street Food'],
            ['categoryName' => 'alimentation','name'=> 'Western food'],
            //Transoports
            ['categoryName' => 'transport','name'=> 'Avion'],
            ['categoryName' => 'transport','name'=> 'Train'],
            ['categoryName' => 'transport','name'=> 'Bus'],
            ['categoryName' => 'transport','name'=> 'Metro'],
            ['categoryName' => 'transport','name'=> 'Taxi'],
            ['categoryName' => 'transport','name'=> 'Location'],
            ['categoryName' => 'transport','name'=> 'Scooter'],
            ['categoryName' => 'transport','name'=> 'Velo'],
            ['categoryName' => 'transport','name'=> 'parking'],
            ['categoryName' => 'transport','name'=> 'Ferry'],
            ['categoryName' => 'transport','name'=> 'SpeedBoat'],
            //Loisirs
            ['categoryName' => 'loisir','name'=> 'Musée'],
            ['categoryName' => 'loisir','name'=> 'Excursion'],
            ['categoryName' => 'loisir','name'=> "Parc d'atraction"],
            ['categoryName' => 'loisir','name'=> "Cinéma"],
            ['categoryName' => 'loisir','name'=> "Concert"],
            ['categoryName' => 'loisir','name'=> "Cocktails"],
            ['categoryName' => 'loisir','name'=> "Bières"],
            ['categoryName' => 'loisir','name'=> "Date"],
            ['categoryName' => 'loisir','name'=> "Plage"],
            ['categoryName' => 'loisir','name'=> "Spectacle"],
            ['categoryName' => 'loisir','name'=> "Massage"],
            ['categoryName' => 'loisir','name'=> "Plongée"],
            //santé
            ['categoryName' => 'santé','name'=> "Pharmacie"],
            ['categoryName' => 'santé','name'=> "Consultation médicale"],
            ['categoryName' => 'santé','name'=> "Médicaments"],
            ['categoryName' => 'santé','name'=> "Premiers secours"],
            ['categoryName' => 'santé','name'=> "Assurance santé"],
            ['categoryName' => 'santé','name'=> "Vaccins"],
            ['categoryName' => 'santé','name'=> "Hopital"],
            ['categoryName' => 'santé','name'=> "Urgence"],
            //autre
            ['categoryName' => 'autre','name'=> 'Souvenirs'],
            ['categoryName' => 'autre','name'=> 'Cadeau'],
            ['categoryName' => 'autre','name'=> 'Guide'],
            ['categoryName' => 'autre','name'=> 'Pourboire'],
            ['categoryName' => 'autre','name'=> 'Frais'],
            ['categoryName' => 'autre','name'=> 'Téléphone'],
            ['categoryName' => 'autre','name'=> 'Achats imprévus'],
            ['categoryName' => 'autre','name'=> 'Utilitaires'],
        ];

        foreach ($tags as &$tag) {
            $category = Category::where('name', '=', $tag['categoryName'])->first();

            $tag['category_id'] = $category->id;
            unset($tag['categoryName']);
        }

        Tag::insert($tags);
    }
}
