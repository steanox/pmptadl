<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
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
            'password' => bcrypt('secret'),
            'remember_token' => 'goynwu8EcYE8BexWMxmBjKN7hczveuFixMRUfx8875Vg41aQUHkplkbFljq2',
            'userType' => 'super'
        ]);

        DB::table('users')->insert([
            'name' => 'oktagandajaya',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('secret2'),
            'remember_token' => 'goynwu8EcYE8BexWMxmBjKN7hczveuFixMRUfx8875Vg41aQUHkplkbFljq2',
            'userType' => 'super'
        ]);

        $organizations = array(
            array('name'=>'PT 1'),
            array('name'=>'PT 2'),
            array('name'=>'PT 3'),
            array('name'=>'PT 4'),
            array('name'=>'PT 5'),
            array('name'=>'PT 6')
        );

        DB::table('organizations')->insert($organizations);




        $categories = array(
            array('name'=>'Residential', 'icon'=> 'fa fa-home'),
            array('name'=>'Office', 'icon'=> 'fa fa-briefcase'),
        );
        DB::table('categories')->insert($categories);

        $discipline = array(
            array('')
        );


        factory(Pmptadl\User::class, 200)->create();
        // ->each(function ($u) {
        //     $u->posts()->save(factory(App\Post::class)->make());
        // });

    }
}
