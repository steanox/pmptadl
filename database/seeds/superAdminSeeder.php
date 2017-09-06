<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class superAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'yosmelvin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$Swvp54zmRFLEOGIEtJVJI.sxu1xhPfhoABNnHdfJ2Mu3vCJzHLmVO',
            'remember_token' => 'goynwu8EcYE8BexWMxmBjKN7hczveuFixMRUfx8875Vg41aQUHkplkbFljq2'
        ]);
    }
}
