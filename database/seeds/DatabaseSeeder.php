<?php

use App\Examination;
use App\Result;
use App\Role;
use App\User;
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
        $this->call(ExaminationsTableSeeder::class);
        $this->call(StudentExaminationSeeder::class);

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder {

    public function run() {
        $roles = ["super_admin", "chief_executive", "executive", "clerk", "student"];
        $faker = Faker\Factory::create();

        foreach ($roles as $role) {
            $r       = new Role();
            $r->role = $role;
            $r->save();

            $user = new User();
            $user->role()->associate($r);
            $user->username = "demo_" . $role;
            $user->email    = "demo_" . $role . "@doe.net";
            $user->mobile   = $faker->phoneNumber;
            $user->password = Hash::make("password");
            $user->save();
        }
    }
}


class ExaminationsTableSeeder extends Seeder {

    public function run() {
        $names = ["Advanced Level", "Ordinary Level", "Grade 5 Scholarship"];
        $year  = 2000;

        $user = Role::where("role", "chief_executive")->first()->users()->first();
        while ($year < 2018) {
            foreach ($names as $name) {
                $exam         = new Examination();
                $exam->name   = $name;
                $exam->year   = $year;
                $exam->status = ($year < 2017);
                $exam->creator()->associate($user);
                $exam->save();
            }
            $year++;
        }
    }
}

class StudentExaminationSeeder extends Seeder {

    public function run() {
        $user = Role::where("role", "student")->first()->users()->first();
        foreach (Examination::where("year", ">", "2012")
                     ->where("year", "<", "2016")->orderBy("year", "desc")->get() as $exam) {
            if (
                $user->examinations()->where("name", $exam->name)->first() == null &&
                $user->examinations()->where("year", $exam->year)->first() == null
            ) {
                $user->examinations()->attach($exam);
                $user->update();
            }
        }
    }
}


