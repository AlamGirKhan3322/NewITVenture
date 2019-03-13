@extends('layouts.admin-dashboard')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>{{$_title}}</h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
            <a href="{{route('employee-add')}}" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i>Add Employee</a>
            </div>
            
        </div>
        
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Employee List</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <table class="table table-bordered jambo_table">
               <thead>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Gender</th>
                    <th>Hire Date</th>
                    <th>Profile Image</th>
                    <th>Action</th>
               </thead>
               <tbody>
                   
                        @if($data)
                            @foreach($data as $keys=>$values)
                                <tr>
                                    <td>{{$keys+1}}</td>
                                    <td>{{$values->name}}</td>
                                    <td>{{$values->email}}</td>
                                    <td>{{$values->department_id}}</td>
                                    <td>{{$values->gender}}</td>
                                    <td>{{$values->hire_date}}</td>
                                    <td>{{$values->profile_image}}</td>

                                    <td>
                                    <a href="{{route('employee-edit',$values->id)}}" class="btn btn-primary" style="border-radius:50%">
                                    <i class="fa fa-pencil"></i>
                                    </a>
                                    /
                                    <a href="{{route('employee-delete',$values->id)}} " class="btn btn-danger" style="border-radius:50%" onclick=return confirm('Are you sure you want to delete this employee?')>
                                    <i class="fa fa-trash"></i>
                                    </a></td>
                                </tr>
                            @endforeach
                        @endif

                        
                    
               </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
@endsection