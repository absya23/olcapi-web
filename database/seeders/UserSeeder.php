<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
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
        DB::table('user')->truncate();
        //
        $users = [
            ['user1', 'Bùi Hữu Khánh','user1', 'user1@gmail.com','TP.HCM','0123423167'],
            ['user2', 'Bùi Quốc Huy','user2', 'user2@gmail.com','TP.HCM','0123423167'],
            ['user3', 'Bùi Minh Thy','user3', 'user3@gmail.com','Khánh Hòa','0123423167'],
            ['user4', 'Bùi Văn Trọng','user4', 'user4@gmail.com','Lâm Đồng','0123423167'],
            ['user5', 'Bùi Duy Khoa','user5', 'user5@gmail.com','Hà Nội','0123423167']
        ];

        foreach ($users as $user) {
            DB::table('user')->insert([
                'username' => $user[0],
                'name' => $user[1],
                'password' => Hash::make($user[2]),
                'email' => $user[3],
                'address' => $user[4],
                'phone' => $user[5],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}