<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamRole;
use App\Models\TeamMember;

class TeamController extends Controller
{
    protected $team_role=null;
    protected $team=null;
    

    public function __construct(TeamRole $team_role,TeamMember $team)
    {
        $this->team_role=$team_role;
        $this->team=$team;
    }
    public function getTeam()
    {
        $team=$this->team->getAllTeamMember();
        //dd($team);
        return view('backend.team.teamlist')->with('_title','Team Listing')->with('data',$team);
    }

   

    public function showTeamForm(Request $request)
    {

        $this->team=$this->team->find($request->id);
        if($this->team)
        {
            $act="Updat";
        }
        else{
            $act="Add";
        }
        $role = $this->team_role->get();

        return view('backend.team.teamadd')->with('_title', $act.'Team Member')->with('detail',$this->team)->with('role',$role);
    }
    


    public function postTeam(Request $request)
    {
    	//dd($request);
        $rules=$this->team->getAllRules();
        $request->validate($rules);
        $act="Add";
        if($request->id)
        {
            $this->team=$this->team->find($request->id);
            $act="Updat";

        }
        $data=$request->except('_token');
        $this->team->fill($data);
        $succ=$this->team->save();
        if($succ)
        {
            $request->session()->flash('success','Team'.$act.'ed successfully');
        }
        else{
            $request->session()->flash('error','Team Couldnt be'.$act.'ed at this moment');
        }
        return redirect()->route('team-list');
    }
    public function deleteTeam(Request $request)
    {
        $this->team=$this->team->find($request->id);
        if(!$this->team)
        {
            $request->session()->flash('error','Team doesnt exists');
            return redirect()->route('team-list');
        }
        
        $success=$this->team->delete();
        if($success)
        {
            $request->session()->flash('success','Team deleted successfully.');
        }
        else
        {
            $request->session()->flash('error','Sorry! Team couldnt be deleted at this moment');
        }
        return redirect()->route('team-list');
    }
     public function getTeamRole()
    {
        //$team=$this->team->get();
        $team =$this->team_role->get();
        return view('backend.team_role.teamrole-list')->with('_title','Team Role Listing')->with('data',$team);
    }
    public function showTeamRoleForm(Request $request)
    {

        $this->team_role=$this->team_role->find($request->id);
        if($this->team_role)
        {
            $act="Updat";
        }
        else{
            $act="Add";
        }

        return view('backend.team_role.teamrole-add')->with('_title', $act.'Team Role')->with('detail',$this->team_role);
    }

    /*public function showTeamRoleForm(Request $request)
    {
       
        $this->team=$this->team->find($request->id);
        if($this->team)
        {
            $act="Updat";
        }
        else{
            $act="Add";
        }

        return view('backend.team.team-add')->with('_title', $act.'Team')->with('detail',$this->team);
    }*/
    public function postTeamRole(Request $request)
    {
    	//dd($request);
        $rules=$this->team_role->getAllRules();
        $request->validate($rules);
        $act="Add";
        if($request->id)
        {
            $this->team_role=$this->team_role->find($request->id);
            $act="Updat";

        }

        $data=$request->except('_token');
        $data['slug'] = str_slug($request->role_name)."-".date('Ymdhis').rand(0,99);
        $this->team_role->fill($data);
        $succ=$this->team_role->save();
        if($succ)
        {
            $request->session()->flash('success','team_role'.$act.'ed successfully');
        }
        else{
            $request->session()->flash('error','team_role Couldnt be'.$act.'ed at this moment');
        }
        return redirect()->route('teamrole-list');
    }

    public function getMemberByRoleId(Request $request){
    	//dd($request->id);
    	$team_members = $this->team->where('teamrole_id','=',$request->id)->get();

    	if(!$team_members){
    		$status = false;
    	}
    	else{
    		$status = true;
    	}
    	return response()->json(['status'=>$status,'data'=>$team_members]);
    }
}

