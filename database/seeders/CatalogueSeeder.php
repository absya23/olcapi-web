<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CatalogueSeeder extends Seeder
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
        DB::table('catalogue')->truncate();
        //
        $catalogs = [
            ['Balo & Túi ví'],
            ['Đồ chơi'],
            ['Văn phòng phẩm'],
            ['Phụ kiện Thời trang'],
            ['Đồ gia dụng']
        ];

        foreach ($catalogs as $catalog) {
            DB::table('catalogue')->insert([
                'name' => $catalog[0],
                'del_flag' => false,
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}