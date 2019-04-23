@extends('layouts.admin-dashboard')

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>{{ $_title }}</h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Team {{ isset($detail) ? 'Update' : 'Add'}}</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(isset($detail))
                {{ Form::open(['url'=>route('update-team',$detail->id), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'team-post']) }}
                @else
                {{ Form::open(['url'=>route('post-team'), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'team-post']) }}
                @endif
                <div class="form-group row">
                    {{ Form::label('name', "Team Member:", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::text('name', @$detail->name, ['class'=>"form-control ".($errors->has('name') ? 'is-invalid' : ''), 'id'=>'name', 'required'=>true])}}

                        @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>
                <div class="form-group row">
                	<label for="" class="col-sm-3">Role</label>
                				<div class="col-sm-9">
                					<select name="teamrole_id" id="teamrole_id" required class="form-control">
                						<option value="">--Select one role--</option>
                						
                							@if($role){
                								@foreach($role as $role_data){
                								
                								<option value="{{$role_data->id}}" {{($role_data->id == @$detail->teamrole_id)?'selected':''}}>{{$role_data->role_name}}</option>
                								@endforeach
                							@endif
                								
                					</select>
                				</div>
                			</div>

                

               
                <div class="form-group row">
                    {{ Form::label('', "", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::submit('Submit', ['class'=>"btn btn-success", 'id'=>'submit'])}}

                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection