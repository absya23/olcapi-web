<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminSeeder::class);
        $this->call(CatalogueSeeder::class);
        $this->call(TypeProductSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ImagesSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
        $this->call(SlideSeeder::class);
        $this->call(CartDetailSeeder::class);
        $this->call(FavoDetailSeeder::class);

    }
}