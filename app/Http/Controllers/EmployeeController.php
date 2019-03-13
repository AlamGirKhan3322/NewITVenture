<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use File;

class EmployeeController extends Controller
{
    protected $employees;
    protected $departments;
    public function __construct(Employee $employee, Department $department)
    {
        $this->employees=$employee;
        $this->departments=$department;
    }
    public function getEmployee()
    {
        $this->employees=$this->employees->get();
        return view('backend.pages.employee')->with('data',$this->employees)->with('_title','Employee Listing');
    }
    public function showEmployeeForm(Request $request)
    {
        
        $this->departments=$this->departments->get();
        $this->employees=$this->employees->find($request->id);
        if($this->employees)
        {
            $act="Update";
        }
        else
        {
            $act="Add";
        }
        return view('backend.pages.employee-add')->with('_title', $act.' Employee')->with('detail',$this->employees)->with('depart',$this->departments);
    }
    public function postEmployee(Request $request)
    {
        $act="add";
        // dd($request);
        $rules=$this->employees->getRules();
        // dd($rules);
        $request->validate($rules);
        if(isset($request->id))
       {
           $this->employees=$this->employees->find($request->id);
           $act='update';
       }
        $data=$request->except('_token');
        if($request->profile_image)
       {
           $path=public_path()."/uploads/employee";
           if(!File::exists($path))
           {
               File::makeDirectory($path,0777,true,true);
           }
           $file_name="Employee-".date('Ymdhis').rand(0,999).".".$request->profile_image->getClientOriginalExtension();
           $success=$request->profile_image->move($path,$file_name);
           if($success)
           {
                if (isset($this->employees->profile_image) && !empty($this->employees->profile_image) && file_exists(public_path() . '/uploads/employee/' . $this->employees->profile_image)) 
                {
                    unlink(public_path() . '/uploads/employee/' . $this->employees->profile_image);
                }
               $data['profile_image']=$file_name;
           }
       }
        $this->employees->fill($data);
        $succ=$this->employees->save();
       if($succ)
       {
           $request->session()->flash('success','Employees'.$act.'ed successfully');
       }
       else{
           $request->session()->flash('error','Sorry!Employees cant be'.$act.'ed at this moment');
       }
       return redirect()->route('employee-list');
   }
   public function deleteEmployee(Request $request)
   {
    //    dd($request->id);
    $this->employees=$this->employees->find($request->id);
    if(!$this->employees)
       {
           $request->session()->flash('error','Employee doesnt exists');
           return redirect()->route('employee-list');
       }
       $success=$this->employees->delete();
       if($success)
       {
           $request->session()->flash('success','Employee deleted successfully.');
       }
       else
       {
           $request->session()->flash('error','Sorry! Employee couldnt be deleted at this moment');
       }
       return redirect()->route('employee-list');
   }
}


