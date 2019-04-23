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
                {{ Form::open(['url'=>route('update-teamrole',$detail->id), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'team-post']) }}
                @else
                {{ Form::open(['url'=>route('post-teamrole'), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'team-post']) }}
                @endif
                <div class="form-group row">
                    {{ Form::label('role_name', "Team Role:", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::text('role_name', @$detail->role_name, ['class'=>"form-control ".($errors->has('role_name') ? 'is-invalid' : ''), 'id'=>'role_name', 'required'=>true])}}

                        @if($errors->has('role_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role_name') }}</strong>
                        </span>
                        @endif
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