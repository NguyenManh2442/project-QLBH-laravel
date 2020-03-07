<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data= [
            'username'=> 'hoaianh',
            'email'=>'hoaianh@gmail.com',
            'password'=>bcrypt('12345678'),
            'fullName'=>'nguyen hoai anh'
        ];
        DB::table('customers')->insert($data);
    }
}
