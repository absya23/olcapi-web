<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('orderdetail')->truncate();
        //
        $orderdetails = [
            [1,1,5],
            [1,2,1],
            [1,3,1],
            [2,1,1],
            [2,19,1],
            [2,12,3],
            [2,10,5],
            [2,11,4],
            [3,1,3],
            [4,2,1],
            [5,3,1],
            [6,3,2],
            [7,4,1],
            [8,4,3],
            [8,2,3],
            [9,11,4],
            [9,3,4],
            [10,3,1],
            [11,10,1],
            [12,14,1],
            [12,12,1],
            [12,9,1],
            [13,5,1],
            [13,6,1],
            [13,11,1],
            [14,8,1],
            [14,7,1],
            [15,8,1],
            [15,9,1],
            [16,7,1]
        ];

        foreach ($orderdetails as $orderdetail) {
            DB::table('orderdetail')->insert([
                'id_order' => $orderdetail[0],
                'id_prod' => $orderdetail[1],
                'quantity' => $orderdetail[2],
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}