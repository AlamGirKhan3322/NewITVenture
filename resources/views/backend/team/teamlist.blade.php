@extends('layouts.admin-dashboard')

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>{{ $_title }}</h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <a href="{{ route('team-add') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> Add Team Member
                </a>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Team Member List</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered jambo_table">
                   
               <thead>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
               </thead>
               <tbody>
                    @if($data)
                    <!-- {{$data}} -->
                        @foreach($data as $keys=>$team_data)
                            <tr>
                                <td>{{$keys+1}}</td>
                                <td>{{$team_data->name}}</td>
                                <td>{{$team_data->role->role_name}}</td>
                                <td>
                                <a href="{{route('edit-team',$team_data->id)}}" class="btn btn-success" style="border-radius:50%">
                                <i class="fa fa-pencil"></i>
                                </a>
                                /
                                <a href="{{route('delete-team',$team_data->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')" style="border-radius:50%">
                                <i class="fa fa-trash"></i>
                                </a>
                                </td>
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