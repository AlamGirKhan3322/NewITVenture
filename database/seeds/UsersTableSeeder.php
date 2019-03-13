<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=array(
            array(
                'name'=>'Ecom Admin',
                'address'=>'Kathmandu',
                'email'=>'admin@newproject.com',
                'role'=>'admin',
                'password'=>Hash::make('@dm!n123#')
            ),
            array(
                'name'=>'Ecom worker',
                'address'=>'Pokhara',
                'email'=>'worker@newproject.com',
                'role'=>'worker',
                'password'=>Hash::make('w0rker123#')
            ),
           
        );

        foreach ($array as $key=>$value)
        {
            $user=User::where('email',$value['email'])->first();
            if(!$user)
            {
                $user=new User();
            }
            $user->fill($value);
            $user->save();
        }
    }
}

