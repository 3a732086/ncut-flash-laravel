<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date=date('Y-m-d H:i:s');
        User::insert([
            'name' => '俊0',
            'class' => '四資四乙',
            'email' => 'lai@gmail.com',
            'role' => 2,
            'password' => Hash::make('12345678'),
            'created_at'=>$date,
            'updated_at'=>$date,
        ]);
        $date=date('Y-m-d H:i:s');
        User::insert([
            'name' => '測試1',
            'class' => '四資四乙',
            'email' => 'test@gmail.com',
            'role' => 1,
            'password' => Hash::make('12345678'),
            'created_at'=>$date,
            'updated_at'=>$date,
        ]);
    }
}
