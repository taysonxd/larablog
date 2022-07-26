<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Storage::disk('public')->deleteDirectory('posts');

        Permission::truncate();
        Role::truncate();
        User::truncate();
        
        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $writerRole = Role::create(['name' => 'Writer', 'display_name' => 'Escritor']);

        $viewPostPermission = Permission::create(['name' => 'View posts', 'display_name' => 'Ver posts']);
        $createPostPermission = Permission::create(['name' => 'Create posts', 'display_name' => 'Crear posts']);
        $updatePostPermission = Permission::create(['name' => 'Update posts', 'display_name' => 'Actualizar posts']);
        $deletePostPermission = Permission::create(['name' => 'Delete posts', 'display_name' => 'Eliminar posts']);

        $viewUserPermission = Permission::create(['name' => 'View users', 'display_name' => 'Ver users']);
        $createUserPermission = Permission::create(['name' => 'Create users', 'display_name' => 'Crear users']);
        $updateUserPermission = Permission::create(['name' => 'Update users', 'display_name' => 'Actualizar users']);
        $deleteUserPermission = Permission::create(['name' => 'Delete users', 'display_name' => 'Eliminar users']);

        $updateRolesPermission = Permission::create(['name' => 'Update roles', 'display_name' => 'Actualizar roles']);

        $adminRole->givePermissionTo([$viewPostPermission, $createPostPermission, $updatePostPermission, $deletePostPermission]);
        $writerRole->givePermissionTo($viewPostPermission);

        $admin = new User;
        $admin->name = 'German';
        $admin->email = 'german@correo.com';
        $admin->password = '123456*';
        $admin->save();
        
        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = 'Adolfo';
        $writer->email = 'adolfo@correo.com';
        $writer->password = '123456*';
        $writer->save();

        $writer->assignRole($writerRole);

        // \App\Models\User::factory(10)->create();
        $this->call(PostsTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
