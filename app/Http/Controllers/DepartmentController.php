<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    protected $departments;
    public function __construct(Department $department)
    {
        $this->departments=$department;
    }
    public function getDepartment()
    {
        $this->departments=$this->departments->get();
        return view('backend.pages.department')->with('data',$this->departments)->with('_title','Department Listing');;
    }
    public function showDepartmentForm(Request $request)
    {
        
        // dd($request->id);
        $this->departments=$this->departments->find($request->id);
        if($this->departments)
        {
            $act="Update";
        }
        else
        {
            $act="Add";
        }
        return view('backend.pages.department-add')->with('_title', $act.' Department')->with('detail',$this->departments);
    }
    public function postDepartment(Request $request)
    {
        $act="add";
        // dd($request);
        $rules=$this->departments->getAddRules();
        // dd($rules);
        $request->validate($rules);
        if(isset($request->id))
       {
           $this->departments=$this->departments->find($request->id);
           $act='update';
       }
        $data=$request->except('_token');
        $this->departments->fill($data);
        $succ=$this->departments->save();
       if($succ)
       {
           $request->session()->flash('success','Departments'.$act.'ed successfully');
       }
       else{
           $request->session()->flash('error','Sorry!Departments cant be'.$act.'ed at this moment');
       }
       return redirect()->route('department-list');
   }
   public function deleteDepartment(Request $request)
   {
    //    dd($request->id);
    $this->departments=$this->departments->find($request->id);
    if(!$this->departments)
       {
           $request->session()->flash('error','Department doesnt exists');
           return redirect()->route('department-list');
       }
       $success=$this->departments->delete();
       if($success)
       {
           $request->session()->flash('success','Department deleted successfully.');
       }
       else
       {
           $request->session()->flash('error','Sorry! Department couldnt be deleted at this moment');
       }
       return redirect()->route('department-list');
   }
}

