<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Place;
use App\Models\PlaceAccommodation;
use App\Models\PlaceGastronomy;
use App\Models\PlaceTrail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// Fonctions de traduction manuelle pour les lieux
function translate_place_name($nameFr, $lang)
{
    $map = [
        // Activités
        'Le Semnoz' => [
            'fr' => 'Le Semnoz',
            'en' => 'Semnoz Mountain',
            'es' => 'Monte Semnoz',
            'de' => 'Semnoz Berg',
            'zh' => '塞姆诺兹山',
            'ar' => 'جبل سيمنوز',
            'it' => 'Monte Semnoz',
            'pt' => 'Montanha Semnoz',
            'ru' => 'гора Семноз',
            'hi' => 'सेमनोज़ पर्वत',
        ],
        'Mont Veyrier' => [
            'fr' => 'Mont Veyrier', 'en' => 'Mount Veyrier', 'es' => 'Monte Veyrier', 'de' => 'Mont Veyrier', 'zh' => '维里耶山', 'ar' => 'جبل فييري', 'it' => 'Monte Veyrier', 'pt' => 'Monte Veyrier', 'ru' => 'гора Вейрье', 'hi' => 'माउंट वेयरियर',
        ],
        'Forêt de la Grande Jeanne' => [
            'fr' => 'Forêt de la Grande Jeanne', 'en' => 'Grande Jeanne Forest', 'es' => 'Bosque Grande Jeanne', 'de' => 'Wald Grande Jeanne', 'zh' => '格兰德让娜森林', 'ar' => 'غابة جان الكبرى', 'it' => 'Foresta Grande Jeanne', 'pt' => 'Floresta Grande Jeanne', 'ru' => 'лес Гранде Жан', 'hi' => 'ग्राँदे जीन जंगल',
        ],
        'Trail du Roc de Chère' => [
            'fr' => 'Trail du Roc de Chère', 'en' => 'Roc de Chère Trail', 'es' => 'Sendero Roc de Chère', 'de' => 'Roc de Chère Pfad', 'zh' => '罗克德谢尔步道', 'ar' => 'مسار روك دو شير', 'it' => 'Sentiero Roc de Chère', 'pt' => 'Trilha Roc de Chère', 'ru' => 'тропа Рок де Шер', 'hi' => 'रॉक दे शेरे ट्रेल',
        ],
        'Trail du Parmelan' => [
            'fr' => 'Trail du Parmelan', 'en' => 'Parmelan Trail', 'es' => 'Sendero Parmelan', 'de' => 'Parmelan Pfad', 'zh' => '帕梅兰步道', 'ar' => 'مسار بارميلان', 'it' => 'Sentiero Parmelan', 'pt' => 'Trilha Parmelan', 'ru' => 'тропа Пармелан', 'hi' => 'पारमेलान ट्रेल',
        ],
        'Trail du Fier' => [
            'fr' => 'Trail du Fier', 'en' => 'Fier Trail', 'es' => 'Sendero Fier', 'de' => 'Fier Pfad', 'zh' => '菲耶步道', 'ar' => 'مسار فيير', 'it' => 'Sentiero Fier', 'pt' => 'Trilha Fier', 'ru' => 'тропа Фиер', 'hi' => 'फियर ट्रेल',
        ],
        'Piste cyclable du Lac' => [
            'fr' => 'Piste cyclable du Lac', 'en' => 'Lake Bike Path', 'es' => 'Carril bici del lago', 'de' => 'Fahrradweg am See', 'zh' => '湖边自行车道', 'ar' => 'مسار الدراجات حول البحيرة', 'it' => 'Pista ciclabile del lago', 'pt' => 'Ciclovia do Lago', 'ru' => 'велодорожка у озера', 'hi' => 'झील साइकिल पथ',
        ],
        'Boucle des Aravis' => [
            'fr' => 'Boucle des Aravis', 'en' => 'Aravis Loop', 'es' => 'Circuito Aravis', 'de' => 'Aravis Rundweg', 'zh' => '阿拉维环线', 'ar' => 'حلقة أرَافيس', 'it' => 'Anello Aravis', 'pt' => 'Loop Aravis', 'ru' => 'петля Аравис', 'hi' => 'अराविस लूप',
        ],
        'Circuit du Pâquier' => [
            'fr' => 'Circuit du Pâquier', 'en' => 'Pâquier Circuit', 'es' => 'Circuito Pâquier', 'de' => 'Pâquier Rundkurs', 'zh' => '帕基耶环线', 'ar' => 'دائرة باكييه', 'it' => 'Circuito Pâquier', 'pt' => 'Circuito Pâquier', 'ru' => 'круг Пакье', 'hi' => 'पैकियर सर्किट',
        ],
        'Club Nautique d’Annecy' => [
            'fr' => 'Club Nautique d’Annecy', 'en' => 'Annecy Nautical Club', 'es' => 'Club Náutico de Annecy', 'de' => 'Segelclub Annecy', 'zh' => '安纳西航海俱乐部', 'ar' => 'نادي أنسي البحري', 'it' => 'Club Nautico di Annecy', 'pt' => 'Clube Náutico de Annecy', 'ru' => 'навигационный клуб Аннеси', 'hi' => 'ऐनसी नौटिकल क्लब',
        ],
        'Base Nautique des Marquisats' => [
            'fr' => 'Base Nautique des Marquisats', 'en' => 'Marquisats Water Base', 'es' => 'Base Náutica de Marquisats', 'de' => 'Wasserbasis Marquisats', 'zh' => '马尔基萨水上基地', 'ar' => 'قاعدة ماركيسات المائية', 'it' => 'Base Nautica des Marquisats', 'pt' => 'Base Náutica dos Marquisats', 'ru' => 'водная база Маркиза', 'hi' => 'मारकिसाţa जल बेस',
        ],
        'Wake Annecy' => [
            'fr' => 'Wake Annecy', 'en' => 'Wake Annecy', 'es' => 'Wake Annecy', 'de' => 'Wake Annecy', 'zh' => '安纳西滑水', 'ar' => 'ويك أنسي', 'it' => 'Wake Annecy', 'pt' => 'Wake Annecy', 'ru' => 'Вейк Аннеси', 'hi' => 'वेक ऐनसी',
        ],
        'Parapente Col de la Forclaz' => [
            'fr' => 'Parapente Col de la Forclaz', 'en' => 'Forclaz Pass Paragliding', 'es' => 'Parapente Col de la Forclaz', 'de' => 'Gleitschirmflug Col de la Forclaz', 'zh' => '福尔克拉兹山口滑翔伞', 'ar' => 'بارابنت كول دو لا فوركلاز', 'it' => 'Parapendio Col de la Forclaz', 'pt' => 'Parapente Col de la Forclaz', 'ru' => 'параплан Кол де ла Форкла', 'hi' => 'फोरक्लाज़ पास पैराग्लाइडिंग',
        ],
        'Parapente Talloires' => [
            'fr' => 'Parapente Talloires', 'en' => 'Talloires Paragliding', 'es' => 'Parapente Talloires', 'de' => 'Gleitschirmfliegen Talloires', 'zh' => '塔卢瓦尔滑翔伞', 'ar' => 'بارابنت تالوار', 'it' => 'Parapendio Talloires', 'pt' => 'Parapente Talloires', 'ru' => 'параплан Таллуар', 'hi' => 'टैलोइर पैराग्लाइडिंग',
        ],
        'Parapente Doussard' => [
            'fr' => 'Parapente Doussard', 'en' => 'Doussard Paragliding', 'es' => 'Parapente Doussard', 'de' => 'Gleitschirmfliegen Doussard', 'zh' => '杜萨尔滑翔伞', 'ar' => 'بارابنت دوسار', 'it' => 'Parapendio Doussard', 'pt' => 'Parapente Doussard', 'ru' => 'параплан Дуссар', 'hi' => 'डूसार्ड पैराग्लाइडिंग',
        ],
        'Site d’Escalade du Biclop' => [
            'fr' => 'Site d’Escalade du Biclop', 'en' => 'Biclop Climbing Site', 'es' => 'Sitio de escalada Biclop', 'de' => 'Klettergebiet Biclop', 'zh' => '比克洛普攀岩场', 'ar' => 'موقع التسلق بيكلوب', 'it' => 'Sito arrampicata Biclop', 'pt' => 'Local de escalada Biclop', 'ru' => 'скалолазный сайт Биклоп', 'hi' => 'बिकलॉप चढ़ाई स्थल',
        ],
        'Mur d’Escalade La Salle' => [
            'fr' => 'Mur d’Escalade La Salle', 'en' => 'La Salle Climbing Wall', 'es' => 'Muro de escalada La Salle', 'de' => 'Kletterwand La Salle', 'zh' => '拉萨尔攀岩墙', 'ar' => 'جدار التسلق لا سال', 'it' => 'Parete di arrampicata La Salle', 'pt' => 'Parede de escalada La Salle', 'ru' => 'скалодром Ла Саль', 'hi' => 'ला साल पर्वतारोहण दीवार',
        ],
        'Falaise de la Grande Jeanne' => [
            'fr' => 'Falaise de la Grande Jeanne', 'en' => 'Grande Jeanne Cliff', 'es' => 'Acantilado Grande Jeanne', 'de' => 'Klippe Grande Jeanne', 'zh' => '格兰德让娜悬崖', 'ar' => 'جرف جان الكبرى', 'it' => 'Scogliera Grande Jeanne', 'pt' => 'Falésia Grande Jeanne', 'ru' => 'скала Гранде Жан', 'hi' => 'ग्राँदे जीन चट्टान',
        ],
        'Golf Club d’Annecy' => [
            'fr' => 'Golf Club d’Annecy', 'en' => 'Annecy Golf Club', 'es' => 'Club de Golf de Annecy', 'de' => 'Golfclub Annecy', 'zh' => '安纳西高尔夫俱乐部', 'ar' => 'نادي الغولف أنسي', 'it' => 'Club di Golf di Annecy', 'pt' => 'Clube de Golfe de Annecy', 'ru' => 'гольф-клуб Аннеси', 'hi' => 'ऐनसी गोल्फ क्लब',
        ],
        'Mini-Golf du Pâquier' => [
            'fr' => 'Mini-Golf du Pâquier', 'en' => 'Pâquier Mini-Golf', 'es' => 'Mini-Golf Pâquier', 'de' => 'Minigolf Pâquier', 'zh' => '帕基耶迷你高尔夫', 'ar' => 'ميني غولف باكييه', 'it' => 'Mini-Golf Pâquier', 'pt' => 'Mini-Golfe Pâquier', 'ru' => 'мини-гольф Пакье', 'hi' => 'पैकियर मिनी-गोल्फ',
        ],
        'Golf Talloires' => [
            'fr' => 'Golf Talloires', 'en' => 'Talloires Golf', 'es' => 'Golf Talloires', 'de' => 'Golf Talloires', 'zh' => '塔卢瓦尔高尔夫', 'ar' => 'غولف تالوار', 'it' => 'Golf Talloires', 'pt' => 'Golfe Talloires', 'ru' => 'гольф Таллуар', 'hi' => 'टैलोइर गोल्फ',
        ],
        'Yoga Studio Annecy' => [
            'fr' => 'Yoga Studio Annecy', 'en' => 'Annecy Yoga Studio', 'es' => 'Estudio de Yoga Annecy', 'de' => 'Yoga-Studio Annecy', 'zh' => '安纳西瑜伽工作室', 'ar' => 'استوديو اليوغا أنسي', 'it' => 'Studio Yoga Annecy', 'pt' => 'Estúdio de Yoga Annecy', 'ru' => 'йога-студия Аннеси', 'hi' => 'ऐनसी योग स्टूडियो',
        ],
        'Yoga du Lac' => [
            'fr' => 'Yoga du Lac', 'en' => 'Lake Yoga', 'es' => 'Yoga del Lago', 'de' => 'Yoga am See', 'zh' => '湖瑜伽', 'ar' => 'يوغا البحيرة', 'it' => 'Yoga del Lago', 'pt' => 'Yoga do Lago', 'ru' => 'йога у озера', 'hi' => 'झील योग',
        ],
        'Yoga Harmonie' => [
            'fr' => 'Yoga Harmonie', 'en' => 'Harmony Yoga', 'es' => 'Yoga Armonía', 'de' => 'Harmonie Yoga', 'zh' => '和谐瑜伽', 'ar' => 'يوغا هارموني', 'it' => 'Yoga Armonia', 'pt' => 'Yoga Harmonia', 'ru' => 'йога Гармония', 'hi' => 'हार्मनी योग',
        ],
        'Bloc Session' => [
            'fr' => 'Bloc Session', 'en' => 'Bloc Session', 'es' => 'Sesión de Bloc', 'de' => 'Bloc Session', 'zh' => '抱石会', 'ar' => 'بلوك سيشن', 'it' => 'Bloc Session', 'pt' => 'Sessão de Bloc', 'ru' => 'блок-сессия', 'hi' => 'ब्लॉक सेशन',
        ],
        'Vertical’Art Annecy' => [
            'fr' => 'Vertical’Art Annecy', 'en' => 'Vertical’Art Annecy', 'es' => 'Vertical’Art Annecy', 'de' => 'Vertical’Art Annecy', 'zh' => '垂直艺术 安纳西', 'ar' => 'فيرتيكال آرت أنسي', 'it' => 'Vertical’Art Annecy', 'pt' => 'Vertical’Art Annecy', 'ru' => 'Vertical’Art Аннеси', 'hi' => 'वर्टिकलआर्ट ऐनसी',
        ],
        'Climb Up Annecy' => [
            'fr' => 'Climb Up Annecy', 'en' => 'Climb Up Annecy', 'es' => 'Climb Up Annecy', 'de' => 'Climb Up Annecy', 'zh' => 'Climb Up 安纳西', 'ar' => 'تسلق أنسي', 'it' => 'Climb Up Annecy', 'pt' => 'Climb Up Annecy', 'ru' => 'Climb Up Аннеси', 'hi' => 'क्लाइम्ब अप ऐनसी',
        ],
        'Fitness Park Annecy' => [
            'fr' => 'Fitness Park Annecy', 'en' => 'Fitness Park Annecy', 'es' => 'Fitness Park Annecy', 'de' => 'Fitness Park Annecy', 'zh' => '安纳西健身公园', 'ar' => 'فيتنس بارك أنسي', 'it' => 'Fitness Park Annecy', 'pt' => 'Fitness Park Annecy', 'ru' => 'фитнес-парк Аннеси', 'hi' => 'फिटनेस पार्क ऐनसी',
        ],
        'Basic-Fit Annecy' => [
            'fr' => 'Basic-Fit Annecy', 'en' => 'Basic-Fit Annecy', 'es' => 'Basic-Fit Annecy', 'de' => 'Basic-Fit Annecy', 'zh' => 'Basic-Fit 安纳西', 'ar' => 'بيزيك فيت أنسي', 'it' => 'Basic-Fit Annecy', 'pt' => 'Basic-Fit Annecy', 'ru' => 'Бейсик-Фит Аннеси', 'hi' => 'बेसिक-फिट ऐनसी',
        ],
        'L’Orange Bleue' => [
            'fr' => 'L’Orange Bleue', 'en' => 'L’Orange Bleue', 'es' => 'L’Orange Bleue', 'de' => 'L’Orange Bleue', 'zh' => '蓝色橙子', 'ar' => 'البرتقالة الزرقاء', 'it' => 'L’Orange Bleue', 'pt' => 'L’Orange Bleue', 'ru' => 'Л’Орaндж Бльё', 'hi' => 'एल ऑरेंज ब्लू',
        ],
        'Piscine des Marquisats' => [
            'fr' => 'Piscine des Marquisats', 'en' => 'Marquisats Pool', 'es' => 'Piscina de Marquisats', 'de' => 'Schwimmbad Marquisats', 'zh' => '马尔基萨游泳池', 'ar' => 'مسبح ماركيسات', 'it' => 'Piscina des Marquisats', 'pt' => 'Piscina dos Marquisats', 'ru' => 'бассейн Маркиса', 'hi' => 'मारकिसात्स तैराकी पूल',
        ],
        'Piscine Jean Régis' => [
            'fr' => 'Piscine Jean Régis', 'en' => 'Jean Régis Pool', 'es' => 'Piscina Jean Régis', 'de' => 'Schwimmbad Jean Régis', 'zh' => '让·雷吉斯游泳池', 'ar' => 'مسبح جان ريجي', 'it' => 'Piscina Jean Régis', 'pt' => 'Piscina Jean Régis', 'ru' => 'бассейн Жан Режис', 'hi' => 'जीन रेगिस तैराकी पूल',
        ],
        'Piscine de Seynod' => [
            'fr' => 'Piscine de Seynod', 'en' => 'Seynod Pool', 'es' => 'Piscina de Seynod', 'de' => 'Schwimmbad Seynod', 'zh' => '塞伊诺德游泳池', 'ar' => 'مسبح سينود', 'it' => 'Piscina di Seynod', 'pt' => 'Piscina de Seynod', 'ru' => 'бассейн Сейнод', 'hi' => 'सेनोड तैराकी पूल',
        ],
        'Bowling d’Annecy' => [
            'fr' => 'Bowling d’Annecy', 'en' => 'Annecy Bowling', 'es' => 'Bowling de Annecy', 'de' => 'Bowling Annecy', 'zh' => '安纳西保龄球', 'ar' => 'بولينغ أنسي', 'it' => 'Bowling di Annecy', 'pt' => 'Bowling de Annecy', 'ru' => 'боулинг Аннеси', 'hi' => 'बोलिंग ऐनसी',
        ],
        'Bowling Seynod' => [
            'fr' => 'Bowling Seynod', 'en' => 'Seynod Bowling', 'es' => 'Bowling Seynod', 'de' => 'Bowling Seynod', 'zh' => '塞伊诺德保龄球', 'ar' => 'بولينغ سينود', 'it' => 'Bowling Seynod', 'pt' => 'Bowling Seynod', 'ru' => 'боулинг Сейнод', 'hi' => 'बोलिंग सेनॉड',
        ],
        'Bowling Le Strike' => [
            'fr' => 'Bowling Le Strike', 'en' => 'Le Strike Bowling', 'es' => 'Bowling Le Strike', 'de' => 'Bowling Le Strike', 'zh' => '飞镖保龄球 Le Strike', 'ar' => 'بولينغ لو سترايك', 'it' => 'Bowling Le Strike', 'pt' => 'Bowling Le Strike', 'ru' => 'боулинг Ле Страйк', 'hi' => 'बोलिंग ले स्ट्राइक',
        ],
        // Gastronomie
        'Restaurant La Table d’Elise' => [
            'fr' => 'Restaurant La Table d’Elise', 'en' => 'La Table d’Elise Restaurant', 'es' => 'Restaurante La Table d’Elise', 'de' => 'Restaurant La Table d’Elise', 'zh' => '埃莉丝餐厅', 'ar' => 'مطعم لا تابِل د إليز', 'it' => 'Ristorante La Table d’Elise', 'pt' => 'Restaurante La Table d’Elise', 'ru' => 'ресторан Ла Табль д’Элиз', 'hi' => 'रेस्टोरेंट ला टेबल डी एलिस',
        ],
        'Restaurant Le Freti' => [
            'fr' => 'Restaurant Le Freti', 'en' => 'Le Freti Restaurant', 'es' => 'Restaurante Le Freti', 'de' => 'Restaurant Le Freti', 'zh' => '勒弗雷蒂餐厅', 'ar' => 'مطعم لو فريتي', 'it' => 'Ristorante Le Freti', 'pt' => 'Restaurante Le Freti', 'ru' => 'ресторан Ле Фрэти', 'hi' => 'रेस्टोरेंट ले फ्रेती',
        ],
        'Restaurant Le Denti' => [
            'fr' => 'Restaurant Le Denti', 'en' => 'Le Denti Restaurant', 'es' => 'Restaurante Le Denti', 'de' => 'Restaurant Le Denti', 'zh' => '勒丹蒂餐厅', 'ar' => 'مطعم لو دانتي', 'it' => 'Ristorante Le Denti', 'pt' => 'Restaurante Le Denti', 'ru' => 'ресторан Ле Денти', 'hi' => 'रेस्टोरेंट ले डेंटी',
        ],
        'Restaurant Yoann Conte' => [
            'fr' => 'Restaurant Yoann Conte', 'en' => 'Yoann Conte Restaurant', 'es' => 'Restaurante Yoann Conte', 'de' => 'Restaurant Yoann Conte', 'zh' => '约安·孔特餐厅', 'ar' => 'مطعم يوآن كونتي', 'it' => 'Ristorante Yoann Conte', 'pt' => 'Restaurante Yoann Conte', 'ru' => 'ресторан Йоан Конте', 'hi' => 'रेस्टोरेंट योआन कॉन्ते',
        ],
        'Restaurant L’Auberge du Père Bise' => [
            'fr' => 'Restaurant L’Auberge du Père Bise', 'en' => 'L’Auberge du Père Bise', 'es' => 'L’Auberge du Père Bise', 'de' => 'L’Auberge du Père Bise', 'zh' => '佩尔比斯旅馆餐厅', 'ar' => 'مطعم لوبرج دو بير بيز', 'it' => 'L’Auberge du Père Bise', 'pt' => 'L’Auberge du Père Bise', 'ru' => 'Л’Оберж дю Пер Биз', 'hi' => 'ल’ओबर्ज डु पेर बाइज़',
        ],
        'Restaurant Vincent Favre-Félix' => [
            'fr' => 'Restaurant Vincent Favre-Félix', 'en' => 'Vincent Favre-Félix Restaurant', 'es' => 'Restaurante Vincent Favre-Félix', 'de' => 'Restaurant Vincent Favre-Félix', 'zh' => '文森特·法弗-菲利克斯餐厅', 'ar' => 'مطعم فنسنت فافر-فيليكس', 'it' => 'Ristorante Vincent Favre-Félix', 'pt' => 'Restaurante Vincent Favre-Félix', 'ru' => 'ресторан Винсент Фавр-Феликс', 'hi' => 'रेस्टोरेंट विंसेंट फव्रे-फेलिक्स',
        ],
        'McDonald’s Annecy' => [
            'fr' => 'McDonald’s Annecy', 'en' => 'McDonald’s Annecy', 'es' => 'McDonald’s Annecy', 'de' => 'McDonald’s Annecy', 'zh' => '安纳西麦当劳', 'ar' => 'ماكدونالدز أنسي', 'it' => 'McDonald’s Annecy', 'pt' => 'McDonald’s Annecy', 'ru' => 'Макдональдс Аннеси', 'hi' => 'मैकडॉनल्ड्स ऐनसी',
        ],
        'Burger King Annecy' => [
            'fr' => 'Burger King Annecy', 'en' => 'Burger King Annecy', 'es' => 'Burger King Annecy', 'de' => 'Burger King Annecy', 'zh' => '安纳西汉堡王', 'ar' => 'برجر كينغ أنسي', 'it' => 'Burger King Annecy', 'pt' => 'Burger King Annecy', 'ru' => 'Бургер Кинг Аннеси', 'hi' => 'बर्गर किंग ऐनसी',
        ],
        'Quick Annecy' => [
            'fr' => 'Quick Annecy', 'en' => 'Quick Annecy', 'es' => 'Quick Annecy', 'de' => 'Quick Annecy', 'zh' => '安纳西快餐', 'ar' => 'كويك أنسي', 'it' => 'Quick Annecy', 'pt' => 'Quick Annecy', 'ru' => 'Квик Аннеси', 'hi' => 'क्विक ऐनसी',
        ],
        'Brasserie des Européens' => [
            'fr' => 'Brasserie des Européens', 'en' => 'Brasserie des Européens', 'es' => 'Cervecería de los Europeos', 'de' => 'Brasserie des Européens', 'zh' => '欧洲人啤酒屋', 'ar' => 'براسري ديز يوروبين', 'it' => 'Brasserie des Européens', 'pt' => 'Brasserie des Européens', 'ru' => 'Брассери де Европеан', 'hi' => 'ब्रासरी देज़ यूरोपियन',
        ],
        'Brasserie Saint Maurice' => [
            'fr' => 'Brasserie Saint Maurice', 'en' => 'Saint Maurice Brasserie', 'es' => 'Cervecería Saint Maurice', 'de' => 'Brasserie Saint Maurice', 'zh' => '圣莫里斯啤酒屋', 'ar' => 'براسري سان موريس', 'it' => 'Brasserie Saint Maurice', 'pt' => 'Brasserie Saint Maurice', 'ru' => 'Брассери Сен Морис', 'hi' => 'ब्रासरी सेंट मॉरिस',
        ],
        'Brasserie du Lac' => [
            'fr' => 'Brasserie du Lac', 'en' => 'Lake Brasserie', 'es' => 'Brasserie del Lago', 'de' => 'Brasserie am See', 'zh' => '湖畔啤酒屋', 'ar' => 'براسري دو لاك', 'it' => 'Brasserie del Lago', 'pt' => 'Brasserie do Lago', 'ru' => 'брассери у озера', 'hi' => 'लेक ब्रासरी',
        ],
        'Pizzeria La Napoli' => [
            'fr' => 'Pizzeria La Napoli', 'en' => 'La Napoli Pizzeria', 'es' => 'Pizzería La Napoli', 'de' => 'Pizzeria La Napoli', 'zh' => '那不勒斯披萨店', 'ar' => 'بيتزا لا نابولي', 'it' => 'Pizzeria La Napoli', 'pt' => 'Pizzaria La Napoli', 'ru' => 'пиццерия Ла Наполи', 'hi' => 'पिज़्ज़ेरिया ला नापोली',
        ],
        'Pizzeria Le Sapaudia' => [
            'fr' => 'Pizzeria Le Sapaudia', 'en' => 'Le Sapaudia Pizzeria', 'es' => 'Pizzería Le Sapaudia', 'de' => 'Pizzeria Le Sapaudia', 'zh' => '萨帕迪亚披萨店', 'ar' => 'بيتزا لو سابوديا', 'it' => 'Pizzeria Le Sapaudia', 'pt' => 'Pizzaria Le Sapaudia', 'ru' => 'пиццерия Ле Сапаудиа', 'hi' => 'पिज़्ज़ेरिया ले सापौडिया',
        ],
        'Pizzeria Chez Ingalls' => [
            'fr' => 'Pizzeria Chez Ingalls', 'en' => 'Chez Ingalls Pizzeria', 'es' => 'Pizzería Chez Ingalls', 'de' => 'Pizzeria Chez Ingalls', 'zh' => '切兹·英加尔斯披萨店', 'ar' => 'بيتزا شِز إنغالز', 'it' => 'Pizzeria Chez Ingalls', 'pt' => 'Pizzaria Chez Ingalls', 'ru' => 'пиццерия Шез Ингаллс', 'hi' => 'पिज़्ज़ेरिया शेज़ इंगल्स',
        ],
        'Green Food Café' => [
            'fr' => 'Green Food Café', 'en' => 'Green Food Café', 'es' => 'Café Green Food', 'de' => 'Green Food Café', 'zh' => '绿色食品咖啡馆', 'ar' => 'مقهى جرين فود', 'it' => 'Green Food Café', 'pt' => 'Café Green Food', 'ru' => 'кафе Грин Фуд', 'hi' => 'ग्रीन फूड कैफ़े',
        ],
        'Le Bouddha Vert' => [
            'fr' => 'Le Bouddha Vert', 'en' => 'The Green Buddha', 'es' => 'El Buda Verde', 'de' => 'Der grüne Buddha', 'zh' => '绿佛', 'ar' => 'البوذا الأخضر', 'it' => 'Il Buddha Verde', 'pt' => 'O Buda Verde', 'ru' => 'Зелёный Будда', 'hi' => 'द ग्रीन बुद्धा',
        ],
        'Veggie Annecy' => [
            'fr' => 'Veggie Annecy', 'en' => 'Veggie Annecy', 'es' => 'Veggie Annecy', 'de' => 'Veggie Annecy', 'zh' => '素食安纳西', 'ar' => 'فيجي أنسي', 'it' => 'Veggie Annecy', 'pt' => 'Veggie Annecy', 'ru' => 'Вегги Аннеси', 'hi' => 'वेजी ऐनसी',
        ],
        'Traiteur Saveurs d’Annecy' => [
            'fr' => 'Traiteur Saveurs d’Annecy', 'en' => 'Saveurs d’Annecy Caterer', 'es' => 'Catering Saveurs d’Annecy', 'de' => 'Caterer Saveurs d’Annecy', 'zh' => '安纳西风味餐饮', 'ar' => 'تموين نكهات أنسي', 'it' => 'Catering Saveurs d’Annecy', 'pt' => 'Catering Saveurs d’Annecy', 'ru' => 'кейтеринг Saveurs d’Annecy', 'hi' => 'सेवूर द् ऐनसी कैटरिंग',
        ],
        'Traiteur La Gourmandine' => [
            'fr' => 'Traiteur La Gourmandine', 'en' => 'La Gourmandine Caterer', 'es' => 'Catering La Gourmandine', 'de' => 'Caterer La Gourmandine', 'zh' => '拉古尔曼丁餐饮', 'ar' => 'تموين لا غورمندين', 'it' => 'Catering La Gourmandine', 'pt' => 'Catering La Gourmandine', 'ru' => 'кейтеринг La Gourmandine', 'hi' => 'ला गोरमांदिन कैटरिंग',
        ],
        'Traiteur du Lac' => [
            'fr' => 'Traiteur du Lac', 'en' => 'Lake Caterer', 'es' => 'Catering del Lago', 'de' => 'Caterer am See', 'zh' => '湖餐饮', 'ar' => 'تموين البحيرة', 'it' => 'Catering del Lago', 'pt' => 'Catering do Lago', 'ru' => 'кейтеринг у озера', 'hi' => 'लेक कैटरर',
        ],
        'Le Vin T’Annecy' => [
            'fr' => 'Le Vin T’Annecy', 'en' => 'Le Vin T’Annecy', 'es' => 'Le Vin T’Annecy', 'de' => 'Le Vin T’Annecy', 'zh' => '莱旺坦西酒吧', 'ar' => 'لو فان تانسي', 'it' => 'Le Vin T’Annecy', 'pt' => 'Le Vin T’Annecy', 'ru' => 'Le Vin T’Annecy', 'hi' => 'ले वीन ट’ऐनसी',
        ],
        'La Cave' => [
            'fr' => 'La Cave', 'en' => 'La Cave', 'es' => 'La Cava', 'de' => 'La Cave', 'zh' => '酒窖', 'ar' => 'لا كاف', 'it' => 'La Cantina', 'pt' => 'A Caverna', 'ru' => 'Ля Кав', 'hi' => 'ला कैव',
        ],
        'Le Bouchon' => [
            'fr' => 'Le Bouchon', 'en' => 'Le Bouchon', 'es' => 'Le Bouchon', 'de' => 'Le Bouchon', 'zh' => '勒布雄餐厅', 'ar' => 'لو بوشون', 'it' => 'Le Bouchon', 'pt' => 'Le Bouchon', 'ru' => 'Лё Бушон', 'hi' => 'ले बुशों',
        ],
        'Le 7 Cocktail Bar' => [
            'fr' => 'Le 7 Cocktail Bar', 'en' => 'Le 7 Cocktail Bar', 'es' => 'Bar de cócteles Le 7', 'de' => 'Le 7 Cocktail Bar', 'zh' => '7号鸡尾酒吧', 'ar' => 'بار كوكتيل لو 7', 'it' => 'Le 7 Cocktail Bar', 'pt' => 'Bar de Cocktails Le 7', 'ru' => 'бар Le 7', 'hi' => 'ले 7 कॉकटेल बार',
        ],
        'Le Mix' => [
            'fr' => 'Le Mix', 'en' => 'Le Mix', 'es' => 'Le Mix', 'de' => 'Le Mix', 'zh' => '混合酒吧', 'ar' => 'لو ميكس', 'it' => 'Le Mix', 'pt' => 'Le Mix', 'ru' => 'Ле Микс', 'hi' => 'ले मिक्स',
        ],
        'Le Gatsby' => [
            'fr' => 'Le Gatsby', 'en' => 'Le Gatsby', 'es' => 'Le Gatsby', 'de' => 'Le Gatsby', 'zh' => '盖茨比酒吧', 'ar' => 'لو غاتسبي', 'it' => 'Le Gatsby', 'pt' => 'Le Gatsby', 'ru' => 'Ле Гэтсби', 'hi' => 'ले गैट्सबी',
        ],
        'The Queen’s Head' => [
            'fr' => 'The Queen’s Head', 'en' => 'The Queen’s Head', 'es' => 'The Queen’s Head', 'de' => 'The Queen’s Head', 'zh' => '女王之首酒吧', 'ar' => 'رأس الملكة', 'it' => 'The Queen’s Head', 'pt' => 'The Queen’s Head', 'ru' => 'The Queen’s Head', 'hi' => 'द क्वीन्स हेड',
        ],
        'O’Brady’s Irish Pub' => [
            'fr' => 'O’Brady’s Irish Pub', 'en' => 'O’Brady’s Irish Pub', 'es' => 'Pub Irlandés O’Brady’s', 'de' => 'O’Brady’s Irish Pub', 'zh' => '奥布拉迪爱尔兰酒吧', 'ar' => 'حانة أو برادي', 'it' => 'O’Brady’s Irish Pub', 'pt' => 'O’Brady’s Irish Pub', 'ru' => 'ирландский паб O’Brady’s', 'hi' => 'ओ’ब्रेडीज आयरिश पब',
        ],
        'Le Pub du Lac' => [
            'fr' => 'Le Pub du Lac', 'en' => 'The Lake Pub', 'es' => 'El Pub del Lago', 'de' => 'Pub am See', 'zh' => '湖畔酒馆', 'ar' => 'حانة البحيرة', 'it' => 'Il Pub del Lago', 'pt' => 'O Pub do Lago', 'ru' => 'паб у озера', 'hi' => 'लेक पब',
        ],
        'Café des Arts' => [
            'fr' => 'Café des Arts', 'en' => 'Café des Arts', 'es' => 'Café de las Artes', 'de' => 'Café des Arts', 'zh' => '艺术咖啡馆', 'ar' => 'مقهى الفنون', 'it' => 'Caffè delle Arti', 'pt' => 'Café das Artes', 'ru' => 'кафе искусств', 'hi' => 'कैफ़े देज़ आर्ट्स',
        ],
        'Café du Pâquier' => [
            'fr' => 'Café du Pâquier', 'en' => 'Pâquier Café', 'es' => 'Café del Pâquier', 'de' => 'Café du Pâquier', 'zh' => '帕基耶咖啡馆', 'ar' => 'مقهى باكييه', 'it' => 'Caffè del Pâquier', 'pt' => 'Café do Pâquier', 'ru' => 'кафе Пакье', 'hi' => 'पैकियर कैफ़े',
        ],
        'Café Royal' => [
            'fr' => 'Café Royal', 'en' => 'Café Royal', 'es' => 'Café Royal', 'de' => 'Café Royal', 'zh' => '皇家咖啡馆', 'ar' => 'مقهى رويال', 'it' => 'Caffè Royal', 'pt' => 'Café Royal', 'ru' => 'Кафе Рояль', 'hi' => 'कैफ़े रॉयल',
        ],
        'Pâtisserie Philippe Rigollot' => [
            'fr' => 'Pâtisserie Philippe Rigollot', 'en' => 'Philippe Rigollot Pastry', 'es' => 'Pastelería Philippe Rigollot', 'de' => 'Patisserie Philippe Rigollot', 'zh' => '菲利普·里戈洛甜品店', 'ar' => 'مخبوزات فيليب ريجولو', 'it' => 'Pasticceria Philippe Rigollot', 'pt' => 'Confeitaria Philippe Rigollot', 'ru' => 'кондитерская Филипп Риголло', 'hi' => 'पैटिसरी फिलिप रिगोलोट',
        ],
        'Pâtisserie Chocolatier Meyer' => [
            'fr' => 'Pâtisserie Chocolatier Meyer', 'en' => 'Chocolatier Meyer Pastry', 'es' => 'Pastelería Chocolatier Meyer', 'de' => 'Patisserie Chocolatier Meyer', 'zh' => '梅耶甜品店', 'ar' => 'مخبوزات شوكولاتيه ماير', 'it' => 'Pasticceria Chocolatier Meyer', 'pt' => 'Confeitaria Chocolatier Meyer', 'ru' => 'кондитерская Шоколатье Майер', 'hi' => 'पैटिसरी चॉकलेटियर मेयर',
        ],
        'Pâtisserie du Lac' => [
            'fr' => 'Pâtisserie du Lac', 'en' => 'Lake Pastry', 'es' => 'Pastelería del Lago', 'de' => 'Patisserie am See', 'zh' => '湖畔甜品店', 'ar' => 'مخبوزات البحيرة', 'it' => 'Pasticceria del Lago', 'pt' => 'Confeitaria do Lago', 'ru' => 'кондитерская у озера', 'hi' => 'लेक पैसٹری',
        ],
        'Boulangerie Chevallier' => [
            'fr' => 'Boulangerie Chevallier', 'en' => 'Chevallier Bakery', 'es' => 'Panadería Chevallier', 'de' => 'Bäckerei Chevallier', 'zh' => '舍瓦利埃面包店', 'ar' => 'مخبز شيفالير', 'it' => 'Panetteria Chevallier', 'pt' => 'Padaria Chevallier', 'ru' => 'булочная Шевалье', 'hi' => 'बेकरी शेवैलियर',
        ],
        'Boulangerie du Thiou' => [
            'fr' => 'Boulangerie du Thiou', 'en' => 'Thiou Bakery', 'es' => 'Panadería del Thiou', 'de' => 'Bäckerei du Thiou', 'zh' => '蒂乌面包店', 'ar' => 'مخبز دو تيو', 'it' => 'Panetteria du Thiou', 'pt' => 'Padaria du Thiou', 'ru' => 'булочная дю Тью', 'hi' => 'थियू बेकरी',
        ],
        'Maison Pochat' => [
            'fr' => 'Maison Pochat', 'en' => 'Maison Pochat', 'es' => 'Maison Pochat', 'de' => 'Maison Pochat', 'zh' => '波查之家', 'ar' => 'ميزون بوتشا', 'it' => 'Maison Pochat', 'pt' => 'Maison Pochat', 'ru' => 'Мезон Поша', 'hi' => 'मेज़ॉन पोशात',
        ],
        'Fromagerie Pierre Gay' => [
            'fr' => 'Fromagerie Pierre Gay', 'en' => 'Pierre Gay Cheese Shop', 'es' => 'Quesería Pierre Gay', 'de' => 'Käserei Pierre Gay', 'zh' => '皮埃尔·盖奶酪店', 'ar' => 'مبسترة بيير غاي', 'it' => 'Caseificio Pierre Gay', 'pt' => 'Queijaria Pierre Gay', 'ru' => 'сырный магазин Пьер Гай', 'hi' => 'फ्रोमाजरी पियरे गाय',
        ],
        'Fromagerie du Lac' => [
            'fr' => 'Fromagerie du Lac', 'en' => 'Lake Cheese Shop', 'es' => 'Quesería del Lago', 'de' => 'Käserei am See', 'zh' => '湖畔奶酪店', 'ar' => 'مبسترة البحيرة', 'it' => 'Caseificio del Lago', 'pt' => 'Queijaria do Lago', 'ru' => 'сырная лавка у озера', 'hi' => 'लेक चीज़ शॉप',
        ],
        'Fromagerie Les Alpages' => [
            'fr' => 'Fromagerie Les Alpages', 'en' => 'Les Alpages Cheese Shop', 'es' => 'Quesería Les Alpages', 'de' => 'Käserei Les Alpages', 'zh' => '阿尔帕日奶酪店', 'ar' => 'مبسترة ليه ألباج', 'it' => 'Caseificio Les Alpages', 'pt' => 'Queijaria Les Alpages', 'ru' => 'сыроварня Ле Альпаж', 'hi' => 'लेज़ अलपाज क्लिक',
        ],
        // Hébergements
        'Impérial Palace' => [
            'fr' => 'Impérial Palace', 'en' => 'Impérial Palace', 'es' => 'Impérial Palace', 'de' => 'Impérial Palace', 'zh' => '帝国皇宫', 'ar' => 'قصر الإمبريال', 'it' => 'Impérial Palace', 'pt' => 'Impérial Palace', 'ru' => 'Империал Палас', 'hi' => 'इम्पीरियल पैलेस',
        ],
        'Les Trésoms' => [
            'fr' => 'Les Trésoms', 'en' => 'Les Trésoms', 'es' => 'Les Trésoms', 'de' => 'Les Trésoms', 'zh' => '勒特雷索姆', 'ar' => 'ليه تريزوم', 'it' => 'Les Trésoms', 'pt' => 'Les Trésoms', 'ru' => 'Ле Трезом', 'hi' => 'ले ट्रेजॉम्स',
        ],
        'Hôtel Black Bass' => [
            'fr' => 'Hôtel Black Bass', 'en' => 'Black Bass Hotel', 'es' => 'Hotel Black Bass', 'de' => 'Hotel Black Bass', 'zh' => '黑郎酒店', 'ar' => 'فندق بلاك باس', 'it' => 'Hotel Black Bass', 'pt' => 'Hotel Black Bass', 'ru' => 'отель Блэк Басс', 'hi' => 'होटल ब्लैक बैस',
        ],
        'Hôtel Splendid' => [
            'fr' => 'Hôtel Splendid', 'en' => 'Hôtel Splendid', 'es' => 'Hotel Splendid', 'de' => 'Hotel Splendid', 'zh' => '斯普伦迪德酒店', 'ar' => 'فندق سبلينديد', 'it' => 'Hotel Splendid', 'pt' => 'Hotel Splendid', 'ru' => 'отель Сплендид', 'hi' => 'होटल स्प्लेंडिड',
        ],
        'Hôtel Le Pré Carré' => [
            'fr' => 'Hôtel Le Pré Carré', 'en' => 'Le Pré Carré Hotel', 'es' => 'Hotel Le Pré Carré', 'de' => 'Hotel Le Pré Carré', 'zh' => '勒普雷卡雷酒店', 'ar' => 'فندق لو بري كاريه', 'it' => 'Hotel Le Pré Carré', 'pt' => 'Hotel Le Pré Carré', 'ru' => 'отель Ле Пре Карре', 'hi' => 'होटल ले प्रे कार्रे',
        ],
        'Hôtel Novotel' => [
            'fr' => 'Hôtel Novotel', 'en' => 'Novotel Hotel', 'es' => 'Hotel Novotel', 'de' => 'Hotel Novotel', 'zh' => '诺富特酒店', 'ar' => 'فندق نوفوتيل', 'it' => 'Hotel Novotel', 'pt' => 'Hotel Novotel', 'ru' => 'отель Новотель', 'hi' => 'होटल नोवोटेल',
        ],
        'Hôtel du Nord' => [
            'fr' => 'Hôtel du Nord', 'en' => 'Hôtel du Nord', 'es' => 'Hotel du Nord', 'de' => 'Hotel du Nord', 'zh' => '北方酒店', 'ar' => 'فندق دو نورد', 'it' => 'Hotel du Nord', 'pt' => 'Hotel du Nord', 'ru' => 'отель дю Нор', 'hi' => 'होटल दु नॉर्ड',
        ],
        'Hôtel des Alpes' => [
            'fr' => 'Hôtel des Alpes', 'en' => 'Hôtel des Alpes', 'es' => 'Hotel des Alpes', 'de' => 'Hotel des Alpes', 'zh' => '阿尔卑斯酒店', 'ar' => 'فندق ديز ألب', 'it' => 'Hotel des Alpes', 'pt' => 'Hotel des Alpes', 'ru' => 'отель де Альпы', 'hi' => 'होटल देज़ आल्प्स',
        ],
        'Hôtel Ibis Styles' => [
            'fr' => 'Hôtel Ibis Styles', 'en' => 'Ibis Styles Hotel', 'es' => 'Hotel Ibis Styles', 'de' => 'Hotel Ibis Styles', 'zh' => '宜必思风格酒店', 'ar' => 'فندق إيبيس ستايلز', 'it' => 'Hotel Ibis Styles', 'pt' => 'Hotel Ibis Styles', 'ru' => 'отель Ибис Стайлс', 'hi' => 'होटल इबिस स्टाइल्स',
        ],
        'Hôtel Le Boutik' => [
            'fr' => 'Hôtel Le Boutik', 'en' => 'Le Boutik Hotel', 'es' => 'Hotel Le Boutik', 'de' => 'Hotel Le Boutik', 'zh' => '乐布蒂克酒店', 'ar' => 'فندق لو بوتيك', 'it' => 'Hotel Le Boutik', 'pt' => 'Hotel Le Boutik', 'ru' => 'отель Ле Бутик', 'hi' => 'होटल ले बुटिक',
        ],
        'Hôtel Atipik' => [
            'fr' => 'Hôtel Atipik', 'en' => 'Atipik Hotel', 'es' => 'Hotel Atipik', 'de' => 'Hotel Atipik', 'zh' => '阿蒂皮克酒店', 'ar' => 'فندق أتيبيك', 'it' => 'Hotel Atipik', 'pt' => 'Hotel Atipik', 'ru' => 'отель Атипик', 'hi' => 'होटल अतीपिक',
        ],
        'Hôtel Les Cygnes' => [
            'fr' => 'Hôtel Les Cygnes', 'en' => 'Les Cygnes Hotel', 'es' => 'Hotel Les Cygnes', 'de' => 'Hotel Les Cygnes', 'zh' => '天鹅酒店', 'ar' => 'فندق ليه سيغن', 'it' => 'Hotel Les Cygnes', 'pt' => 'Hotel Les Cygnes', 'ru' => 'отель Ле Синь', 'hi' => 'होटल ले सिग्नेस',
        ],
        'La Villa du Lac' => [
            'fr' => 'La Villa du Lac', 'en' => 'La Villa du Lac', 'es' => 'La Villa del Lago', 'de' => 'La Villa du Lac', 'zh' => '湖畔别墅', 'ar' => 'لا فيلا دو لاك', 'it' => 'La Villa del Lago', 'pt' => 'La Villa do Lago', 'ru' => 'Вилла у озера', 'hi' => 'ला विला डु लैक',
        ],
        'Les Jardins Secrets' => [
            'fr' => 'Les Jardins Secrets', 'en' => 'The Secret Gardens', 'es' => 'Los Jardines Secretos', 'de' => 'Die geheimen Gärten', 'zh' => '秘密花园', 'ar' => 'الحدائق السرية', 'it' => 'I Giardini Segreti', 'pt' => 'Os Jardins Secretos', 'ru' => 'Секретные сады', 'hi' => 'द सीक्रेट गार्डन्स',
        ],
        'Le Clos des Sens' => [
            'fr' => 'Le Clos des Sens', 'en' => 'Le Clos des Sens', 'es' => 'Le Clos des Sens', 'de' => 'Le Clos des Sens', 'zh' => '感官庄园', 'ar' => 'لو كلوز دي سان', 'it' => 'Le Clos des Sens', 'pt' => 'Le Clos des Sens', 'ru' => 'Ле Кло де Сенс', 'hi' => 'ले क्लो दे सेंस',
        ],
        'Auberge de Jeunesse Annecy' => [
            'fr' => 'Auberge de Jeunesse Annecy', 'en' => 'Annecy Youth Hostel', 'es' => 'Albergue Juvenil Annecy', 'de' => 'Jugendherberge Annecy', 'zh' => '安纳西青年旅舍', 'ar' => 'بيت الشباب أنسي', 'it' => 'Ostello della gioventù Annecy', 'pt' => 'Albergue Juvenil Annecy', 'ru' => 'хостел Аннеси', 'hi' => 'ऐनसी यूथ हॉस्टल',
        ],
        'Auberge du Lac' => [
            'fr' => 'Auberge du Lac', 'en' => 'Lake Hostel', 'es' => 'Hostal del Lago', 'de' => 'Herberge am See', 'zh' => '湖畔旅馆', 'ar' => 'بيت الشباب البحيرة', 'it' => 'Ostello del Lago', 'pt' => 'Albergue do Lago', 'ru' => 'хостел у озера', 'hi' => 'लेक ऑबर्ज',
        ],
        'Auberge Les Alpages' => [
            'fr' => 'Auberge Les Alpages', 'en' => 'Les Alpages Hostel', 'es' => 'Hostal Les Alpages', 'de' => 'Herberge Les Alpages', 'zh' => '阿尔帕日旅馆', 'ar' => 'نزل ليه ألباج', 'it' => 'Ostello Les Alpages', 'pt' => 'Albergue Les Alpages', 'ru' => 'хостел Ле Альпаж', 'hi' => 'लेज़ अल्पाज हॉस्टल',
        ],
        'Appartement Le Pâquier' => [
            'fr' => 'Appartement Le Pâquier', 'en' => 'Le Pâquier Apartment', 'es' => 'Apartamento Le Pâquier', 'de' => 'Appartement Le Pâquier', 'zh' => '帕基耶公寓', 'ar' => 'شقة لو باكييه', 'it' => 'Appartamento Le Pâquier', 'pt' => 'Apartamento Le Pâquier', 'ru' => 'апартамент Ле Пакье', 'hi' => 'अपार्टमेंट ले पैकिये',
        ],
        'Appartement Les Clarisses' => [
            'fr' => 'Appartement Les Clarisses', 'en' => 'Les Clarisses Apartment', 'es' => 'Apartamento Les Clarisses', 'de' => 'Appartement Les Clarisses', 'zh' => '克拉里斯公寓', 'ar' => 'شقة ليه كلاريس', 'it' => 'Appartamento Les Clarisses', 'pt' => 'Apartamento Les Clarisses', 'ru' => 'апартамент Ле Кларисс', 'hi' => 'अपार्टमेंट ले क्लारिस्सेस',
        ],
        'Appartement Carnot' => [
            'fr' => 'Appartement Carnot', 'en' => 'Carnot Apartment', 'es' => 'Apartamento Carnot', 'de' => 'Appartement Carnot', 'zh' => '卡尔诺公寓', 'ar' => 'شقة كارنو', 'it' => 'Appartamento Carnot', 'pt' => 'Apartamento Carnot', 'ru' => 'апартамент Карно', 'hi' => 'कार्नोट अपार्टमेंट',
        ],
        'Villa du Lac' => [
            'fr' => 'Villa du Lac', 'en' => 'Villa du Lac', 'es' => 'Villa del Lago', 'de' => 'Villa du Lac', 'zh' => '湖畔别墅', 'ar' => 'فيلا دو لاك', 'it' => 'Villa del Lago', 'pt' => 'Villa do Lago', 'ru' => 'вилла у озера', 'hi' => 'विला डु लैक',
        ],
        'Villa Les Trésoms' => [
            'fr' => 'Villa Les Trésoms', 'en' => 'Les Trésoms Villa', 'es' => 'Villa Les Trésoms', 'de' => 'Villa Les Trésoms', 'zh' => '特雷索姆别墅', 'ar' => 'فيلا ليه تريزوم', 'it' => 'Villa Les Trésoms', 'pt' => 'Villa Les Trésoms', 'ru' => 'вилла Ле Трезом', 'hi' => 'विला ले ट्रेजॉम्स',
        ],
        'Villa Royale' => [
            'fr' => 'Villa Royale', 'en' => 'Villa Royale', 'es' => 'Villa Royale', 'de' => 'Villa Royale', 'zh' => '皇家别墅', 'ar' => 'فيلا رويال', 'it' => 'Villa Royale', 'pt' => 'Villa Royale', 'ru' => 'Вилла Рояль', 'hi' => 'विला रोयाल',
        ],
        'Gîte La Clusaz' => [
            'fr' => 'Gîte La Clusaz', 'en' => 'La Clusaz Gîte', 'es' => 'Gîte La Clusaz', 'de' => 'Gîte La Clusaz', 'zh' => '拉克鲁萨小屋', 'ar' => 'نزل لا كلوزاز', 'it' => 'Gîte La Clusaz', 'pt' => 'Gîte La Clusaz', 'ru' => 'гит Ла Клюза', 'hi' => 'गीटे ला क्लुसाज़',
        ],
        'Gîte Les Alpages' => [
            'fr' => 'Gîte Les Alpages', 'en' => 'Les Alpages Gîte', 'es' => 'Gîte Les Alpages', 'de' => 'Gîte Les Alpages', 'zh' => '阿尔帕日小屋', 'ar' => 'نزل ليه ألباج', 'it' => 'Gîte Les Alpages', 'pt' => 'Gîte Les Alpages', 'ru' => 'гит Ле Альпаж', 'hi' => 'गीटे लेज़ अल्पाज',
        ],
        'Gîte du Semnoz' => [
            'fr' => 'Gîte du Semnoz', 'en' => 'Semnoz Gîte', 'es' => 'Gîte du Semnoz', 'de' => 'Gîte du Semnoz', 'zh' => '塞姆诺兹小屋', 'ar' => 'نزل سيمنوز', 'it' => 'Gîte du Semnoz', 'pt' => 'Gîte du Semnoz', 'ru' => 'гит Семноз', 'hi' => 'गीटे डु सेमनोज़',
        ],
        'Camping Les Rives du Lac' => [
            'fr' => 'Camping Les Rives du Lac', 'en' => 'Les Rives du Lac Camping', 'es' => 'Camping Les Rives du Lac', 'de' => 'Camping Les Rives du Lac', 'zh' => '湖畔营地', 'ar' => 'مخيم سواحل البحيرة', 'it' => 'Camping Les Rives du Lac', 'pt' => 'Camping Les Rives do Lago', 'ru' => 'кемпинг на берегу озера', 'hi' => 'कैंपिंग ले रिवे डु लैक',
        ],
        'Camping Le Belvédère' => [
            'fr' => 'Camping Le Belvédère', 'en' => 'Le Belvédère Camping', 'es' => 'Camping Le Belvédère', 'de' => 'Camping Le Belvédère', 'zh' => '观景营地', 'ar' => 'مخيم لو بلفيدير', 'it' => 'Camping Le Belvédère', 'pt' => 'Camping Le Belvédère', 'ru' => 'кемпинг Бельведер', 'hi' => 'कैंपिंग ले बेल्वेदेरे',
        ],
        'Camping La Chapelle Saint Claude' => [
            'fr' => 'Camping La Chapelle Saint Claude', 'en' => 'La Chapelle Saint Claude Camping', 'es' => 'Camping La Chapelle Saint Claude', 'de' => 'Camping La Chapelle Saint Claude', 'zh' => '圣克洛德小教堂营地', 'ar' => 'مخيم لا شابيل سان كلود', 'it' => 'Camping La Chapelle Saint Claude', 'pt' => 'Camping La Chapelle Saint Claude', 'ru' => 'кемпинг Ля Шапель Сен Клод', 'hi' => 'कैंपिंग ला चैपेल सेंट क्लाउड',
        ],
        'Mobil-home Les Clarisses' => [
            'fr' => 'Mobil-home Les Clarisses', 'en' => 'Les Clarisses Mobile Home', 'es' => 'Mobil-home Les Clarisses', 'de' => 'Mobilheim Les Clarisses', 'zh' => '克拉里斯移动房屋', 'ar' => 'منازل متنقلة ليه كلاريس', 'it' => 'Mobil-home Les Clarisses', 'pt' => 'Mobil-home Les Clarisses', 'ru' => 'мобильный дом Les Clarisses', 'hi' => 'मोबिल-होम ले क्लारिस्सेस',
        ],
        'Mobil-home du Lac' => [
            'fr' => 'Mobil-home du Lac', 'en' => 'Lake Mobile Home', 'es' => 'Mobil-home del Lago', 'de' => 'Mobilheim am See', 'zh' => '湖边移动房屋', 'ar' => 'منازل متنقلة البحيرة', 'it' => 'Mobil-home del Lago', 'pt' => 'Mobil-home do Lago', 'ru' => 'мобильный дом у озера', 'hi' => 'लेक मोबिल-होम',
        ],
        'Mobil-home Carnot' => [
            'fr' => 'Mobil-home Carnot', 'en' => 'Carnot Mobile Home', 'es' => 'Mobil-home Carnot', 'de' => 'Mobilheim Carnot', 'zh' => '卡尔诺移动房屋', 'ar' => 'منازل متنقلة كارنو', 'it' => 'Mobil-home Carnot', 'pt' => 'Mobil-home Carnot', 'ru' => 'мобильный дом Карно', 'hi' => 'कार्नोट मोबिल-होम',
        ],
        'Chalet du Semnoz' => [
            'fr' => 'Chalet du Semnoz', 'en' => 'Semnoz Chalet', 'es' => 'Chalet du Semnoz', 'de' => 'Chalet du Semnoz', 'zh' => '塞姆诺兹小木屋', 'ar' => 'شاليه سيمنوز', 'it' => 'Chalet du Semnoz', 'pt' => 'Chalet du Semnoz', 'ru' => 'шале Семноз', 'hi' => 'शैलेट डु सेमनोज़',
        ],
        'Chalet Les Alpages' => [
            'fr' => 'Chalet Les Alpages', 'en' => 'Les Alpages Chalet', 'es' => 'Chalet Les Alpages', 'de' => 'Chalet Les Alpages', 'zh' => '阿尔帕日小屋', 'ar' => 'شاليه ليه ألباج', 'it' => 'Chalet Les Alpages', 'pt' => 'Chalet Les Alpages', 'ru' => 'шале Ле Альпаж', 'hi' => 'शैलेट लेज़ अल्पाज',
        ],
        'Chalet du Lac' => [
            'fr' => 'Chalet du Lac', 'en' => 'Lake Chalet', 'es' => 'Chalet del Lago', 'de' => 'Chalet am See', 'zh' => '湖畔小木屋', 'ar' => 'شاليه البحيرة', 'it' => 'Chalet del Lago', 'pt' => 'Chalet do Lago', 'ru' => 'шале у озера', 'hi' => 'लेक शैलेट',
        ],
    ];

    // If a specific language is requested, return it; otherwise fallback to English then French then original
    if (isset($map[$nameFr]) && isset($map[$nameFr][$lang]) && $map[$nameFr][$lang] !== '') {
        return $map[$nameFr][$lang];
    }
    if (isset($map[$nameFr]['en']) && $map[$nameFr]['en'] !== '') {
        return $map[$nameFr]['en'];
    }
    if (isset($map[$nameFr]['fr']) && $map[$nameFr]['fr'] !== '') {
        return $map[$nameFr]['fr'];
    }

    return $nameFr;
}

function translate_address($addressFr, $lang)
{
    // Pour simplifier, on garde l'adresse telle quelle en EN et AR
    return $addressFr;
}

function translate_place_description($nameFr, $addressFr, $catName, $lang)
{
    $name = translate_place_name($nameFr, $lang);
    $address = translate_address($addressFr, $lang);
    $templates = [
        'fr' => '%s situé à %s dans la catégorie %s.',
        'en' => '%s located at %s in the category %s.',
        'es' => '%s ubicado en %s en la categoría %s.',
        'de' => '%s gelegen in %s in der Kategorie %s.',
        'zh' => '%s 位于 %s，属于 %s 类别。',
        'ar' => '%s في %s ضمن فئة %s.',
        'it' => '%s situato a %s nella categoria %s.',
        'pt' => '%s localizado em %s na categoria %s.',
        'ru' => '%s расположен по адресу %s в категории %s.',
        'hi' => '%s %s पर स्थित है, श्रेणी %s में।',
    ];
    $tpl = $templates[$lang] ?? $templates['en'];

    return sprintf($tpl, $name, $address, $catName);
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
            $locales = ['fr', 'en', 'es', 'de', 'zh', 'ar', 'it', 'pt', 'ru', 'hi'];

            // category groups for extension models
            $gastronomyCategories = ['Traditionnels', 'Gastronomiques', 'Fast-food', 'Brasseries', 'Pizzerias', 'Végétariens', 'Traiteurs', 'Bars à vin', 'Bars à cocktails', 'Pubs', 'Cafés', 'Pâtisseries', 'Boulangeries', 'Fromageries'];
            $accommodationCategories = ['5 étoiles', '4 étoiles', '3 étoiles', 'Boutique hôtels', 'Chambres d\'hôtes', 'Auberges de jeunesse', 'Appartements', 'Villas', 'Gîtes', 'Tentes', 'Mobil-homes', 'Chalets'];
            $trailCategories = ['Randonnée', 'Trails', 'Trails'];

            foreach ($realPlaces as $catNameFr => $places) {
                $cat = Category::where('name->fr', $catNameFr)->first();
                if (! $cat) {
                    continue;
                }
                $names = $cat->getTranslations('name');
                foreach ($places as $idx => [$placeNameFr, $addressFr]) {
                    $translations = [
                        'name' => [],
                        'address' => [],
                        'description' => [],
                        'short_description' => [],
                        'seo_title' => [],
                        'seo_description' => [],
                        'og_title' => [],
                        'og_description' => [],
                        'featured_image_alt' => [],
                    ];

                    foreach ($locales as $lang) {
                        $nameTrans = $lang === 'fr' ? $placeNameFr : translate_place_name($placeNameFr, $lang);
                        $addrTrans = $lang === 'fr' ? $addressFr : translate_address($addressFr, $lang);
                        $catNameLocal = $names[$lang] ?? $catNameFr;
                        $descTrans = $lang === 'fr'
                            ? sprintf('%s situé à %s dans la catégorie %s.', $nameTrans, $addrTrans, $catNameLocal)
                            : translate_place_description($placeNameFr, $addressFr, $catNameLocal, $lang);
                        $short = mb_substr($descTrans, 0, 140);
                        $seoTitle = $nameTrans.' - '.$catNameLocal;
                        $seoDesc = $short;

                        $translations['name'][$lang] = $nameTrans;
                        $translations['address'][$lang] = $addrTrans;
                        $translations['description'][$lang] = $descTrans;
                        $translations['short_description'][$lang] = $short;
                        $translations['seo_title'][$lang] = $seoTitle;
                        $translations['seo_description'][$lang] = $seoDesc;
                        $translations['og_title'][$lang] = $seoTitle;
                        $translations['og_description'][$lang] = $seoDesc;
                        $translations['featured_image_alt'][$lang] = $nameTrans;
                    }

                    // Normalize: si par accident une des valeurs contient un JSON encodé
                    // avec toutes les traductions (double-encodage), on le corrige.
                    $keysToCheck = ['name', 'description', 'short_description', 'seo_title', 'seo_description', 'og_title', 'og_description', 'featured_image_alt'];
                    foreach ($keysToCheck as $k) {
                        // If one of the language values is itself a JSON object containing
                        // locale keys, unwrap recursively until we have simple strings.
                        $found = false;
                        foreach ($translations[$k] as $lang => $val) {
                            if (is_string($val) && strlen($val) > 1 && $val[0] === '{') {
                                $maybe = json_decode($val, true);
                                if (is_array($maybe) && count(array_intersect(array_keys($maybe), $locales)) > 0) {
                                    // unwrap recursively
                                    $normalized = $maybe;
                                    $changed = true;
                                    while ($changed) {
                                        $changed = false;
                                        foreach ($normalized as $lk => $lv) {
                                            if (is_string($lv) && strlen($lv) > 1 && $lv[0] === '{') {
                                                $d = json_decode($lv, true);
                                                if (is_array($d) && count(array_intersect(array_keys($d), $locales)) > 0) {
                                                    $normalized = $d;
                                                    $changed = true;
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    $translations[$k] = $normalized;
                                    $found = true;
                                    break;
                                }
                            }
                        }
                        if ($found) {
                            // if we corrected this key, move to next key
                            continue;
                        }
                    }

                    $slugTranslations = [];
                    foreach ($locales as $lang) {
                        $slugTranslations[$lang] = Str::slug($translations['name'][$lang]);
                    }

                    $placeData = [
                        'owner_id' => $admin->id,
                        'category_id' => $cat->id,
                        'status' => 'published',
                        'is_verified' => true,
                        'is_featured' => false,
                        'latitude' => 45.9 + ($idx * 0.01),
                        'longitude' => 6.1 + ($idx * 0.01),
                        'elevation' => 450 + ($idx * 10),
                        'address_full' => $translations['address']['fr'],
                        'postal_code' => '74000',
                        'city_name' => 'Annecy',
                        'name' => $translations['name'],
                        'slug' => $slugTranslations,
                        'description' => $translations['description'],
                        'short_description' => $translations['short_description'],
                        'seo_data' => [
                            'meta' => [],
                            'seo_title' => $translations['seo_title'],
                            'seo_description' => $translations['seo_description'],
                            'og_title' => $translations['og_title'],
                            'og_description' => $translations['og_description'],
                            'featured_image_alt' => $translations['featured_image_alt'],
                        ],
                        'socials' => [],
                        'opening_hours' => ['mon' => '09:00-18:00', 'tue' => '09:00-18:00', 'wed' => '09:00-18:00', 'thu' => '09:00-18:00', 'fri' => '09:00-18:00', 'sat' => '10:00-17:00', 'sun' => '10:00-16:00'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // Create Place (model will auto-generate UUID)
                    $place = Place::create($placeData);

                    // Create related extension models according to category group
                    if (in_array($catNameFr, $gastronomyCategories, true)) {
                        PlaceGastronomy::create([
                            'place_id' => $place->id,
                            'cuisine_types' => ['Local'],
                            'dietary_types' => [],
                            'price_level' => 2,
                            'avg_price_dish' => 20.00,
                            'michelin_stars' => 0,
                            'chef_name' => null,
                        ]);
                    }
                    if (in_array($catNameFr, $accommodationCategories, true)) {
                        PlaceAccommodation::create([
                            'place_id' => $place->id,
                            'type' => 'hotel',
                            'star_rating' => 3,
                            'total_units' => 10,
                            'total_beds' => 20,
                        ]);
                    }
                    if (in_array($catNameFr, $trailCategories, true)) {
                        PlaceTrail::create([
                            'place_id' => $place->id,
                            'activity_type' => 'hiking',
                            'difficulty' => 'moderate',
                            'distance_km' => 8.5,
                            'elevation_gain' => 450,
                            'elevation_loss' => 450,
                            'max_altitude' => 1700,
                            'is_loop' => true,
                            'season_start' => null,
                            'season_end' => null,
                        ]);
                    }
                    // For shops/venues we could add similar creation rules if categories exist
                }
            }
        });

        // Vérification d'intégrité : chaque feuille doit avoir 3 lieux
        $leafCategories = Category::doesntHave('children')->get();
        $missingPlaces = [];
        foreach ($leafCategories as $cat) {
            $count = Place::where('category_id', $cat->id)->count();
            if ($count < 3) {
                $names = $cat->getTranslations('name');
                $missingPlaces[] = ($names['fr'] ?? $cat->name).' ('.$count.'/3)';
            }
        }
        if (count($missingPlaces) > 0) {
            throw new \Exception('Places manquantes ou incomplètes: '.implode(', ', $missingPlaces));
        }
    }
}
