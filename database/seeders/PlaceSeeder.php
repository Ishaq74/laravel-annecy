<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\AmenityGroup;
use App\Models\Category;
use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// Fonctions de traduction manuelle pour les lieux
function translate_place_name($nameFr, $lang) {
    $map = [
        // Activités
        'Le Semnoz' => ['en' => 'Semnoz Mountain', 'ar' => 'جبل سيمنوز'],
        'Mont Veyrier' => ['en' => 'Mount Veyrier', 'ar' => 'جبل فييري'],
        'Forêt de la Grande Jeanne' => ['en' => 'Grande Jeanne Forest', 'ar' => 'غابة جان الكبرى'],
        'Trail du Roc de Chère' => ['en' => 'Roc de Chère Trail', 'ar' => 'مسار روك دو شير'],
        'Trail du Parmelan' => ['en' => 'Parmelan Trail', 'ar' => 'مسار بارميلان'],
        'Trail du Fier' => ['en' => 'Fier Trail', 'ar' => 'مسار فيير'],
        'Piste cyclable du Lac' => ['en' => 'Lake Bike Path', 'ar' => 'مسار الدراجات حول البحيرة'],
        'Boucle des Aravis' => ['en' => 'Aravis Loop', 'ar' => 'حلقة أرَافيس'],
        'Circuit du Pâquier' => ['en' => 'Pâquier Circuit', 'ar' => 'دائرة باكييه'],
        'Club Nautique d’Annecy' => ['en' => 'Annecy Nautical Club', 'ar' => 'نادي أنسي البحري'],
        'Base Nautique des Marquisats' => ['en' => 'Marquisats Water Base', 'ar' => 'قاعدة ماركيسات المائية'],
        'Wake Annecy' => ['en' => 'Wake Annecy', 'ar' => 'ويك أنسي'],
        'Parapente Col de la Forclaz' => ['en' => 'Forclaz Pass Paragliding', 'ar' => 'بارابنت كول دو لا فوركلاز'],
        'Parapente Talloires' => ['en' => 'Talloires Paragliding', 'ar' => 'بارابنت تالوار'],
        'Parapente Doussard' => ['en' => 'Doussard Paragliding', 'ar' => 'بارابنت دوسار'],
        'Site d’Escalade du Biclop' => ['en' => 'Biclop Climbing Site', 'ar' => 'موقع التسلق بيكلوب'],
        'Mur d’Escalade La Salle' => ['en' => 'La Salle Climbing Wall', 'ar' => 'جدار التسلق لا سال'],
        'Falaise de la Grande Jeanne' => ['en' => 'Grande Jeanne Cliff', 'ar' => 'جرف جان الكبرى'],
        'Golf Club d’Annecy' => ['en' => 'Annecy Golf Club', 'ar' => 'نادي الغولف أنسي'],
        'Mini-Golf du Pâquier' => ['en' => 'Pâquier Mini-Golf', 'ar' => 'ميني غولف باكييه'],
        'Golf Talloires' => ['en' => 'Talloires Golf', 'ar' => 'غولف تالوار'],
        'Yoga Studio Annecy' => ['en' => 'Annecy Yoga Studio', 'ar' => 'استوديو اليوغا أنسي'],
        'Yoga du Lac' => ['en' => 'Lake Yoga', 'ar' => 'يوغا البحيرة'],
        'Yoga Harmonie' => ['en' => 'Harmony Yoga', 'ar' => 'يوغا هارموني'],
        'Bloc Session' => ['en' => 'Bloc Session', 'ar' => 'بلوك سيشن'],
        'Vertical’Art Annecy' => ['en' => 'Vertical’Art Annecy', 'ar' => 'فيرتيكال آرت أنسي'],
        'Climb Up Annecy' => ['en' => 'Climb Up Annecy', 'ar' => 'تسلق أنسي'],
        'Fitness Park Annecy' => ['en' => 'Fitness Park Annecy', 'ar' => 'فيتنس بارك أنسي'],
        'Basic-Fit Annecy' => ['en' => 'Basic-Fit Annecy', 'ar' => 'بيزيك فيت أنسي'],
        'L’Orange Bleue' => ['en' => 'L’Orange Bleue', 'ar' => 'البرتقالة الزرقاء'],
        'Piscine des Marquisats' => ['en' => 'Marquisats Pool', 'ar' => 'مسبح ماركيسات'],
        'Piscine Jean Régis' => ['en' => 'Jean Régis Pool', 'ar' => 'مسبح جان ريجي'],
        'Piscine de Seynod' => ['en' => 'Seynod Pool', 'ar' => 'مسبح سينود'],
        'Bowling d’Annecy' => ['en' => 'Annecy Bowling', 'ar' => 'بولينغ أنسي'],
        'Bowling Seynod' => ['en' => 'Seynod Bowling', 'ar' => 'بولينغ سينود'],
        'Bowling Le Strike' => ['en' => 'Le Strike Bowling', 'ar' => 'بولينغ لو سترايك'],
        // Gastronomie, Hébergements, etc. (à compléter selon besoin)
    ];
    return $map[$nameFr][$lang] ?? $nameFr;
}

function translate_address($addressFr, $lang) {
    // Pour simplifier, on garde l'adresse telle quelle en EN et AR
    return $addressFr;
}

function translate_place_description($nameFr, $addressFr, $catName, $lang) {
    if ($lang === 'en') {
        return translate_place_name($nameFr, 'en') . ' located at ' . translate_address($addressFr, 'en') . ' in the category ' . $catName . '.';
    } elseif ($lang === 'ar') {
        return translate_place_name($nameFr, 'ar') . ' في ' . translate_address($addressFr, 'ar') . ' ضمن فئة ' . $catName . '.';
    }
    return $nameFr . ' situé à ' . $addressFr . ' dans la catégorie ' . $catName . '.';
}

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('username', 'super_admin')->firstOrFail();

        // Lieux réels pour chaque sous-catégorie feuille
        $realPlaces = [
            // Activités
            'Randonnée' => [
                ['Le Semnoz', 'Route du Semnoz, Annecy'],
                ['Mont Veyrier', 'Chemin du Mont Veyrier, Annecy'],
                ['Forêt de la Grande Jeanne', 'Route de la Grande Jeanne, Annecy'],
            ],
            'Trails' => [
                ['Trail du Roc de Chère', 'Chemin du Roc de Chère, Annecy'],
                ['Trail du Parmelan', 'Route du Parmelan, Annecy'],
                ['Trail du Fier', 'Chemin du Fier, Annecy'],
            ],
            'Cyclisme' => [
                ['Piste cyclable du Lac', 'Quai des Clarisses, Annecy'],
                ['Boucle des Aravis', 'Route des Aravis, Annecy'],
                ['Circuit du Pâquier', 'Avenue du Pâquier, Annecy'],
            ],
            'Sports nautiques' => [
                ['Club Nautique d’Annecy', '1 Avenue du Petit Port, Annecy'],
                ['Base Nautique des Marquisats', '30 Rue des Marquisats, Annecy'],
                ['Wake Annecy', '15 Chemin de la Prairie, Annecy'],
            ],
            'Parapente' => [
                ['Parapente Col de la Forclaz', 'Route du Col de la Forclaz, Annecy'],
                ['Parapente Talloires', 'Chemin des Granges, Annecy'],
                ['Parapente Doussard', 'Route de la Plage, Annecy'],
            ],
            'Escalade' => [
                ['Site d’Escalade du Biclop', 'Chemin du Biclop, Annecy'],
                ['Mur d’Escalade La Salle', '22 Rue des Alpins, Annecy'],
                ['Falaise de la Grande Jeanne', 'Route de la Grande Jeanne, Annecy'],
            ],
            'Golf' => [
                ['Golf Club d’Annecy', '1 Chemin du Golf, Annecy'],
                ['Mini-Golf du Pâquier', 'Avenue du Pâquier, Annecy'],
                ['Golf Talloires', 'Route du Golf, Annecy'],
            ],
            'Yoga' => [
                ['Yoga Studio Annecy', '10 Rue Sommeiller, Annecy'],
                ['Yoga du Lac', '5 Quai des Clarisses, Annecy'],
                ['Yoga Harmonie', '18 Avenue de Genève, Annecy'],
            ],
            'Escalade en salle' => [
                ['Bloc Session', '22 Rue des Alpins, Annecy'],
                ['Vertical’Art Annecy', '8 Rue de la Bouverie, Annecy'],
                ['Climb Up Annecy', '15 Avenue du Rhône, Annecy'],
            ],
            'Fitness' => [
                ['Fitness Park Annecy', '20 Avenue de Genève, Annecy'],
                ['Basic-Fit Annecy', '12 Rue Carnot, Annecy'],
                ['L’Orange Bleue', '5 Rue Royale, Annecy'],
            ],
            'Piscine' => [
                ['Piscine des Marquisats', '30 Rue des Marquisats, Annecy'],
                ['Piscine Jean Régis', '90 Avenue des Iles, Annecy'],
                ['Piscine de Seynod', '1 Rue du Stade, Annecy'],
            ],
            'Bowling' => [
                ['Bowling d’Annecy', '17 Avenue du Rhône, Annecy'],
                ['Bowling Seynod', '2 Rue du Pré Faucon, Annecy'],
                ['Bowling Le Strike', '8 Rue de la Bouverie, Annecy'],
            ],
            // Gastronomie
            'Traditionnels' => [
                ['Restaurant La Table d’Elise', '4 Rue Sainte-Claire, Annecy'],
                ['Restaurant Le Freti', '12 Rue Sainte-Claire, Annecy'],
                ['Restaurant Le Denti', '5 Rue Royale, Annecy'],
            ],
            'Gastronomiques' => [
                ['Restaurant Yoann Conte', '13 Vieille Route des Pensières, Annecy'],
                ['Restaurant L’Auberge du Père Bise', '303 Route du Port, Talloires'],
                ['Restaurant Vincent Favre-Félix', '8 Avenue du Rhône, Annecy'],
            ],
            'Fast-food' => [
                ['McDonald’s Annecy', '1 Avenue du Rhône, Annecy'],
                ['Burger King Annecy', '10 Avenue de Genève, Annecy'],
                ['Quick Annecy', '15 Rue Carnot, Annecy'],
            ],
            'Brasseries' => [
                ['Brasserie des Européens', '1 Place de l’Hôtel de Ville, Annecy'],
                ['Brasserie Saint Maurice', '8 Rue Saint-Maurice, Annecy'],
                ['Brasserie du Lac', '2 Quai des Clarisses, Annecy'],
            ],
            'Pizzerias' => [
                ['Pizzeria La Napoli', '7 Rue Carnot, Annecy'],
                ['Pizzeria Le Sapaudia', '15 Rue Sainte-Claire, Annecy'],
                ['Pizzeria Chez Ingalls', '3 Rue Royale, Annecy'],
            ],
            'Végétariens' => [
                ['Green Food Café', '10 Rue Sommeiller, Annecy'],
                ['Le Bouddha Vert', '5 Rue Royale, Annecy'],
                ['Veggie Annecy', '18 Avenue de Genève, Annecy'],
            ],
            'Traiteurs' => [
                ['Traiteur Saveurs d’Annecy', '22 Rue des Alpins, Annecy'],
                ['Traiteur La Gourmandine', '8 Rue de la Bouverie, Annecy'],
                ['Traiteur du Lac', '15 Avenue du Rhône, Annecy'],
            ],
            'Bars à vin' => [
                ['Le Vin T’Annecy', '4 Rue Sainte-Claire, Annecy'],
                ['La Cave', '12 Rue Carnot, Annecy'],
                ['Le Bouchon', '5 Rue Royale, Annecy'],
            ],
            'Bars à cocktails' => [
                ['Le 7 Cocktail Bar', '7 Rue Carnot, Annecy'],
                ['Le Mix', '10 Avenue de Genève, Annecy'],
                ['Le Gatsby', '15 Rue Carnot, Annecy'],
            ],
            'Pubs' => [
                ['The Queen’s Head', '1 Place de l’Hôtel de Ville, Annecy'],
                ['O’Brady’s Irish Pub', '8 Rue Saint-Maurice, Annecy'],
                ['Le Pub du Lac', '2 Quai des Clarisses, Annecy'],
            ],
            'Cafés' => [
                ['Café des Arts', '7 Rue Carnot, Annecy'],
                ['Café du Pâquier', '15 Rue Sainte-Claire, Annecy'],
                ['Café Royal', '3 Rue Royale, Annecy'],
            ],
            'Pâtisseries' => [
                ['Pâtisserie Philippe Rigollot', '1 Rue Carnot, Annecy'],
                ['Pâtisserie Chocolatier Meyer', '10 Avenue de Genève, Annecy'],
                ['Pâtisserie du Lac', '15 Rue Carnot, Annecy'],
            ],
            'Boulangeries' => [
                ['Boulangerie Chevallier', '12 Rue Carnot, Annecy'],
                ['Boulangerie du Thiou', '8 Quai des Clarisses, Annecy'],
                ['Maison Pochat', '5 Rue Royale, Annecy'],
            ],
            'Fromageries' => [
                ['Fromagerie Pierre Gay', '47 Rue Carnot, Annecy'],
                ['Fromagerie du Lac', '2 Quai des Clarisses, Annecy'],
                ['Fromagerie Les Alpages', '8 Rue Saint-Maurice, Annecy'],
            ],
            // Hébergements
            '5 étoiles' => [
                ['Impérial Palace', 'Allée de l’Impérial, Annecy'],
                ['Les Trésoms', '15 Boulevard de la Corniche, Annecy'],
                ['Hôtel Black Bass', '921 Route d’Albertville, Annecy'],
            ],
            '4 étoiles' => [
                ['Hôtel Splendid', '4 Quai Eustache Chappuis, Annecy'],
                ['Hôtel Le Pré Carré', '27 Rue Sommeiller, Annecy'],
                ['Hôtel Novotel', '1 Avenue Berthollet, Annecy'],
            ],
            '3 étoiles' => [
                ['Hôtel du Nord', '24 Rue Sommeiller, Annecy'],
                ['Hôtel des Alpes', '12 Rue de la Poste, Annecy'],
                ['Hôtel Ibis Styles', '1 Place de la Gare, Annecy'],
            ],
            'Boutique hôtels' => [
                ['Hôtel Le Boutik', '5 Rue Carnot, Annecy'],
                ['Hôtel Atipik', '19 Rue Vaugelas, Annecy'],
                ['Hôtel Les Cygnes', '14 Avenue du Petit Port, Annecy'],
            ],
            'Chambres d’hôtes' => [
                ['La Villa du Lac', '148 Route du Bout du Lac, Annecy'],
                ['Les Jardins Secrets', '8 Chemin du Belvédère, Annecy'],
                ['Le Clos des Sens', '23 Route de la Chapelle, Annecy'],
            ],
            'Auberges de jeunesse' => [
                ['Auberge de Jeunesse Annecy', '4 Rue du Stade, Annecy'],
                ['Auberge du Lac', '8 Chemin du Belvédère, Annecy'],
                ['Auberge Les Alpages', '15 Avenue du Rhône, Annecy'],
            ],
            'Appartements' => [
                ['Appartement Le Pâquier', '10 Avenue du Pâquier, Annecy'],
                ['Appartement Les Clarisses', '8 Quai des Clarisses, Annecy'],
                ['Appartement Carnot', '12 Rue Carnot, Annecy'],
            ],
            'Villas' => [
                ['Villa du Lac', '148 Route du Bout du Lac, Annecy'],
                ['Villa Les Trésoms', '15 Boulevard de la Corniche, Annecy'],
                ['Villa Royale', '3 Rue Royale, Annecy'],
            ],
            'Gîtes' => [
                ['Gîte La Clusaz', '1 Chemin du Golf, Annecy'],
                ['Gîte Les Alpages', '8 Rue Saint-Maurice, Annecy'],
                ['Gîte du Semnoz', 'Route du Semnoz, Annecy'],
            ],
            'Tentes' => [
                ['Camping Les Rives du Lac', '148 Route du Bout du Lac, Annecy'],
                ['Camping Le Belvédère', '8 Chemin du Belvédère, Annecy'],
                ['Camping La Chapelle Saint Claude', '23 Route de la Chapelle, Annecy'],
            ],
            'Mobil-homes' => [
                ['Mobil-home Les Clarisses', '8 Quai des Clarisses, Annecy'],
                ['Mobil-home du Lac', '15 Avenue du Rhône, Annecy'],
                ['Mobil-home Carnot', '12 Rue Carnot, Annecy'],
            ],
            'Chalets' => [
                ['Chalet du Semnoz', 'Route du Semnoz, Annecy'],
                ['Chalet Les Alpages', '8 Rue Saint-Maurice, Annecy'],
                ['Chalet du Lac', '2 Quai des Clarisses, Annecy'],
            ],
        ];

        DB::transaction(function () use ($admin, $realPlaces) {
            $toInsert = [];
            foreach ($realPlaces as $catNameFr => $places) {
                $cat = Category::where('name->fr', $catNameFr)->first();
                if (!$cat) continue;
                $names = $cat->getTranslations('name');
                $slugs = $cat->getTranslations('slug');
                foreach ($places as $idx => [$placeNameFr, $addressFr]) {
                    $translations = [
                        'name' => [
                            'fr' => $placeNameFr,
                            'en' => translate_place_name($placeNameFr, 'en'),
                            'ar' => translate_place_name($placeNameFr, 'ar'),
                        ],
                        'address' => [
                            'fr' => $addressFr,
                            'en' => translate_address($addressFr, 'en'),
                            'ar' => translate_address($addressFr, 'ar'),
                        ],
                        'description' => [
                            'fr' => $placeNameFr . ' situé à ' . $addressFr . ' dans la catégorie ' . ($names['fr'] ?? $catNameFr) . '.',
                            'en' => translate_place_description($placeNameFr, $addressFr, ($names['en'] ?? $catNameFr), 'en'),
                            'ar' => translate_place_description($placeNameFr, $addressFr, ($names['ar'] ?? $catNameFr), 'ar'),
                        ],
                    ];
                    $toInsert[] = [
                        'id' => (string) Str::uuid(),
                        'owner_id' => $admin->id,
                        'category_id' => $cat->id,
                        'status' => 'published',
                        'is_verified' => true,
                        'latitude' => 45.9 + ($idx * 0.01),
                        'longitude' => 6.1 + ($idx * 0.01),
                        'elevation' => 450 + ($idx * 10),
                        'address_full' => $translations['address']['fr'],
                        'postal_code' => '74000',
                        'city_name' => 'Annecy',
                        'name' => json_encode($translations['name'], JSON_UNESCAPED_UNICODE),
                        'slug' => json_encode([
                            'fr' => Str::slug($translations['name']['fr']),
                            'en' => Str::slug($translations['name']['en']),
                            'ar' => Str::slug($translations['name']['ar']),
                        ], JSON_UNESCAPED_UNICODE),
                        'description' => json_encode($translations['description'], JSON_UNESCAPED_UNICODE),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            if (count($toInsert)) {
                Place::insert($toInsert);
            }
        });

        // Vérification d'intégrité : chaque feuille doit avoir 3 lieux
        $leafCategories = Category::doesntHave('children')->get();
        $missingPlaces = [];
        foreach ($leafCategories as $cat) {
            $count = Place::where('category_id', $cat->id)->count();
            if ($count < 3) {
                $names = $cat->getTranslations('name');
                $missingPlaces[] = ($names['fr'] ?? $cat->name) . ' (' . $count . '/3)';
            }
        }
        if (count($missingPlaces) > 0) {
            throw new \Exception('Places manquantes ou incomplètes: ' . implode(', ', $missingPlaces));
        }
    }
}
