<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Supprime les données existantes
            Category::truncate();

            // 2. Crée les catégories racines
            $act = Category::create([
                'type' => 'activity', 'internal_code' => 'ACT_ROOT', 'icon_name' => 'sparkles',
                'name' => ['fr' => 'Activités', 'en' => 'Activities', 'ar' => 'أنشطة'],
                'slug' => ['fr' => 'activites', 'en' => 'activities', 'ar' => 'anshita']
            ]);

            $gastro = Category::create([
                'type' => 'gastronomy', 'internal_code' => 'GASTRO_ROOT', 'icon_name' => 'cake',
                'name' => ['fr' => 'Gastronomie', 'en' => 'Gastronomy', 'ar' => 'فن الطبخ'],
                'slug' => ['fr' => 'gastronomie', 'en' => 'gastronomy', 'ar' => 'al-tabkh']
            ]);

            $sleep = Category::create([
                'type' => 'accommodation', 'internal_code' => 'SLEEP_ROOT', 'icon_name' => 'home',
                'name' => ['fr' => 'Hébergements', 'en' => 'Accommodation', 'ar' => 'الإقامة'],
                'slug' => ['fr' => 'hebergements', 'en' => 'accommodation', 'ar' => 'al-iqama']
            ]);

            // 3. Crée les sous-catégories avec Eloquent
            $ext = Category::create([
                'type' => 'activity', 'internal_code' => 'ACT_EXT', 'icon_name' => 'sun',
                'name' => ['fr' => 'Extérieur', 'en' => 'Outdoor', 'ar' => 'خارجي'],
                'slug' => ['fr' => 'exterieur', 'en' => 'outdoor', 'ar' => 'khareji'],
                'parent_id' => $act->id,
            ]);

            $int = Category::create([
                'type' => 'activity', 'internal_code' => 'ACT_INT', 'icon_name' => 'moon',
                'name' => ['fr' => 'Intérieur', 'en' => 'Indoor', 'ar' => 'داخلي'],
                'slug' => ['fr' => 'interieur', 'en' => 'indoor', 'ar' => 'dakhili'],
                'parent_id' => $act->id,
            ]);

            $walk = Category::create([
                'type' => 'activity', 'internal_code' => 'ACT_WALK', 'icon_name' => 'map',
                'name' => ['fr' => 'Ballades', 'en' => 'Walks', 'ar' => 'جولات'],
                'slug' => ['fr' => 'ballades', 'en' => 'walks', 'ar' => 'jawlat'],
                'parent_id' => $ext->id,
            ]);

            $resto = Category::create([
                'type' => 'gastronomy', 'internal_code' => 'REST_ROOT', 'icon_name' => 'store',
                'name' => ['fr' => 'Restaurants', 'en' => 'Restaurants', 'ar' => 'مطاعم'],
                'slug' => ['fr' => 'restaurants', 'en' => 'restaurants', 'ar' => 'mataem'],
                'parent_id' => $gastro->id,
            ]);

            $bar = Category::create([
                'type' => 'gastronomy', 'internal_code' => 'BAR_ROOT', 'icon_name' => 'glass-water',
                'name' => ['fr' => 'Bars', 'en' => 'Bars', 'ar' => 'بارات'],
                'slug' => ['fr' => 'bars', 'en' => 'bars', 'ar' => 'barat'],
                'parent_id' => $gastro->id,
            ]);

            $hotel = Category::create([
                'type' => 'accommodation', 'internal_code' => 'HOTEL_ROOT', 'icon_name' => 'building',
                'name' => ['fr' => 'Hôtels', 'en' => 'Hotels', 'ar' => 'فنادق'],
                'slug' => ['fr' => 'hotels', 'en' => 'hotels', 'ar' => 'fanadeq'],
                'parent_id' => $sleep->id,
            ]);

            $camping = Category::create([
                'type' => 'accommodation', 'internal_code' => 'CAMPING_ROOT', 'icon_name' => 'tent',
                'name' => ['fr' => 'Campings', 'en' => 'Campsites', 'ar' => 'مخيمات'],
                'slug' => ['fr' => 'campings', 'en' => 'campsites', 'ar' => 'mukhayamat'],
                'parent_id' => $sleep->id,
            ]);

            // 4. Prépare les sous-sous-catégories
            $subCategories = [
                // ACTIVITÉS
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_HIKE', 'icon_name' => 'map',
                    'name' => json_encode(['fr' => 'Randonnée', 'en' => 'Hiking', 'ar' => 'تنزه']),
                    'slug' => json_encode(['fr' => 'randonnee', 'en' => 'hiking', 'ar' => 'tanzoh']),
                    'parent_id' => $walk->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_TRAIL', 'icon_name' => 'route',
                    'name' => json_encode(['fr' => 'Trails', 'en' => 'Trails', 'ar' => 'مسارات']),
                    'slug' => json_encode(['fr' => 'trails', 'en' => 'trails', 'ar' => 'masarat']),
                    'parent_id' => $walk->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_CYCLE', 'icon_name' => 'bike',
                    'name' => json_encode(['fr' => 'Cyclisme', 'en' => 'Cycling', 'ar' => 'دراجات']),
                    'slug' => json_encode(['fr' => 'cyclisme', 'en' => 'cycling', 'ar' => 'darajat']),
                    'parent_id' => $walk->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_WATER', 'icon_name' => 'sailboat',
                    'name' => json_encode(['fr' => 'Sports nautiques', 'en' => 'Water Sports', 'ar' => 'رياضات مائية']),
                    'slug' => json_encode(['fr' => 'sports-nautiques', 'en' => 'water-sports', 'ar' => 'riyadat-maya']),
                    'parent_id' => $ext->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_PARAGLIDING', 'icon_name' => 'plane',
                    'name' => json_encode(['fr' => 'Parapente', 'en' => 'Paragliding', 'ar' => 'الطيران المظلي']),
                    'slug' => json_encode(['fr' => 'parapente', 'en' => 'paragliding', 'ar' => 'tayaran']),
                    'parent_id' => $ext->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_CLIMB', 'icon_name' => 'mountain',
                    'name' => json_encode(['fr' => 'Escalade', 'en' => 'Climbing', 'ar' => 'تسلق']),
                    'slug' => json_encode(['fr' => 'escalade', 'en' => 'climbing', 'ar' => 'tasalloq']),
                    'parent_id' => $ext->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_YOGA', 'icon_name' => 'heart',
                    'name' => json_encode(['fr' => 'Yoga', 'en' => 'Yoga', 'ar' => 'يوغا']),
                    'slug' => json_encode(['fr' => 'yoga', 'en' => 'yoga', 'ar' => 'yoga']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_CLIMB_IN', 'icon_name' => 'mountain',
                    'name' => json_encode(['fr' => 'Escalade en salle', 'en' => 'Indoor Climbing', 'ar' => 'تسلق داخلي']),
                    'slug' => json_encode(['fr' => 'escalade-salle', 'en' => 'indoor-climbing', 'ar' => 'tasalloq-dakhili']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_FIT', 'icon_name' => 'dumbbell',
                    'name' => json_encode(['fr' => 'Fitness', 'en' => 'Fitness', 'ar' => 'لياقة']),
                    'slug' => json_encode(['fr' => 'fitness', 'en' => 'fitness', 'ar' => 'layaqa']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_POOL', 'icon_name' => 'waves-ladder',
                    'name' => json_encode(['fr' => 'Piscine', 'en' => 'Swimming Pool', 'ar' => 'مسبح']),
                    'slug' => json_encode(['fr' => 'piscine', 'en' => 'pool', 'ar' => 'masbah']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_BOWL', 'icon_name' => 'circle',
                    'name' => json_encode(['fr' => 'Bowling', 'en' => 'Bowling', 'ar' => 'بولينغ']),
                    'slug' => json_encode(['fr' => 'bowling', 'en' => 'bowling', 'ar' => 'bowling']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],

                // GASTRONOMIE
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_TRAD', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Traditionnels', 'en' => 'Traditional', 'ar' => 'تقليدي']),
                    'slug' => json_encode(['fr' => 'traditionnels', 'en' => 'traditional', 'ar' => 'taqlidi']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_GASTRO', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => 'Gastronomiques', 'en' => 'Gastronomic', 'ar' => 'ذواقة']),
                    'slug' => json_encode(['fr' => 'gastronomiques', 'en' => 'gastronomic', 'ar' => 'dhawaqa']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_FAST', 'icon_name' => 'flame',
                    'name' => json_encode(['fr' => 'Fast-food', 'en' => 'Fast-food', 'ar' => 'وجبات سريعة']),
                    'slug' => json_encode(['fr' => 'fast-food', 'en' => 'fast-food', 'ar' => 'wajbat-sariea']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_BRASS', 'icon_name' => 'beer',
                    'name' => json_encode(['fr' => 'Brasseries', 'en' => 'Brasseries', 'ar' => 'حانات']),
                    'slug' => json_encode(['fr' => 'brasseries', 'en' => 'brasseries', 'ar' => 'hanat']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_PIZZA', 'icon_name' => 'pizza',
                    'name' => json_encode(['fr' => 'Pizzerias', 'en' => 'Pizzerias', 'ar' => 'بيتزا']),
                    'slug' => json_encode(['fr' => 'pizzerias', 'en' => 'pizzerias', 'ar' => 'pizza']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_VEG', 'icon_name' => 'salad',
                    'name' => json_encode(['fr' => 'Végétariens', 'en' => 'Vegetarian', 'ar' => 'نباتي']),
                    'slug' => json_encode(['fr' => 'vegetariens', 'en' => 'vegetarian', 'ar' => 'nabati']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_CATER', 'icon_name' => 'truck',
                    'name' => json_encode(['fr' => 'Traiteurs', 'en' => 'Caterers', 'ar' => 'متعهدي الطعام']),
                    'slug' => json_encode(['fr' => 'traiteurs', 'en' => 'caterers', 'ar' => 'mutaahidi-taam']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAR_WINE', 'icon_name' => 'wine',
                    'name' => json_encode(['fr' => 'Bars à vin', 'en' => 'Wine Bars', 'ar' => 'بارات نبيذ']),
                    'slug' => json_encode(['fr' => 'bars-vin', 'en' => 'wine-bars', 'ar' => 'barat-nabidh']),
                    'parent_id' => $bar->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAR_COCKTAIL', 'icon_name' => 'martini',
                    'name' => json_encode(['fr' => 'Bars à cocktails', 'en' => 'Cocktail Bars', 'ar' => 'بارات كوكتيل']),
                    'slug' => json_encode(['fr' => 'bars-cocktails', 'en' => 'cocktail-bars', 'ar' => 'barat-cocktail']),
                    'parent_id' => $bar->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAR_PUB', 'icon_name' => 'beer',
                    'name' => json_encode(['fr' => 'Pubs', 'en' => 'Pubs', 'ar' => 'حانات']),
                    'slug' => json_encode(['fr' => 'pubs', 'en' => 'pubs', 'ar' => 'hanat']),
                    'parent_id' => $bar->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'CAFE', 'icon_name' => 'coffee',
                    'name' => json_encode(['fr' => 'Cafés', 'en' => 'Cafes', 'ar' => 'مقاهي']),
                    'slug' => json_encode(['fr' => 'cafes', 'en' => 'cafes', 'ar' => 'maqahi']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'PASTRY', 'icon_name' => 'cake',
                    'name' => json_encode(['fr' => 'Pâtisseries', 'en' => 'Pastries', 'ar' => 'حلويات']),
                    'slug' => json_encode(['fr' => 'patisseries', 'en' => 'pastries', 'ar' => 'halawiyat']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAKERY', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Boulangeries', 'en' => 'Bakeries', 'ar' => 'مخابز']),
                    'slug' => json_encode(['fr' => 'boulangeries', 'en' => 'bakeries', 'ar' => 'makhabez']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'CHEESE', 'icon_name' => 'cheese',
                    'name' => json_encode(['fr' => 'Fromageries', 'en' => 'Cheese Shops', 'ar' => 'محلات جبن']),
                    'slug' => json_encode(['fr' => 'fromageries', 'en' => 'cheese-shops', 'ar' => 'mahalat-jubn']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],

                // HÉBERGEMENTS
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_5', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => '5 étoiles', 'en' => '5 stars', 'ar' => '٥ نجوم']),
                    'slug' => json_encode(['fr' => '5-etoiles', 'en' => '5-stars', 'ar' => '5-nujum']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_4', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => '4 étoiles', 'en' => '4 stars', 'ar' => '٤ نجوم']),
                    'slug' => json_encode(['fr' => '4-etoiles', 'en' => '4-stars', 'ar' => '4-nujum']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_3', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => '3 étoiles', 'en' => '3 stars', 'ar' => '٣ نجوم']),
                    'slug' => json_encode(['fr' => '3-etoiles', 'en' => '3-stars', 'ar' => '3-nujum']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_BOUTIQUE', 'icon_name' => 'store',
                    'name' => json_encode(['fr' => 'Boutique hôtels', 'en' => 'Boutique Hotels', 'ar' => 'فنادق بوتيك']),
                    'slug' => json_encode(['fr' => 'boutique-hotels', 'en' => 'boutique-hotels', 'ar' => 'fanadeq-boutique']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'GUESTHOUSE', 'icon_name' => 'users',
                    'name' => json_encode(['fr' => 'Chambres d’hôtes', 'en' => 'Guesthouses', 'ar' => 'غرف ضيوف']),
                    'slug' => json_encode(['fr' => 'chambres-hotes', 'en' => 'guesthouses', 'ar' => 'ghuraf-duyuf']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'YOUTH_HOSTEL', 'icon_name' => 'users',
                    'name' => json_encode(['fr' => 'Auberges de jeunesse', 'en' => 'Youth Hostels', 'ar' => 'بيوت شباب']),
                    'slug' => json_encode(['fr' => 'auberges-jeunesse', 'en' => 'youth-hostels', 'ar' => 'buyut-shabab']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'APARTMENT', 'icon_name' => 'building-2',
                    'name' => json_encode(['fr' => 'Appartements', 'en' => 'Apartments', 'ar' => 'شقق']),
                    'slug' => json_encode(['fr' => 'appartements', 'en' => 'apartments', 'ar' => 'shuqaq']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'VILLA', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Villas', 'en' => 'Villas', 'ar' => 'فلل']),
                    'slug' => json_encode(['fr' => 'villas', 'en' => 'villas', 'ar' => 'villal']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'GITE', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Gîtes', 'en' => 'Gites', 'ar' => 'بيوت ريفية']),
                    'slug' => json_encode(['fr' => 'gites', 'en' => 'gites', 'ar' => 'buyut-rifiya']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'CAMP_TENT', 'icon_name' => 'tent',
                    'name' => json_encode(['fr' => 'Tentes', 'en' => 'Tents', 'ar' => 'خيام']),
                    'slug' => json_encode(['fr' => 'tentes', 'en' => 'tents', 'ar' => 'khiyam']),
                    'parent_id' => $camping->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'CAMP_MOBILE', 'icon_name' => 'truck',
                    'name' => json_encode(['fr' => 'Mobil-homes', 'en' => 'Mobile Homes', 'ar' => 'بيوت متنقلة']),
                    'slug' => json_encode(['fr' => 'mobil-homes', 'en' => 'mobile-homes', 'ar' => 'buyut-mutanqila']),
                    'parent_id' => $camping->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'CAMP_CHALET', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Chalets', 'en' => 'Chalets', 'ar' => 'شاليهات']),
                    'slug' => json_encode(['fr' => 'chalets', 'en' => 'chalets', 'ar' => 'shalihat']),
                    'parent_id' => $camping->id, 'created_at' => now(), 'updated_at' => now(),
                ],
            ];

            // 5. Insère les sous-sous-catégories en une seule requête
            DB::table('categories')->insert($subCategories);
        });
    }
}
