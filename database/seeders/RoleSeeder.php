<?php

namespace Database\Seeders;

use Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'created_at' => Carbon::now()->format('y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('y-m-d H:i:s')
        ]);

        DB::table('roles')->insert([
            'name' => 'Realtor',
            'created_at' => Carbon::now()->format('y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('y-m-d H:i:s')
        ]);

        DB::table('roles')->insert([
            'name' => 'Customer',
            'created_at' => Carbon::now()->format('y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('y-m-d H:i:s')
        ]);
    }
}
