<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        Storage::disk('public')->deleteDirectory('posts');
        User::truncate();
        
        $user = new User;
        $user->name = 'German';
        $user->email = 'german@correo.com';
        $user->password = bcrypt('123456*');
        $user->save();
        
        // \App\Models\User::factory(10)->create();
        $this->call(PostsTableSeeder::class);
    }
}
