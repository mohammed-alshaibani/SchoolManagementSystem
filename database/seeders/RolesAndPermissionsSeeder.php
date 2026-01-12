<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Pages
            'pages.view','pages.create','pages.update','pages.delete',
            // News
            'news.view','news.create','news.update','news.delete','news.publish',
            // Events
            'events.view','events.create','events.update','events.delete','events.publish',
            // Gallery
            'albums.view','albums.create','albums.update','albums.delete','photos.manage',
            // Staff
            'staff.view','staff.create','staff.update','staff.delete',
            // Contact
            'contact.view','contact.reply','contact.archive',
            ];
            foreach ($permissions as $p) { Permission::firstOrCreate(['name'=>$p]); }


            $admin = Role::firstOrCreate(['name' => 'Admin']);
            $editor = Role::firstOrCreate(['name' => 'Editor']);
            $viewer = Role::firstOrCreate(['name' => 'Viewer']);


            $admin->givePermissionTo(Permission::all());
            $editor->givePermissionTo([
            'pages.view','pages.create','pages.update',
            'news.view','news.create','news.update','news.publish',
            'events.view','events.create','events.update','events.publish',
            'albums.view','albums.create','albums.update','photos.manage',
            'staff.view','staff.create','staff.update',
            'contact.view','contact.reply',
            ]);
            $viewer->givePermissionTo(['pages.view','news.view','events.view','albums.view','staff.view','contact.view']);


            $user = User::firstOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
            ]);
            $user->assignRole('Admin');
    }
}
