<?php

use Illuminate\Database\Seeder;
use \App\Role;
use App\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();

        $support = new Role();
        $support->name = 'support';
        $support->save();

        $chauffør = new Role();
        $chauffør->name = 'chauffør';
        $chauffør->save();

        $user = new Role();
        $user->name = 'user';
        $user->save();

        \App\User::where('email', 'admin@teccargo.dk')->first()->roles()->attach($admin->id);
        \App\User::where('email', 'godofdenmark@gmail.com')->first()->roles()->attach($support->id);

        $editOrders = new Permission();
        $editOrders->name = 'edit-orders';
        $editOrders->display_name = 'Rette Ordre';
        $editOrders->description = 'Kan rette ordre fra brugere';
        $editOrders->save();

        $update = new Permission();
        $update->name = 'update-orders';
        $update->display_name = 'Opdatere Ordre';
        $update->description = 'Kan opdatere ordre';
        $update->save();

        $tracking = new Permission();
        $tracking->name = 'update-tracking';
        $tracking->display_name = 'Opdatere Tracking';
        $tracking->description = 'Kan opdatere tracking';
        $tracking->save();

        $admin->attachPermissions([$editOrders, $update, $tracking]);
        $support->attachPermissions([$editOrders, $tracking]);
        $chauffør->attachPermission($tracking);
    }
}
