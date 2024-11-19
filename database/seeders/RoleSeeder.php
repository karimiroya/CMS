<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin'], // Role ID 1
            ['name' => 'Editor'], // Role ID 2
            ['name' => 'Writer'], // Role ID 3
        ]);
    }
}
