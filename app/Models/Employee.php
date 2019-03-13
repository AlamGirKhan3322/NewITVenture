<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=['name','gender','email','hire_date','profile_image','department_id'];
    public function getRules()
    {
        return[
            'name'=>'required|string',
            'gender'=>'required|string|in:male,female,others',
            'email'=>'required|email',
            'hire_date'=>'required|date',
            'profile_image'=>'sometimes|image|max:5000'
        ];
    }
}
