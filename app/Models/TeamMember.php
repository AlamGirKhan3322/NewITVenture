<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable=['name','teamrole_id'];

    public function getAllRules(){
    	return [
    		'name'=>'required|string',
    		'teamrole_id'=>'required|integer|exists:team_roles,id'
    	];
    }
    public function role(){
    	return $this->hasOne('App\Models\TeamRole','id','teamrole_id');
    }

    public function getAllTeamMember(){
    	return $this->with('role')->get();
    }
}
