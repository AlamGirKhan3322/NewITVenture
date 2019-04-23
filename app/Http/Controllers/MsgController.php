<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Msg;
use App\Models\TeamMember;
use App\Models\TeamRole;


class MsgController extends Controller
{
	protected $msg = null;
	protected $team = null;
	protected $team_role = null;
    public function __construct(Msg $msg,TeamMember $team,TeamRole $team_role)
    {
        
        $this->msg=$msg;
        $this->team = $team;
        $this->team_role = $team_role;
    }
    public function getmsg()
    {
        $msg=$this->msg->get();
        //dd($msg);
        return view('backend.message.msglist')->with('_title','Message Listing')->with('data',$msg);
    }

   

    public function showmsgForm(Request $request)
    {

        $this->msg = null;
        if($request->id)
        {
        	$this->msg=$this->msg->findOrFail($request->id);
            $act="Updat";
        }
        else{
            $act="Add";
        }
    
        $role = $this->team_role->get();
       
        return view('backend.message.msgadd')->with('_title', $act.'Send Message')->with('detail',$this->msg)->with('role',$role);
    }
    


    public function postmsg(Request $request)
    {
    	// dd($request);
        $rules=$this->msg->getAllRules();

        $request->validate($rules);
        $act="Add";
        if($request->id)
        {
            $this->msg=$this->msg->find($request->id);
            $act="Updat";

        }
        $data=$request->except('_token');
        // dd($data);
        $this->msg->fill($data);
        $succ=$this->msg->save();
        if($succ)
        {
            $request->session()->flash('success','msg'.$act.'ed successfully');
        }
        else{
            $request->session()->flash('error','msg Couldnt be'.$act.'ed at this moment');
        }
        return redirect()->route('msg-list');
    }
    public function deletemsg(Request $request)
    {
        $this->msg=$this->msg->find($request->id);
        if(!$this->msg)
        {
            $request->session()->flash('error','msg doesnt exists');
            return redirect()->route('msg-list');
        }
        
        $success=$this->msg->delete();
        if($success)
        {
            $request->session()->flash('success','msg deleted successfully.');
        }
        else
        {
            $request->session()->flash('error','Sorry! msg couldnt be deleted at this moment');
        }
        return redirect()->route('msg-list');
    }
}
