<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamRole extends Model
{
    protected $fillable = ['role_name','slug'];

    public function getAllRules(){
    	return [
    		'role_name'=>'required|string'
    	];
    }
}
