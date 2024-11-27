<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
        INSERT INTO `cities` (`id`, `name_ar`, `name_en`, `country_id`) VALUES
(1, 'تبوك', 'Tabuk',1),
(3, 'الرياض', 'Riyadh',1),
(5, 'الطائف', 'At Taif', 1),
(6, 'مكة المكرمة', 'Makkah Al Mukarramah', 1),
(10, 'حائل', 'Hail',1),
(11, 'بريدة', 'Buraydah',1),
(12, 'الهفوف', 'Al Hufuf', 1),
(13, 'الدمام', 'Ad Dammam', 1),
(14, 'المدينة المنورة', 'Al Madinah Al Munawwarah',1),
(15, 'ابها', 'Abha',1),
(17, 'جازان', 'Jazan', 1),
(18, 'جدة', 'Jeddah', 1),
(24, 'المجمعة', 'Al Majmaah',1),
(31, 'الخبر', 'Al Khubar', 1),
(47, 'حفر الباطن', 'Hafar Al Batin', 1),
(62, 'خميس مشيط', 'Khamis Mushayt',1),
(65, 'احد رفيده', 'Ahad Rifaydah',1),
(67, 'القطيف', 'Al Qatif', 1),
(80, 'عنيزة', 'Unayzah',1),
(89, 'قرية العليا', 'Qaryat Al Ulya', 1),
(113, 'الجبيل', 'Al Jubail', 1),
(115, 'النعيرية', 'An Nuayriyah', 1),
(227, 'الظهران', 'Dhahran', 1),
(233, 'الوجه', 'Al Wajh',1),
(243, 'بقيق', 'Buqayq', 1),
(270, 'الزلفي', 'Az Zulfi',1),
(288, 'خيبر', 'Khaybar',1),
(306, 'الغاط', 'Al Ghat',1),
(323, 'املج', 'Umluj',1),
(377, 'رابغ', 'Rabigh', 1),
(418, 'عفيف', 'Afif',1),
(443, 'ثادق', 'Thadiq',1),
(454, 'سيهات', 'Sayhat', 1),
(456, 'تاروت', 'Tarut', 1),
(483, 'ينبع', 'Yanbu',1),
(500, 'شقراء', 'Shaqra',1),
(669, 'الدوادمي', 'Ad Duwadimi',1),
(828, 'الدرعية', 'Ad Diriyah',1),
(880, 'القويعية', 'Quwayiyah',1),
(990, 'المزاحمية', 'Al Muzahimiyah',1),
(1053, 'بدر', 'Badr',1),
(1061, 'الخرج', 'Al Kharj',1),
(1073, 'الدلم', 'Ad Dilam',1),
(1228, 'الشنان', 'Ash Shinan',1),
(1248, 'الخرمة', 'Al Khurmah', 1),
(1257, 'الجموم', 'Al Jumum', 1),
(1294, 'المجاردة', 'Al Majardah',1),
(1361, 'السليل', 'As Sulayyil',1),
(1443, 'تثليث', 'Tathilith',1),
(1514, 'بيشة', 'Bishah',1),
(1542, 'الباحة', 'Al Baha',1),
(1625, 'القنفذة', 'Al Qunfidhah', 1),
(1801, 'محايل', 'Muhayil',1),
(1879, 'ثول', 'Thuwal', 1),
(1947, 'ضبا', 'Duba',1),
(2156, 'تربه', 'Turbah', 1),
(2167, 'صفوى', 'Safwa', 1),
(2171, 'عنك', 'Inak', 1),
(2208, 'طريف', 'Turaif',1),
(2213, 'عرعر', 'Arar',1),
(2226, 'القريات', 'Al Qurayyat',1),
(2237, 'سكاكا', 'Sakaka',1),
(2256, 'رفحاء', 'Rafha',1),
(2268, 'دومة الجندل', 'Dawmat Al Jandal',1),
(2421, 'الرس', 'Ar Rass',1),
(2448, 'المذنب', 'Al Midhnab',1),
(2464, 'الخفجي', 'Al Khafji', 1),
(2467, 'رياض الخبراء', 'Riyad Al Khabra',1),
(2481, 'البدائع', 'Al Badai',1),
(2590, 'رأس تنورة', 'Ras Tannurah', 1),
(2630, 'البكيرية', 'Al Bukayriyah',1),
(2777, 'الشماسية', 'Ash Shimasiyah',1),
(3158, 'الحريق', 'Al Hariq',1),
(3161, 'حوطة بني تميم', 'Hawtat Bani Tamim',1),
(3174, 'ليلى', 'Layla',1),
(3275, 'بللسمر', 'Billasmar',1),
(3347, 'شرورة', 'Sharurah', 1),
(3417, 'نجران', 'Najran', 1),
(3479, 'صبيا', 'Sabya', 1),
(3525, 'ابو عريش', 'Abu Arish', 1),
(3542, 'صامطة', 'Samtah', 1),
(3652, 'احد المسارحة', 'Ahad Al Musarihah', 1),
(3666, 'مدينة الملك عبدالله الاقتصادية', 'King Abdullah Economic City', 1);
        ");

        DB::insert(
            "INSERT INTO `cities` (`name_ar`, `name_en`, `country_id`) VALUES
                    ('القاهرة', 'Cairo', '2'),
                    ('الجيزة', 'Giza', '2'),
                    ('الأسكندرية', 'Alexandria', '2'),
                    ('الدقهلية', 'Dakahlia', '2'),
                    ('البحر الأحمر', 'Red Sea', '2'),
                    ('البحيرة', 'Beheira', '2'),
                    ('الفيوم', 'Fayoum', '2'),
                    ('الغربية', 'Gharbiya', '2'),
                    ('الإسماعلية', 'Ismailia', '2'),
                    ( 'المنوفية', 'Menofia', '2'),
                    ( 'المنيا', 'Minya', '2'),
                    ( 'القليوبية', 'Qaliubiya', '2'),
                    ( 'الوادي الجديد', 'New Valley', '2'),
                    ( 'السويس', 'Suez', '2'),
                    ( 'اسوان', 'Aswan', '2'),
                    ( 'اسيوط', 'Assiut', '2'),
                    ( 'بني سويف', 'Beni Suef', '2'),
                    ( 'بورسعيد', 'Port Said', '2'),
                    ( 'دمياط', 'Damietta', '2'),
                    ( 'الشرقية', 'Sharkia', '2'),
                    ( 'جنوب سيناء', 'South Sinai', '2'),
                    ( 'كفر الشيخ', 'Kafr Al sheikh', '2'),
                    ( 'مطروح', 'Matrouh', '2'),
                    ( 'الأقصر', 'Luxor', '2'),
                    ( 'قنا', 'Qena', '2'),
                    ( 'شمال سيناء', 'North Sinai', '2'),
                    ( 'سوهاج', 'Sohag', '2');
        ");


    }
}
