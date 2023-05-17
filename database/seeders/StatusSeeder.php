<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class StatusSeeder extends Seeder
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
        DB::table('status')->truncate();
        //
        $sts = [
            ['Chờ xác nhận'],
            ['Đang giao'],
            ['Đã giao'],
            ['Đã hủy'],
        ];

        foreach ($sts as $st) {
            DB::table('status')->insert([
                'description' => $st[0],
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}