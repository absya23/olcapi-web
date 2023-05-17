<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FavoDetailSeeder extends Seeder
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
        DB::table('favodetail')->truncate();
        //
        $favos = [
            [1,1],
            [1,2],
            [1,3],    
            [2,10],
            [2,5],
            [3,11],            
        ];

        foreach ($favos as $favo) {
            DB::table('favodetail')->insert([
                'id_user' => $favo[0],
                'id_prod' => $favo[1],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}