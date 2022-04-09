<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));

        return [
            'name' => $faker->productName,
            'short_description' => substr($this->faker->paragraph(), 0, 191),
            'long_description' => $this->faker->paragraph(4),
            'product_details' => $this->faker->paragraph(5),
            'image_path' => config('filesystems.defaultImagePath'),
            'cost' => $this->faker->randomNumber(3),
            'shippable' => mt_rand(0, 1),
            'free_delivery' => mt_rand(0, 1),
        ];
    }
}
