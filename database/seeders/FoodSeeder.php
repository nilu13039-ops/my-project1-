<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asosiy = Category::where('name', 'Asosiy taomlar')->first();
        $ichimliklar = Category::where('name', 'Ichimliklar')->first();
        $desertlar = Category::where('name', 'Desertlar')->first();
        $salatlar = Category::where('name', 'Salatlar')->first();
        $fastfood = Category::where('name', 'Fast Food')->first();
        $milliy = Category::where('name', 'Milliy taomlar')->first();
        $non = Category::where('name', 'Non va pishiriqlar')->first();

        $foods = [
            // Asosiy taomlar
            ['name' => 'Osh (Palov)', 'category_id' => $asosiy->id, 'price' => 35000, 'description' => 'Milliy o\'zbek oshi, go\'sht va sabzi bilan.', 'image' => 'images/palov.jpg'],
            ['name' => 'Shashlik', 'category_id' => $asosiy->id, 'price' => 20000, 'description' => 'Qo\'y go\'shtidan shashlik.', 'image' => 'images/shashlik.jpg'],
            ['name' => 'Somsa', 'category_id' => $asosiy->id, 'price' => 12000, 'description' => 'Tandir somsa.', 'image' => 'images/somsa.jpg'],
            ['name' => 'Beshbarmak', 'category_id' => $asosiy->id, 'price' => 45000, 'description' => 'Qo\'zi go\'shti bilan beshbarmak.', 'image' => 'images/beshbarmak.jpg'],
            ['name' => 'Steak', 'category_id' => $asosiy->id, 'price' => 55000, 'description' => 'Mozzarella pishloqli pizza.', 'image' => 'images/steak.jpg'],

            // Ichimliklar
            ['name' => 'Coca-Cola 1L', 'category_id' => $ichimliklar->id, 'price' => 15000, 'description' => 'Muzdek Coca-cola.', 'image' => 'images/coca-cola.jpg'],
            ['name' => 'Choy', 'category_id' => $ichimliklar->id, 'price' => 5000, 'description' => 'Qora va ko\'k choy.', 'image' => 'images/tea.jpg'],
            ['name' => 'Kompote', 'category_id' => $ichimliklar->id, 'price' => 8000, 'description' => 'Mevadan kompot.', 'image' => 'images/kompot.jpg'],
            ['name' => 'Fresh Orange', 'category_id' => $ichimliklar->id, 'price' => 18000, 'description' => 'Yangilikdan siqilgan apelsin fresh.', 'image' => 'images/fresh-orange.jpg'],
            ['name' => 'Mineral Suv', 'category_id' => $ichimliklar->id, 'price' => 3000, 'description' => 'Tabiiy mineral suv.', 'image' => 'images/food-placeholder.svg'],

            // Desertlar
            ['name' => 'Medovik', 'category_id' => $desertlar->id, 'price' => 25000, 'description' => 'Asalli tort.', 'image' => 'images/medovik.jpg'],
            ['name' => 'Napoleon', 'category_id' => $desertlar->id, 'price' => 22000, 'description' => 'Kremli napoleon torti.', 'image' => 'images/napoleon.jpg'],
            ['name' => 'Cheesecake', 'category_id' => $desertlar->id, 'price' => 28000, 'description' => 'Pishloqli cheesecake.', 'image' => 'images/cheesecake.jpg'],
            ['name' => 'Ice Cream', 'category_id' => $desertlar->id, 'price' => 12000, 'description' => 'Muzqaymoq assorti.', 'image' => 'images/food-placeholder.svg'],

            // Salatlar
            ['name' => 'Achichuk', 'category_id' => $salatlar->id, 'price' => 10000, 'description' => 'Pomidor va piyozli salat.', 'image' => 'images/achichuk.jpg'],
            ['name' => 'Grekcha salat', 'category_id' => $salatlar->id, 'price' => 30000, 'description' => 'Pishloq va zaytunli maxsus salat.', 'image' => 'images/greek-salad.jpg'],
            ['name' => 'Cezar salat', 'category_id' => $salatlar->id, 'price' => 25000, 'description' => 'Tovuq go\'shti bilan cezar salat.', 'image' => 'images/food-placeholder.svg'],
            ['name' => 'Vinegret', 'category_id' => $salatlar->id, 'price' => 15000, 'description' => 'Sabzavotli vinegret.', 'image' => 'images/food-placeholder.svg'],

            // Fast Food
            ['name' => 'Burger', 'category_id' => $fastfood->id, 'price' => 22000, 'description' => 'Go\'shtli burger non bilan.', 'image' => 'images/burger.jpg'],
            ['name' => 'Hot Dog', 'category_id' => $fastfood->id, 'price' => 15000, 'description' => 'Kolbasa bilan hot dog.', 'image' => 'images/hot-dog.jpg'],
            ['name' => 'Fries', 'category_id' => $fastfood->id, 'price' => 12000, 'description' => 'Kartoshka fri.', 'image' => 'images/food-placeholder.svg'],

            // Milliy taomlar
            ['name' => 'Dograma', 'category_id' => $milliy->id, 'price' => 18000, 'description' => 'Go\'sht va guruch bilan dograma.', 'image' => 'images/dograma.jpg'],
            ['name' => 'Lagman', 'category_id' => $milliy->id, 'price' => 25000, 'description' => 'Uyg\'ur lagmani.', 'image' => 'images/lagman.jpg'],
            ['name' => 'Manti', 'category_id' => $milliy->id, 'price' => 20000, 'description' => 'Go\'shtli manti.', 'image' => 'images/food-placeholder.svg'],

            // Non va pishiriqlar
            ['name' => 'Lepeshka', 'category_id' => $non->id, 'price' => 3000, 'description' => 'Tandirda pishirilgan lepyoshka.', 'image' => 'images/lepyoshka.jpg'],
            ['name' => 'Baton', 'category_id' => $non->id, 'price' => 5000, 'description' => 'Oq non baton.', 'image' => 'images/food-placeholder.svg'],
            ['name' => 'Croissant', 'category_id' => $non->id, 'price' => 8000, 'description' => 'Kremli croissant.', 'image' => 'images/food-placeholder.svg']
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
