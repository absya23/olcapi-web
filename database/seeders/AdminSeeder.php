<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
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
        DB::table('admin')->truncate();
        //
        $admins = [
            ['admin', 'admin'],
            ['admin123', 'admin123']
        ];

        foreach ($admins as $admin) {
            DB::table('admin')->insert([
                'admin_name' => $admin[0],
                'password' => Hash::make($admin[1]),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}