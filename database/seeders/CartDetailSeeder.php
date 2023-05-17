<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CartDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        Schema::disableForeignKeyConstraints();
        DB::table('cartdetail')->truncate();
        //
        $carts = [
            [1,1,2],
            [1,2,2],
            [1,3,1],    
            [2,10,3],
            [3,11,4],            
        ];

        foreach ($carts as $cart) {
            DB::table('cartdetail')->insert([
                'id_user' => $cart[0],
                'id_prod' => $cart[1],
                'quantity' => $cart[2],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}