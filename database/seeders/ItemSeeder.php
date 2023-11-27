<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'id' => 1,
                'title' => 'Kuy Teav',
                'price' => '3',
                'menu_id' => '1',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050840kuy teav.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'title' => 'Num Banh Chok',
                'price' => '4',
                'menu_id' => '1',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050839nom banh jok.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'title' => 'Chicken Porridge',
                'price' => '4',
                'menu_id' => '1',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050840bobor.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'title' => 'Beef Lok Lak',
                'price' => '5',
                'menu_id' => '3',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050842beef lok lak.jpeg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'title' => 'Banana Ktis',
                'price' => '2',
                'menu_id' => '5',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050842jek ktis.png',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'title' => 'Steamed Toddy Palm Cake',
                'price' => '4',
                'menu_id' => '5',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050844នំអាកោត្នោត.jpeg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'title' => 'Stir fried beef noodle',
                'price' => '3',
                'menu_id' => '3',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050844mi chha.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'title' => 'Fish Amok',
                'price' => '8',
                'menu_id' => '2',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050845Fish Amok.jpeg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'title' => 'Fried Rice',
                'price' => '4',
                'menu_id' => '2',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050846bay chha.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'title' => 'Chicken Rice',
                'price' => '4',
                'menu_id' => '2',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050846bay mon.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 11,
                'title' => 'Iced Coffee',
                'price' => '2.5',
                'menu_id' => '4',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050848iced-coffee.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 12,
                'title' => 'FRESH ORANGE JUICE',
                'price' => '3',
                'menu_id' => '4',
                'description' => 'Chicken Porridge made with fresh organic chicken, sliced into small pieces, and served on the warm light broth and an egg yolk on top.',
                'image' => '202318050848orange juice.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 13,
                'title' => 'Prahok Ktis',
                'price' => '6',
                'menu_id' => '2',
                'description' => 'Made with Cambodian fermented fish, kroeung, minced pork, pea eggplant, chilli and coconut milk this signature Malis dish is served with fresh crispy vegetables & rice crackers.',
                'image' => '202322061330Prohok-Ktis.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 14,
                'title' => 'Fish Amok',
                'price' => '7',
                'menu_id' => '2',
                'description' => 'This traditional dish is made with goby fish fillets marinated in a lemongrass curry paste and steamed in a banana leaf basket, served with fragrant jasmine rice.',
                'image' => '202322061331Fish-Amok.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 15,
                'title' => 'Bang Kang',
                'price' => '11',
                'menu_id' => '3',
                'description' => 'Bang Kang river lobster marinated in a prahok and chilli paste, wrapped in foil for an intense flavour and grilled until golden, served on a bed of jasmine rice',
                'image' => '202322061333Bang-Kang-Malis.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 16,
                'title' => 'Baked Goby Fish',
                'price' => '6',
                'menu_id' => '2',
                'description' => 'Goby river fish marinated with lemongrass and garlic, baked in a crust of salt and complemented with a green mango chilli dip. Our best-selling dish.',
                'image' => '202322061334Baked-Goby-Fish-with-Young-Mango-Dip.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 17,
                'title' => 'Kampot Crab Fried Rice',
                'price' => '9',
                'menu_id' => '3',
                'description' => 'Kaffir-flavored rice cooked in fresh crab juice, wok fried to bring out its colour, with Kampot crab meat.',
                'image' => '202322061335Kampot-Crab-Fried-Rice.jpg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 18,
                'title' => 'Roasted Beef With Prahok Sauce',
                'price' => '12',
                'menu_id' => '3',
                'description' => 'Premium beef marinated with Kroeung and Malis seasoning oil then roasted, served with roasted eggplants and sweet potatoes',
                'image' => '202322061339Roasted-BeefRib-Eye-Steak-With-Prahok-Sauce.jpeg',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 19,
                'title' => 'Chicken Curry Steamed in Lotus Leaf',
                'price' => '10',
                'menu_id' => '3',
                'description' => 'Chicken or beef red curry rice wrapped in a lotus leaf which is then steamed to bring out bursts of flavour.',
                'image' => '202322061341Chicken-or-Beef-Curry-Steamed-in-Lotus-Leaf.jpeg',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
