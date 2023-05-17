<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class OrderSeeder extends Seeder
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
        DB::table('order')->truncate();
        //
        $orders = [
            [1,1],
            [1,2],
            [1,3],
            [2,1],
            [2,1],
            [2,3],
            [2,4],
            [2,4],
            [3,1],
            [3,2],
            [3,3],
            [3,3],
            [3,4],
            [3,4],
            [4,3],
            [5,3],
            
        ];

        foreach ($orders as $order) {
            DB::table('order')->insert([
                'id_user' => $order[0],
                'id_status' => $order[1],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}