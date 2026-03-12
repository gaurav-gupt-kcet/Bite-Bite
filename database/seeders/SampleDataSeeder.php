<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@shuddhswad.com',
            'password' => Hash::make('admin123'),
            'is_admin' => '1'
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Kaju Katli'],
            ['name' => 'Gulab Jamun'],
            ['name' => 'Rasgulla'],
            ['name' => 'Ladoo'],
            ['name' => 'Barfi'],
            ['name' => 'Halwa'],
            ['name' => 'Pak'],
            ['name' => 'Special Combos']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Products with prices around ₹599
        $products = [
            [
                'name' => 'Premium Kaju Katli',
                'description' => 'Finest quality cashew nuts blended with pure ghee and sugar. A royal treat for festive celebrations.',
                'price' => 599,
                'category_id' => 1,
                'image' => 'products/ngC4HVEGpSoQinsty82tdPXy2fFFEhqV2BYMRHKY.jpg'
            ],
            [
                'name' => 'Gulab Jamun (1 Kg)',
                'description' => 'Soft and juicy gulab jamuns made with khoya and fried in pure ghee. Perfect for celebrations.',
                'price' => 449,
                'category_id' => 2,
                'image' => 'products/VM43PQ0jAzZGUqYNwjKmmuECp7ZVjBxgzs6UPv4z.jpg'
            ],
            [
                'name' => 'Bengali Rasgulla (1 Kg)',
                'description' => 'Authentic Bengali rasgulla - spongy cottage cheese balls soaked in light sugar syrup.',
                'price' => 399,
                'category_id' => 3,
                'image' => 'products/Vv6xqbVsVZNHjpcGZoRaVWdLTAhZQm2cdeHbwMBJ.jpg'
            ],
            [
                'name' => 'Besan Ladoo',
                'description' => 'Traditional besan ladoo made with gram flour, ghee, and roasted nuts. Classic festival sweet.',
                'price' => 349,
                'category_id' => 4,
                'image' => 'products/SXEvGXs7Id96WdIEZyzkkyGFgs3gDNkztoMBTB1i.webp'
            ],
            [
                'name' => 'Badusha',
                'description' => 'Sweet flaky pastries soaked in sugar syrup. A favorite for all occasions.',
                'price' => 499,
                'category_id' => 5,
                'image' => 'products/mAkXdR4r0PgMeNzMlr8rZtuVrqHASaWRlvjpijH0.webp'
            ],
            [
                'name' => 'Carrot Halwa',
                'description' => 'Rich and delicious gajar halwa made with fresh carrots, milk, and ghee.',
                'price' => 599,
                'category_id' => 6,
                'image' => 'products/Hx9Mc3mSmGeKhd7LnlGdKWiJqPxOIFPIjGiWTcsL.webp'
            ],
            [
                'name' => 'Motipak / Patrika',
                'description' => 'Traditional festive sweet made with gram flour and sugar syrup.',
                'price' => 549,
                'category_id' => 7,
                'image' => 'products/aRuuG8v0WDycKef42WCmQBiputd2roinWIyirQht.webp'
            ],
            [
                'name' => 'Festival Special Combo',
                'description' => 'Assorted box containing Kaju Katli, Gulab Jamun, Rasgulla, and Ladoo. Perfect gifting option.',
                'price' => 999,
                'category_id' => 8,
                'image' => 'products/VrcXF7ZA4bWV3GiJV0qiIOo8uJeEH7SKXWVmARKW.png'
            ],
            [
                'name' => 'Milk Cake',
                'description' => 'Rich and creamy milk cake baked to perfection. A delight for sweet lovers.',
                'price' => 599,
                'category_id' => 5,
                'image' => 'products/DavCjkVK0nficbOh9jTyQV7c3fKhKQsUcTNuWrm0.png'
            ],
            [
                'name' => 'Pista Kaju Roll',
                'description' => 'Premium cashew and pistachio roll with silver leaf. Luxury sweet for special occasions.',
                'price' => 799,
                'category_id' => 1,
                'image' => 'products/W8WxoSOZepchZF0gdaof9z7wf9fsgcn8gKwnSpGa.png'
            ],
            [
                'name' => 'Rasmalai (1 Kg)',
                'description' => 'Soft cottage cheese patties soaked in creamy milk sauce with nuts.',
                'price' => 649,
                'category_id' => 3,
                'image' => 'products/ngC4HVEGpSoQinsty82tdPXy2fFFEhqV2BYMRHKY.jpg'
            ],
            [
                'name' => 'Dry Fruit Ladoo',
                'description' => 'Energy-packed ladoos made with almonds, cashews, pistachios, and Dates.',
                'price' => 699,
                'category_id' => 4,
                'image' => 'products/SXEvGXs7Id96WdIEZyzkkyGFgs3gDNkztoMBTB1i.webp'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create Sliders
        $sliders = [
            [
                'title' => 'Republic Day Special',
                'subtitle' => 'Get 25% OFF on Premium Mithai',
                'image' => 'slider/slide1.jpg',
                'product_id' => 1,
                'order' => 1,
                'status' => true
            ],
            [
                'title' => 'Fresh Kaju Katli',
                'subtitle' => 'Pure Desi Taste - Starting from ₹599',
                'image' => 'slider/slide2.jpg',
                'product_id' => 1,
                'order' => 2,
                'status' => true
            ],
            [
                'title' => 'Festival Sweet Combo',
                'subtitle' => 'Special Discount Available',
                'image' => 'slider/slide3.jpg',
                'product_id' => 8,
                'order' => 3,
                'status' => true
            ],
            [
                'title' => 'Traditional Indian Sweets',
                'subtitle' => 'Freshly Made Everyday',
                'image' => 'slider/slide4.jpg',
                'product_id' => null,
                'order' => 4,
                'status' => true
            ]
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
