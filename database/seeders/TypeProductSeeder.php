<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TypeProductSeeder extends Seeder
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
        DB::table('typeproduct')->truncate();
        //
        $typeprods = [
            [1,'Túi đeo'],
            [1,'Balo'],
            [1,'Ví'],
            [1,'Túi đa năng'],
            [2,'Đồ chơi'],
            [2,'Đồ thú cưng'],
            [3,'Dụng cụ học tập'],
            [3,'Đồ dùng văn phòng'],
            [3,'Móc khoá'],
            [3,'Lịch'],
            [4,'Quần áo'],
            [4,'Phụ kiện'],
            [5,'Dụng cụ nhà bếp'],
            [5,'Dụng cụ nhà tắm']
        ];

        foreach ($typeprods as $typeprod) {
            DB::table('typeproduct')->insert([
                'id_catalog' => $typeprod[0],
                'name' => $typeprod[1],
                'del_flag' => false,
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}