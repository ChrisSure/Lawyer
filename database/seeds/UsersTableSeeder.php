<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Common\Entity\User;
use App\Admin\Entity\Mail;
use App\Common\Entity\Articles;
use App\Common\Entity\Pages;
use App\Common\Entity\Reverse;
use App\Common\Entity\Sub;
use App\Cabinet\Entity\Profile;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 8)->create();
        DB::table('users')->insert([
            'id' => 10,
            'name' => 'Taras',
            'email' => 't@t.ua',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
            'token' => str_random(10),
            'verify_token' => Str::uuid(),
            'role' => User::ROLE_SUPER_ADMIN,
            'status' => User::STATUS_ACTIVE,
        ]);
        DB::table('users')->insert([
            'id' => 9,
            'name' => 'Roman',
            'email' => 'r@r.ua',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
            'token' => str_random(10),
            'verify_token' => Str::uuid(),
            'role' => User::ROLE_USER,
            'status' => User::STATUS_ACTIVE,
        ]);
        factory(Profile::class, 10)->create();
        factory(Articles::class, 10)->create();
        factory(Mail::class, 10)->create();
        factory(Pages::class, 10)->create();
        factory(Reverse::class, 10)->create();
        factory(Sub::class, 10)->create();
    }
}
