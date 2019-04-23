<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    //
    protected $fillable = ['title','msgbody','role_id','member_id'];

    public function getAllRules()
    {
    	return[
    		'title'=>'required|string',
    		'msgbody'=>'required|string',
    		'role_id'=>'required|integer|exists:team_roles,id',
			'member_id.*'=>'required|integer|exists:team_members,id'
    	];
    }


}