<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder {

    public function run() {
        $roles = ["super_admin", "chief_executive", "executive", "clerk", "student"];
        $faker = Faker\Factory::create();

        foreach ($roles as $role) {
            $r       = new \App\Role();
            $r->role = $role;
            $r->save();

            $user = new \App\User();
            $user->role()->associate($r);
            $user->username = "demo_" . $role;
            $user->email    = "demo_" . $role . "@doe.net";
            $user->mobile   = $faker->phoneNumber;
            $user->password = Hash::make("password");
            $user->save();
        }
    }
}
