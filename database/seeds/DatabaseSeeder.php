<?php
use \App\School;
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
        Model::unguard();

        $school=new \App\School();
        $school->name="Royal College";
        $school->city="Colombo 07";
        $school->district="Colombo";
        $school->in_quota=200;
        $school->comes_in=true;
        $school->goes_out=false;
        $school->cutoff_mark=175;
        $school->save();

        $school=new \App\School();
        $school->name="Ananda College";
        $school->city="Colombo 10";
        $school->district="Colombo";
        $school->in_quota=150;
        $school->comes_in=true;
        $school->goes_out=false;
        $school->cutoff_mark=170;
        $school->save();

        $school=new \App\School();
        $school->name="Maliyadeva College";
        $school->city="Kurunegala";
        $school->district="Kurunegala";
        $school->in_quota=100;
        $school->comes_in=true;
        $school->goes_out=true;
        $school->cutoff_mark=168;
        $school->save();

        $school=new \App\School();
        $school->name="Dharmaraja College";
        $school->city="Kandy";
        $school->district="Kandy";
        $school->in_quota=150;
        $school->comes_in=true;
        $school->goes_out=false;
        $school->cutoff_mark=172;
        $school->save();

        $school=new \App\School();
        $school->name="Nalanda College";
        $school->city="Colombo 10";
        $school->district="Colombo";
        $school->in_quota=100;
        $school->comes_in=true;
        $school->goes_out=false;
        $school->cutoff_mark=168;
        $school->save();

        $school=new \App\School();
        $school->name="Mahanama College";
        $school->city="Colombo 03";
        $school->district="Colombo";
        $school->in_quota=50;
        $school->comes_in=true;
        $school->goes_out=true;
        $school->cutoff_mark=160;
        $school->save();

        $school=new \App\School();
        $school->name="Bandaranayake College";
        $school->city="Gampaha";
        $school->district="Gampaha";
        $school->in_quota=50;
        $school->comes_in=true;
        $school->goes_out=true;
        $school->cutoff_mark=160;
        $school->save();


        $school=new \App\School();
        $school->name="Horagasmulla Primary School";
        $school->city="Divulapitiya";
        $school->district="Gampaha";
        $school->in_quota=0;
        $school->comes_in=false;
        $school->goes_out=true;
        $school->cutoff_mark=0;
        $school->save();

        $school=new \App\School();
        $school->name="Balagalla Primary School";
        $school->city="Divulapitiya";
        $school->district="Gampaha";
        $school->in_quota=0;
        $school->comes_in=false;
        $school->goes_out=true;
        $school->cutoff_mark=0;
        $school->save();

        $school=new \App\School();
        $school->name="Hunumulla Central College";
        $school->city="Hunumulla";
        $school->district="Gampaha";
        $school->in_quota=20;
        $school->comes_in=true;
        $school->goes_out=true;
        $school->cutoff_mark=136;
        $school->save();





        $names=array('Nipun Perera','Imesha Sudasingha', 'Madhawa Vidanapathirana','Jayan Chathuranga','Pasindu Kanchana','Dulaj Atapattu');
        for($i=0;$i<20;$i++){
            $student=new \App\Student();
            $student->name=$names[rand(0,count($names)-1)];
            $student->examination_no=rand(1000000,9999999);
            $student->results=rand(100,200);
            $student->password=\Illuminate\Support\Facades\Hash::make("1234");
            $student->school_id=rand(1,10);
            $student->save();

            $studentexam=new \App\ExamResultsRest();
            $studentexam->name=$student->name;
            $studentexam->examination_number=$student->examination_no;
            $studentexam->dob = "1993-05-01";
            $studentexam->district = "Colombo";
            $studentexam->marks = rand(50,200);
            $studentexam->school = School::find($student->school_id)->name;
            $studentexam->save();

        }










        Model::reguard();
    }

}
