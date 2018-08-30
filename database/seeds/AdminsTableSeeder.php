<?php

use App\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('super@dmin'),
            'job_title' => 'Super Admin',
            'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
            'updated_at' =>  Carbon::now()->format('Y-m-d H:m:s')
        ];

        Admin::create($admin);
    }
}
