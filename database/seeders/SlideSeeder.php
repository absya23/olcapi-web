<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SlideSeeder extends Seeder
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
        DB::table('slide')->truncate();
        //
        $slides = [
            ["https://bucket.nhanh.vn/cba2a3-7534/bn/20220426_i1xLL6tLxnnTR6iS7Lr5Bjv7.jpg"],
            ["https://bucket.nhanh.vn/cba2a3-7534/bn/20221201_Qtceycq3pHxbRwH6.png"],
            ["https://bucket.nhanh.vn/cba2a3-7534/bn/20221111_w4WCTs8TJw9PtZd28NXFOSzp.jpg"],
        ];

        foreach ($slides as $slide) {
            DB::table('slide')->insert([
                'image' => $slide[0],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}