@extends('layouts.admin-dashboard')

@section('content')
{{ $errors }}
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
                <h2>Employee {{ isset($detail) ? 'Update' : 'Add'}}</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(isset($detail) && isset($detail->id))
                    {{ Form::open(['url'=>route('update-employee',$detail->id), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'Employee-post']) }}
                @else
                    {{ Form::open(['url'=>route('post-employee'), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'employee-post']) }}
                @endif
                <div class="form-group row">
                    {{ Form::label('name', "Name:", ['class'=>'col-sm-3']) }}
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
                    {{ Form::label('email', "Email:", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::text('email', @$detail->email, ['class'=>"form-control ".($errors->has('email') ? 'is-invalid' : ''), 'id'=>'email', 'required'=>true])}}

                        @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('gender', "Gender:", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::select('gender', ['male'=>'Male', 'female'=>'Female','others'=>'Others'],@$detail->gender, ['class'=>"form-control ".($errors->has('gender') ? 'is-invalid' : ''), 'id'=>'gender'])}}

                        @if($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('department_id', "Department:", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        <select name="department_id" id="department" class="form-control{{ $errors->has('department_id') ? 'is_invalid' : '' }}">
                            <option value="" disabled selected>--Select Any One--</option>
                            @if($depart)
                                @foreach($depart as $department)
                                    <option value="{{ $department->id }}" {{ $department->id == @$detail->department_id ? 'selected' : ''}}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @if($errors->has('department_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('department_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3">Hire Date</label>
                    <div class="col-sm-9">
                        <input type="date" name="hire_date" id="hire_date" value="<?php echo date('Y-m-d') ;?>" class="form-control">
                    </div>
                </div>
                
                

               

                


               

                <div class="form-group row">
                    {{ Form::label('profile_image', "Profile Image:", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-5">
                        {{ Form::file('profile_image', ['class'=>($errors->has('profile_image') ? 'is-invalid' : ''), 'id'=>'profile_image', 'required'=>(isset($detail) ? false : true), 'onchange'=> "readUrl(this, 'thumb')"])}}

                        @if($errors->has('profile_image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('profile_image') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        @if(isset($detail, $detail->profile_image) &&
                        file_exists(public_path().'/uploads/employee/'.$detail->profile_image))
                        <img src="{{ asset('uploads/employee/'.$detail->profile_image) }}" alt=""
                            class="img img-responsive img-thumbnail" id="thumb">
                        @else
                        <img src="" alt="" class="img img-responsive img-thumbnail" id="thumb">
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
