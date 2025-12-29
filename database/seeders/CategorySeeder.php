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
                'name' => ['fr' => 'Activités', 'en' => 'Activities', 'ar' => 'أنشطة', 'es' => 'Activities', 'pt' => 'Activities', 'it' => 'Activities', 'de' => 'Activities', 'zh' => 'Activities', 'ru' => 'Activities', 'hi' => 'Activities'],
                'slug' => ['fr' => 'activites', 'en' => 'activities', 'ar' => 'anshita', 'es' => 'activities', 'pt' => 'activities', 'it' => 'activities', 'de' => 'activities', 'zh' => 'activities', 'ru' => 'activities', 'hi' => 'activities'],
            ]);

            $gastro = Category::create([
                'type' => 'gastronomy', 'internal_code' => 'GASTRO_ROOT', 'icon_name' => 'cake',
                'name' => ['fr' => 'Gastronomie', 'en' => 'Gastronomy', 'ar' => 'فن الطبخ', 'es' => 'Gastronomy', 'pt' => 'Gastronomy', 'it' => 'Gastronomy', 'de' => 'Gastronomy', 'zh' => 'Gastronomy', 'ru' => 'Gastronomy', 'hi' => 'Gastronomy'],
                'slug' => ['fr' => 'gastronomie', 'en' => 'gastronomy', 'ar' => 'al-tabkh', 'es' => 'gastronomy', 'pt' => 'gastronomy', 'it' => 'gastronomy', 'de' => 'gastronomy', 'zh' => 'gastronomy', 'ru' => 'gastronomy', 'hi' => 'gastronomy'],
            ]);

            $sleep = Category::create([
                'type' => 'accommodation', 'internal_code' => 'SLEEP_ROOT', 'icon_name' => 'home',
                'name' => ['fr' => 'Hébergements', 'en' => 'Accommodation', 'ar' => 'الإقامة', 'es' => 'Accommodation', 'pt' => 'Accommodation', 'it' => 'Accommodation', 'de' => 'Accommodation', 'zh' => 'Accommodation', 'ru' => 'Accommodation', 'hi' => 'Accommodation'],
                'slug' => ['fr' => 'hebergements', 'en' => 'accommodation', 'ar' => 'al-iqama', 'es' => 'accommodation', 'pt' => 'accommodation', 'it' => 'accommodation', 'de' => 'accommodation', 'zh' => 'accommodation', 'ru' => 'accommodation', 'hi' => 'accommodation'],
            ]);

            // 3. Crée les sous-catégories avec Eloquent
            $ext = Category::create([
                'type' => 'activity', 'internal_code' => 'ACT_EXT', 'icon_name' => 'sun',
                'name' => ['fr' => 'Extérieur', 'en' => 'Outdoor', 'ar' => 'خارجي', 'es' => 'Outdoor', 'pt' => 'Outdoor', 'it' => 'Outdoor', 'de' => 'Outdoor', 'zh' => 'Outdoor', 'ru' => 'Outdoor', 'hi' => 'Outdoor'],
                'slug' => ['fr' => 'exterieur', 'en' => 'outdoor', 'ar' => 'khareji', 'es' => 'outdoor', 'pt' => 'outdoor', 'it' => 'outdoor', 'de' => 'outdoor', 'zh' => 'outdoor', 'ru' => 'outdoor', 'hi' => 'outdoor'],
                'parent_id' => $act->id,
            ]);

            $int = Category::create([
                'type' => 'activity', 'internal_code' => 'ACT_INT', 'icon_name' => 'moon',
                'name' => ['fr' => 'Intérieur', 'en' => 'Indoor', 'ar' => 'داخلي', 'es' => 'Indoor', 'pt' => 'Indoor', 'it' => 'Indoor', 'de' => 'Indoor', 'zh' => 'Indoor', 'ru' => 'Indoor', 'hi' => 'Indoor'],
                'slug' => ['fr' => 'interieur', 'en' => 'indoor', 'ar' => 'dakhili', 'es' => 'indoor', 'pt' => 'indoor', 'it' => 'indoor', 'de' => 'indoor', 'zh' => 'indoor', 'ru' => 'indoor', 'hi' => 'indoor'],
                'parent_id' => $act->id,
            ]);

            $walk = Category::create([
                'type' => 'activity', 'internal_code' => 'ACT_WALK', 'icon_name' => 'map',
                'name' => ['fr' => 'Ballades', 'en' => 'Walks', 'ar' => 'جولات', 'es' => 'Walks', 'pt' => 'Walks', 'it' => 'Walks', 'de' => 'Walks', 'zh' => 'Walks', 'ru' => 'Walks', 'hi' => 'Walks'],
                'slug' => ['fr' => 'ballades', 'en' => 'walks', 'ar' => 'jawlat', 'es' => 'walks', 'pt' => 'walks', 'it' => 'walks', 'de' => 'walks', 'zh' => 'walks', 'ru' => 'walks', 'hi' => 'walks'],
                'parent_id' => $ext->id,
            ]);

            $resto = Category::create([
                'type' => 'gastronomy', 'internal_code' => 'REST_ROOT', 'icon_name' => 'store',
                'name' => ['fr' => 'Restaurants', 'en' => 'Restaurants', 'ar' => 'مطاعم', 'es' => 'Restaurants', 'pt' => 'Restaurants', 'it' => 'Restaurants', 'de' => 'Restaurants', 'zh' => 'Restaurants', 'ru' => 'Restaurants', 'hi' => 'Restaurants'],
                'slug' => ['fr' => 'restaurants', 'en' => 'restaurants', 'ar' => 'mataem', 'es' => 'restaurants', 'pt' => 'restaurants', 'it' => 'restaurants', 'de' => 'restaurants', 'zh' => 'restaurants', 'ru' => 'restaurants', 'hi' => 'restaurants'],
                'parent_id' => $gastro->id,
            ]);

            $bar = Category::create([
                'type' => 'gastronomy', 'internal_code' => 'BAR_ROOT', 'icon_name' => 'glass-water',
                'name' => ['fr' => 'Bars', 'en' => 'Bars', 'ar' => 'بارات', 'es' => 'Bars', 'pt' => 'Bars', 'it' => 'Bars', 'de' => 'Bars', 'zh' => 'Bars', 'ru' => 'Bars', 'hi' => 'Bars'],
                'slug' => ['fr' => 'bars', 'en' => 'bars', 'ar' => 'barat', 'es' => 'bars', 'pt' => 'bars', 'it' => 'bars', 'de' => 'bars', 'zh' => 'bars', 'ru' => 'bars', 'hi' => 'bars'],
                'parent_id' => $gastro->id,
            ]);

            $hotel = Category::create([
                'type' => 'accommodation', 'internal_code' => 'HOTEL_ROOT', 'icon_name' => 'building',
                'name' => ['fr' => 'Hôtels', 'en' => 'Hotels', 'ar' => 'فنادق', 'es' => 'Hotels', 'pt' => 'Hotels', 'it' => 'Hotels', 'de' => 'Hotels', 'zh' => 'Hotels', 'ru' => 'Hotels', 'hi' => 'Hotels'],
                'slug' => ['fr' => 'hotels', 'en' => 'hotels', 'ar' => 'fanadeq', 'es' => 'hotels', 'pt' => 'hotels', 'it' => 'hotels', 'de' => 'hotels', 'zh' => 'hotels', 'ru' => 'hotels', 'hi' => 'hotels'],
                'parent_id' => $sleep->id,
            ]);

            $camping = Category::create([
                'type' => 'accommodation', 'internal_code' => 'CAMPING_ROOT', 'icon_name' => 'tent',
                'name' => ['fr' => 'Campings', 'en' => 'Campsites', 'ar' => 'مخيمات', 'es' => 'Campsites', 'pt' => 'Campsites', 'it' => 'Campsites', 'de' => 'Campsites', 'zh' => 'Campsites', 'ru' => 'Campsites', 'hi' => 'Campsites'],
                'slug' => ['fr' => 'campings', 'en' => 'campsites', 'ar' => 'mukhayamat', 'es' => 'campsites', 'pt' => 'campsites', 'it' => 'campsites', 'de' => 'campsites', 'zh' => 'campsites', 'ru' => 'campsites', 'hi' => 'campsites'],
                'parent_id' => $sleep->id,
            ]);

            // 4. Prépare les sous-sous-catégories
            $subCategories = [
                // ACTIVITÉS
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_HIKE', 'icon_name' => 'map',
                    'name' => json_encode(['fr' => 'Randonnée', 'en' => 'Hiking', 'ar' => 'تنزه', 'es' => 'Hiking', 'pt' => 'Hiking', 'it' => 'Hiking', 'de' => 'Hiking', 'zh' => 'Hiking', 'ru' => 'Hiking', 'hi' => 'Hiking']),
                    'slug' => json_encode(['fr' => 'randonnee', 'en' => 'hiking', 'ar' => 'tanzoh', 'es' => 'hiking', 'pt' => 'hiking', 'it' => 'hiking', 'de' => 'hiking', 'zh' => 'hiking', 'ru' => 'hiking', 'hi' => 'hiking']),
                    'parent_id' => $walk->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_TRAIL', 'icon_name' => 'route',
                    'name' => json_encode(['fr' => 'Trails', 'en' => 'Trails', 'ar' => 'مسارات', 'es' => 'Trails', 'pt' => 'Trails', 'it' => 'Trails', 'de' => 'Trails', 'zh' => 'Trails', 'ru' => 'Trails', 'hi' => 'Trails']),
                    'slug' => json_encode(['fr' => 'trails', 'en' => 'trails', 'ar' => 'masarat', 'es' => 'trails', 'pt' => 'trails', 'it' => 'trails', 'de' => 'trails', 'zh' => 'trails', 'ru' => 'trails', 'hi' => 'trails']),
                    'parent_id' => $walk->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_CYCLE', 'icon_name' => 'bike',
                    'name' => json_encode(['fr' => 'Cyclisme', 'en' => 'Cycling', 'ar' => 'دراجات', 'es' => 'Cycling', 'pt' => 'Cycling', 'it' => 'Cycling', 'de' => 'Cycling', 'zh' => 'Cycling', 'ru' => 'Cycling', 'hi' => 'Cycling']),
                    'slug' => json_encode(['fr' => 'cyclisme', 'en' => 'cycling', 'ar' => 'darajat', 'es' => 'cycling', 'pt' => 'cycling', 'it' => 'cycling', 'de' => 'cycling', 'zh' => 'cycling', 'ru' => 'cycling', 'hi' => 'cycling']),
                    'parent_id' => $walk->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_WATER', 'icon_name' => 'sailboat',
                    'name' => json_encode(['fr' => 'Sports nautiques', 'en' => 'Water Sports', 'ar' => 'رياضات مائية', 'es' => 'Water Sports', 'pt' => 'Water Sports', 'it' => 'Water Sports', 'de' => 'Water Sports', 'zh' => 'Water Sports', 'ru' => 'Water Sports', 'hi' => 'Water Sports']),
                    'slug' => json_encode(['fr' => 'sports-nautiques', 'en' => 'water-sports', 'ar' => 'riyadat-maya', 'es' => 'water-sports', 'pt' => 'water-sports', 'it' => 'water-sports', 'de' => 'water-sports', 'zh' => 'water-sports', 'ru' => 'water-sports', 'hi' => 'water-sports']),
                    'parent_id' => $ext->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_PARAGLIDING', 'icon_name' => 'plane',
                    'name' => json_encode(['fr' => 'Parapente', 'en' => 'Paragliding', 'ar' => 'الطيران المظلي', 'es' => 'Paragliding', 'pt' => 'Paragliding', 'it' => 'Paragliding', 'de' => 'Paragliding', 'zh' => 'Paragliding', 'ru' => 'Paragliding', 'hi' => 'Paragliding']),
                    'slug' => json_encode(['fr' => 'parapente', 'en' => 'paragliding', 'ar' => 'tayaran', 'es' => 'paragliding', 'pt' => 'paragliding', 'it' => 'paragliding', 'de' => 'paragliding', 'zh' => 'paragliding', 'ru' => 'paragliding', 'hi' => 'paragliding']),
                    'parent_id' => $ext->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_CLIMB', 'icon_name' => 'mountain',
                    'name' => json_encode(['fr' => 'Escalade', 'en' => 'Climbing', 'ar' => 'تسلق', 'es' => 'Climbing', 'pt' => 'Climbing', 'it' => 'Climbing', 'de' => 'Climbing', 'zh' => 'Climbing', 'ru' => 'Climbing', 'hi' => 'Climbing']),
                    'slug' => json_encode(['fr' => 'escalade', 'en' => 'climbing', 'ar' => 'tasalloq', 'es' => 'climbing', 'pt' => 'climbing', 'it' => 'climbing', 'de' => 'climbing', 'zh' => 'climbing', 'ru' => 'climbing', 'hi' => 'climbing']),
                    'parent_id' => $ext->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_YOGA', 'icon_name' => 'heart',
                    'name' => json_encode(['fr' => 'Yoga', 'en' => 'Yoga', 'ar' => 'يوغا', 'es' => 'Yoga', 'pt' => 'Yoga', 'it' => 'Yoga', 'de' => 'Yoga', 'zh' => 'Yoga', 'ru' => 'Yoga', 'hi' => 'Yoga']),
                    'slug' => json_encode(['fr' => 'yoga', 'en' => 'yoga', 'ar' => 'yoga', 'es' => 'yoga', 'pt' => 'yoga', 'it' => 'yoga', 'de' => 'yoga', 'zh' => 'yoga', 'ru' => 'yoga', 'hi' => 'yoga']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_CLIMB_IN', 'icon_name' => 'mountain',
                    'name' => json_encode(['fr' => 'Escalade en salle', 'en' => 'Indoor Climbing', 'ar' => 'تسلق داخلي', 'es' => 'Indoor Climbing', 'pt' => 'Indoor Climbing', 'it' => 'Indoor Climbing', 'de' => 'Indoor Climbing', 'zh' => 'Indoor Climbing', 'ru' => 'Indoor Climbing', 'hi' => 'Indoor Climbing']),
                    'slug' => json_encode(['fr' => 'escalade-salle', 'en' => 'indoor-climbing', 'ar' => 'tasalloq-dakhili', 'es' => 'indoor-climbing', 'pt' => 'indoor-climbing', 'it' => 'indoor-climbing', 'de' => 'indoor-climbing', 'zh' => 'indoor-climbing', 'ru' => 'indoor-climbing', 'hi' => 'indoor-climbing']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_FIT', 'icon_name' => 'dumbbell',
                    'name' => json_encode(['fr' => 'Fitness', 'en' => 'Fitness', 'ar' => 'لياقة', 'es' => 'Fitness', 'pt' => 'Fitness', 'it' => 'Fitness', 'de' => 'Fitness', 'zh' => 'Fitness', 'ru' => 'Fitness', 'hi' => 'Fitness']),
                    'slug' => json_encode(['fr' => 'fitness', 'en' => 'fitness', 'ar' => 'layaqa', 'es' => 'fitness', 'pt' => 'fitness', 'it' => 'fitness', 'de' => 'fitness', 'zh' => 'fitness', 'ru' => 'fitness', 'hi' => 'fitness']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_POOL', 'icon_name' => 'waves-ladder',
                    'name' => json_encode(['fr' => 'Piscine', 'en' => 'Swimming Pool', 'ar' => 'مسبح', 'es' => 'Swimming Pool', 'pt' => 'Swimming Pool', 'it' => 'Swimming Pool', 'de' => 'Swimming Pool', 'zh' => 'Swimming Pool', 'ru' => 'Swimming Pool', 'hi' => 'Swimming Pool']),
                    'slug' => json_encode(['fr' => 'piscine', 'en' => 'pool', 'ar' => 'masbah', 'es' => 'pool', 'pt' => 'pool', 'it' => 'pool', 'de' => 'pool', 'zh' => 'pool', 'ru' => 'pool', 'hi' => 'pool']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'activity', 'internal_code' => 'ACT_BOWL', 'icon_name' => 'circle',
                    'name' => json_encode(['fr' => 'Bowling', 'en' => 'Bowling', 'ar' => 'بولينغ', 'es' => 'Bowling', 'pt' => 'Bowling', 'it' => 'Bowling', 'de' => 'Bowling', 'zh' => 'Bowling', 'ru' => 'Bowling', 'hi' => 'Bowling']),
                    'slug' => json_encode(['fr' => 'bowling', 'en' => 'bowling', 'ar' => 'bowling', 'es' => 'bowling', 'pt' => 'bowling', 'it' => 'bowling', 'de' => 'bowling', 'zh' => 'bowling', 'ru' => 'bowling', 'hi' => 'bowling']),
                    'parent_id' => $int->id, 'created_at' => now(), 'updated_at' => now(),
                ],

                // GASTRONOMIE
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_TRAD', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Traditionnels', 'en' => 'Traditional', 'ar' => 'تقليدي', 'es' => 'Traditional', 'pt' => 'Traditional', 'it' => 'Traditional', 'de' => 'Traditional', 'zh' => 'Traditional', 'ru' => 'Traditional', 'hi' => 'Traditional']),
                    'slug' => json_encode(['fr' => 'traditionnels', 'en' => 'traditional', 'ar' => 'taqlidi', 'es' => 'traditional', 'pt' => 'traditional', 'it' => 'traditional', 'de' => 'traditional', 'zh' => 'traditional', 'ru' => 'traditional', 'hi' => 'traditional']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_GASTRO', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => 'Gastronomiques', 'en' => 'Gastronomic', 'ar' => 'ذواقة', 'es' => 'Gastronomic', 'pt' => 'Gastronomic', 'it' => 'Gastronomic', 'de' => 'Gastronomic', 'zh' => 'Gastronomic', 'ru' => 'Gastronomic', 'hi' => 'Gastronomic']),
                    'slug' => json_encode(['fr' => 'gastronomiques', 'en' => 'gastronomic', 'ar' => 'dhawaqa', 'es' => 'gastronomic', 'pt' => 'gastronomic', 'it' => 'gastronomic', 'de' => 'gastronomic', 'zh' => 'gastronomic', 'ru' => 'gastronomic', 'hi' => 'gastronomic']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_FAST', 'icon_name' => 'flame',
                    'name' => json_encode(['fr' => 'Fast-food', 'en' => 'Fast-food', 'ar' => 'وجبات سريعة', 'es' => 'Fast-food', 'pt' => 'Fast-food', 'it' => 'Fast-food', 'de' => 'Fast-food', 'zh' => 'Fast-food', 'ru' => 'Fast-food', 'hi' => 'Fast-food']),
                    'slug' => json_encode(['fr' => 'fast-food', 'en' => 'fast-food', 'ar' => 'wajbat-sariea', 'es' => 'fast-food', 'pt' => 'fast-food', 'it' => 'fast-food', 'de' => 'fast-food', 'zh' => 'fast-food', 'ru' => 'fast-food', 'hi' => 'fast-food']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_BRASS', 'icon_name' => 'beer',
                    'name' => json_encode(['fr' => 'Brasseries', 'en' => 'Brasseries', 'ar' => 'حانات', 'es' => 'Brasseries', 'pt' => 'Brasseries', 'it' => 'Brasseries', 'de' => 'Brasseries', 'zh' => 'Brasseries', 'ru' => 'Brasseries', 'hi' => 'Brasseries']),
                    'slug' => json_encode(['fr' => 'brasseries', 'en' => 'brasseries', 'ar' => 'hanat', 'es' => 'brasseries', 'pt' => 'brasseries', 'it' => 'brasseries', 'de' => 'brasseries', 'zh' => 'brasseries', 'ru' => 'brasseries', 'hi' => 'brasseries']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_PIZZA', 'icon_name' => 'pizza',
                    'name' => json_encode(['fr' => 'Pizzerias', 'en' => 'Pizzerias', 'ar' => 'بيتزا', 'es' => 'Pizzerias', 'pt' => 'Pizzerias', 'it' => 'Pizzerias', 'de' => 'Pizzerias', 'zh' => 'Pizzerias', 'ru' => 'Pizzerias', 'hi' => 'Pizzerias']),
                    'slug' => json_encode(['fr' => 'pizzerias', 'en' => 'pizzerias', 'ar' => 'pizza', 'es' => 'pizzerias', 'pt' => 'pizzerias', 'it' => 'pizzerias', 'de' => 'pizzerias', 'zh' => 'pizzerias', 'ru' => 'pizzerias', 'hi' => 'pizzerias']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_VEG', 'icon_name' => 'salad',
                    'name' => json_encode(['fr' => 'Végétariens', 'en' => 'Vegetarian', 'ar' => 'نباتي', 'es' => 'Vegetarian', 'pt' => 'Vegetarian', 'it' => 'Vegetarian', 'de' => 'Vegetarian', 'zh' => 'Vegetarian', 'ru' => 'Vegetarian', 'hi' => 'Vegetarian']),
                    'slug' => json_encode(['fr' => 'vegetariens', 'en' => 'vegetarian', 'ar' => 'nabati', 'es' => 'vegetarian', 'pt' => 'vegetarian', 'it' => 'vegetarian', 'de' => 'vegetarian', 'zh' => 'vegetarian', 'ru' => 'vegetarian', 'hi' => 'vegetarian']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'REST_CATER', 'icon_name' => 'truck',
                    'name' => json_encode(['fr' => 'Traiteurs', 'en' => 'Caterers', 'ar' => 'متعهدي الطعام', 'es' => 'Caterers', 'pt' => 'Caterers', 'it' => 'Caterers', 'de' => 'Caterers', 'zh' => 'Caterers', 'ru' => 'Caterers', 'hi' => 'Caterers']),
                    'slug' => json_encode(['fr' => 'traiteurs', 'en' => 'caterers', 'ar' => 'mutaahidi-taam', 'es' => 'caterers', 'pt' => 'caterers', 'it' => 'caterers', 'de' => 'caterers', 'zh' => 'caterers', 'ru' => 'caterers', 'hi' => 'caterers']),
                    'parent_id' => $resto->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAR_WINE', 'icon_name' => 'wine',
                    'name' => json_encode(['fr' => 'Bars à vin', 'en' => 'Wine Bars', 'ar' => 'بارات نبيذ', 'es' => 'Wine Bars', 'pt' => 'Wine Bars', 'it' => 'Wine Bars', 'de' => 'Wine Bars', 'zh' => 'Wine Bars', 'ru' => 'Wine Bars', 'hi' => 'Wine Bars']),
                    'slug' => json_encode(['fr' => 'bars-vin', 'en' => 'wine-bars', 'ar' => 'barat-nabidh', 'es' => 'wine-bars', 'pt' => 'wine-bars', 'it' => 'wine-bars', 'de' => 'wine-bars', 'zh' => 'wine-bars', 'ru' => 'wine-bars', 'hi' => 'wine-bars']),
                    'parent_id' => $bar->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAR_COCKTAIL', 'icon_name' => 'martini',
                    'name' => json_encode(['fr' => 'Bars à cocktails', 'en' => 'Cocktail Bars', 'ar' => 'بارات كوكتيل', 'es' => 'Cocktail Bars', 'pt' => 'Cocktail Bars', 'it' => 'Cocktail Bars', 'de' => 'Cocktail Bars', 'zh' => 'Cocktail Bars', 'ru' => 'Cocktail Bars', 'hi' => 'Cocktail Bars']),
                    'slug' => json_encode(['fr' => 'bars-cocktails', 'en' => 'cocktail-bars', 'ar' => 'barat-cocktail', 'es' => 'cocktail-bars', 'pt' => 'cocktail-bars', 'it' => 'cocktail-bars', 'de' => 'cocktail-bars', 'zh' => 'cocktail-bars', 'ru' => 'cocktail-bars', 'hi' => 'cocktail-bars']),
                    'parent_id' => $bar->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAR_PUB', 'icon_name' => 'beer',
                    'name' => json_encode(['fr' => 'Pubs', 'en' => 'Pubs', 'ar' => 'حانات', 'es' => 'Pubs', 'pt' => 'Pubs', 'it' => 'Pubs', 'de' => 'Pubs', 'zh' => 'Pubs', 'ru' => 'Pubs', 'hi' => 'Pubs']),
                    'slug' => json_encode(['fr' => 'pubs', 'en' => 'pubs', 'ar' => 'hanat', 'es' => 'pubs', 'pt' => 'pubs', 'it' => 'pubs', 'de' => 'pubs', 'zh' => 'pubs', 'ru' => 'pubs', 'hi' => 'pubs']),
                    'parent_id' => $bar->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'CAFE', 'icon_name' => 'coffee',
                    'name' => json_encode(['fr' => 'Cafés', 'en' => 'Cafes', 'ar' => 'مقاهي', 'es' => 'Cafes', 'pt' => 'Cafes', 'it' => 'Cafes', 'de' => 'Cafes', 'zh' => 'Cafes', 'ru' => 'Cafes', 'hi' => 'Cafes']),
                    'slug' => json_encode(['fr' => 'cafes', 'en' => 'cafes', 'ar' => 'maqahi', 'es' => 'cafes', 'pt' => 'cafes', 'it' => 'cafes', 'de' => 'cafes', 'zh' => 'cafes', 'ru' => 'cafes', 'hi' => 'cafes']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'PASTRY', 'icon_name' => 'cake',
                    'name' => json_encode(['fr' => 'Pâtisseries', 'en' => 'Pastries', 'ar' => 'حلويات', 'es' => 'Pastries', 'pt' => 'Pastries', 'it' => 'Pastries', 'de' => 'Pastries', 'zh' => 'Pastries', 'ru' => 'Pastries', 'hi' => 'Pastries']),
                    'slug' => json_encode(['fr' => 'patisseries', 'en' => 'pastries', 'ar' => 'halawiyat', 'es' => 'pastries', 'pt' => 'pastries', 'it' => 'pastries', 'de' => 'pastries', 'zh' => 'pastries', 'ru' => 'pastries', 'hi' => 'pastries']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'BAKERY', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Boulangeries', 'en' => 'Bakeries', 'ar' => 'مخابز', 'es' => 'Bakeries', 'pt' => 'Bakeries', 'it' => 'Bakeries', 'de' => 'Bakeries', 'zh' => 'Bakeries', 'ru' => 'Bakeries', 'hi' => 'Bakeries']),
                    'slug' => json_encode(['fr' => 'boulangeries', 'en' => 'bakeries', 'ar' => 'makhabez', 'es' => 'bakeries', 'pt' => 'bakeries', 'it' => 'bakeries', 'de' => 'bakeries', 'zh' => 'bakeries', 'ru' => 'bakeries', 'hi' => 'bakeries']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'gastronomy', 'internal_code' => 'CHEESE', 'icon_name' => 'cheese',
                    'name' => json_encode(['fr' => 'Fromageries', 'en' => 'Cheese Shops', 'ar' => 'محلات جبن', 'es' => 'Cheese Shops', 'pt' => 'Cheese Shops', 'it' => 'Cheese Shops', 'de' => 'Cheese Shops', 'zh' => 'Cheese Shops', 'ru' => 'Cheese Shops', 'hi' => 'Cheese Shops']),
                    'slug' => json_encode(['fr' => 'fromageries', 'en' => 'cheese-shops', 'ar' => 'mahalat-jubn', 'es' => 'cheese-shops', 'pt' => 'cheese-shops', 'it' => 'cheese-shops', 'de' => 'cheese-shops', 'zh' => 'cheese-shops', 'ru' => 'cheese-shops', 'hi' => 'cheese-shops']),
                    'parent_id' => $gastro->id, 'created_at' => now(), 'updated_at' => now(),
                ],

                // HÉBERGEMENTS
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_5', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => '5 étoiles', 'en' => '5 stars', 'ar' => '٥ نجوم', 'es' => '5 stars', 'pt' => '5 stars', 'it' => '5 stars', 'de' => '5 stars', 'zh' => '5 stars', 'ru' => '5 stars', 'hi' => '5 stars']),
                    'slug' => json_encode(['fr' => '5-etoiles', 'en' => '5-stars', 'ar' => '5-nujum', 'es' => '5-stars', 'pt' => '5-stars', 'it' => '5-stars', 'de' => '5-stars', 'zh' => '5-stars', 'ru' => '5-stars', 'hi' => '5-stars']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_4', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => '4 étoiles', 'en' => '4 stars', 'ar' => '٤ نجوم', 'es' => '4 stars', 'pt' => '4 stars', 'it' => '4 stars', 'de' => '4 stars', 'zh' => '4 stars', 'ru' => '4 stars', 'hi' => '4 stars']),
                    'slug' => json_encode(['fr' => '4-etoiles', 'en' => '4-stars', 'ar' => '4-nujum', 'es' => '4-stars', 'pt' => '4-stars', 'it' => '4-stars', 'de' => '4-stars', 'zh' => '4-stars', 'ru' => '4-stars', 'hi' => '4-stars']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_3', 'icon_name' => 'star',
                    'name' => json_encode(['fr' => '3 étoiles', 'en' => '3 stars', 'ar' => '٣ نجوم', 'es' => '3 stars', 'pt' => '3 stars', 'it' => '3 stars', 'de' => '3 stars', 'zh' => '3 stars', 'ru' => '3 stars', 'hi' => '3 stars']),
                    'slug' => json_encode(['fr' => '3-etoiles', 'en' => '3-stars', 'ar' => '3-nujum', 'es' => '3-stars', 'pt' => '3-stars', 'it' => '3-stars', 'de' => '3-stars', 'zh' => '3-stars', 'ru' => '3-stars', 'hi' => '3-stars']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'HOTEL_BOUTIQUE', 'icon_name' => 'store',
                    'name' => json_encode(['fr' => 'Boutique hôtels', 'en' => 'Boutique Hotels', 'ar' => 'فنادق بوتيك', 'es' => 'Boutique Hotels', 'pt' => 'Boutique Hotels', 'it' => 'Boutique Hotels', 'de' => 'Boutique Hotels', 'zh' => 'Boutique Hotels', 'ru' => 'Boutique Hotels', 'hi' => 'Boutique Hotels']),
                    'slug' => json_encode(['fr' => 'boutique-hotels', 'en' => 'boutique-hotels', 'ar' => 'fanadeq-boutique', 'es' => 'boutique-hotels', 'pt' => 'boutique-hotels', 'it' => 'boutique-hotels', 'de' => 'boutique-hotels', 'zh' => 'boutique-hotels', 'ru' => 'boutique-hotels', 'hi' => 'boutique-hotels']),
                    'parent_id' => $hotel->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'GUESTHOUSE', 'icon_name' => 'users',
                    'name' => json_encode(['fr' => 'Chambres d’hôtes', 'en' => 'Guesthouses', 'ar' => 'غرف ضيوف', 'es' => 'Guesthouses', 'pt' => 'Guesthouses', 'it' => 'Guesthouses', 'de' => 'Guesthouses', 'zh' => 'Guesthouses', 'ru' => 'Guesthouses', 'hi' => 'Guesthouses']),
                    'slug' => json_encode(['fr' => 'chambres-hotes', 'en' => 'guesthouses', 'ar' => 'ghuraf-duyuf', 'es' => 'guesthouses', 'pt' => 'guesthouses', 'it' => 'guesthouses', 'de' => 'guesthouses', 'zh' => 'guesthouses', 'ru' => 'guesthouses', 'hi' => 'guesthouses']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'YOUTH_HOSTEL', 'icon_name' => 'users',
                    'name' => json_encode(['fr' => 'Auberges de jeunesse', 'en' => 'Youth Hostels', 'ar' => 'بيوت شباب', 'es' => 'Youth Hostels', 'pt' => 'Youth Hostels', 'it' => 'Youth Hostels', 'de' => 'Youth Hostels', 'zh' => 'Youth Hostels', 'ru' => 'Youth Hostels', 'hi' => 'Youth Hostels']),
                    'slug' => json_encode(['fr' => 'auberges-jeunesse', 'en' => 'youth-hostels', 'ar' => 'buyut-shabab', 'es' => 'youth-hostels', 'pt' => 'youth-hostels', 'it' => 'youth-hostels', 'de' => 'youth-hostels', 'zh' => 'youth-hostels', 'ru' => 'youth-hostels', 'hi' => 'youth-hostels']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'APARTMENT', 'icon_name' => 'building-2',
                    'name' => json_encode(['fr' => 'Appartements', 'en' => 'Apartments', 'ar' => 'شقق', 'es' => 'Apartments', 'pt' => 'Apartments', 'it' => 'Apartments', 'de' => 'Apartments', 'zh' => 'Apartments', 'ru' => 'Apartments', 'hi' => 'Apartments']),
                    'slug' => json_encode(['fr' => 'appartements', 'en' => 'apartments', 'ar' => 'shuqaq', 'es' => 'apartments', 'pt' => 'apartments', 'it' => 'apartments', 'de' => 'apartments', 'zh' => 'apartments', 'ru' => 'apartments', 'hi' => 'apartments']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'VILLA', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Villas', 'en' => 'Villas', 'ar' => 'فلل', 'es' => 'Villas', 'pt' => 'Villas', 'it' => 'Villas', 'de' => 'Villas', 'zh' => 'Villas', 'ru' => 'Villas', 'hi' => 'Villas']),
                    'slug' => json_encode(['fr' => 'villas', 'en' => 'villas', 'ar' => 'villal', 'es' => 'villas', 'pt' => 'villas', 'it' => 'villas', 'de' => 'villas', 'zh' => 'villas', 'ru' => 'villas', 'hi' => 'villas']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'GITE', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Gîtes', 'en' => 'Gites', 'ar' => 'بيوت ريفية', 'es' => 'Gites', 'pt' => 'Gites', 'it' => 'Gites', 'de' => 'Gites', 'zh' => 'Gites', 'ru' => 'Gites', 'hi' => 'Gites']),
                    'slug' => json_encode(['fr' => 'gites', 'en' => 'gites', 'ar' => 'buyut-rifiya', 'es' => 'gites', 'pt' => 'gites', 'it' => 'gites', 'de' => 'gites', 'zh' => 'gites', 'ru' => 'gites', 'hi' => 'gites']),
                    'parent_id' => $sleep->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'CAMP_TENT', 'icon_name' => 'tent',
                    'name' => json_encode(['fr' => 'Tentes', 'en' => 'Tents', 'ar' => 'خيام', 'es' => 'Tents', 'pt' => 'Tents', 'it' => 'Tents', 'de' => 'Tents', 'zh' => 'Tents', 'ru' => 'Tents', 'hi' => 'Tents']),
                    'slug' => json_encode(['fr' => 'tentes', 'en' => 'tents', 'ar' => 'khiyam', 'es' => 'tents', 'pt' => 'tents', 'it' => 'tents', 'de' => 'tents', 'zh' => 'tents', 'ru' => 'tents', 'hi' => 'tents']),
                    'parent_id' => $camping->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'CAMP_MOBILE', 'icon_name' => 'truck',
                    'name' => json_encode(['fr' => 'Mobil-homes', 'en' => 'Mobile Homes', 'ar' => 'بيوت متنقلة', 'es' => 'Mobile Homes', 'pt' => 'Mobile Homes', 'it' => 'Mobile Homes', 'de' => 'Mobile Homes', 'zh' => 'Mobile Homes', 'ru' => 'Mobile Homes', 'hi' => 'Mobile Homes']),
                    'slug' => json_encode(['fr' => 'mobil-homes', 'en' => 'mobile-homes', 'ar' => 'buyut-mutanqila', 'es' => 'mobile-homes', 'pt' => 'mobile-homes', 'it' => 'mobile-homes', 'de' => 'mobile-homes', 'zh' => 'mobile-homes', 'ru' => 'mobile-homes', 'hi' => 'mobile-homes']),
                    'parent_id' => $camping->id, 'created_at' => now(), 'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(), 'type' => 'accommodation', 'internal_code' => 'CAMP_CHALET', 'icon_name' => 'home',
                    'name' => json_encode(['fr' => 'Chalets', 'en' => 'Chalets', 'ar' => 'شاليهات', 'es' => 'Chalets', 'pt' => 'Chalets', 'it' => 'Chalets', 'de' => 'Chalets', 'zh' => 'Chalets', 'ru' => 'Chalets', 'hi' => 'Chalets']),
                    'slug' => json_encode(['fr' => 'chalets', 'en' => 'chalets', 'ar' => 'shalihat', 'es' => 'chalets', 'pt' => 'chalets', 'it' => 'chalets', 'de' => 'chalets', 'zh' => 'chalets', 'ru' => 'chalets', 'hi' => 'chalets']),
                    'parent_id' => $camping->id, 'created_at' => now(), 'updated_at' => now(),
                ],
            ];

            // 5. Insère les sous-sous-catégories en une seule requête
            DB::table('categories')->insert($subCategories);
        });
    }
}
