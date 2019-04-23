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
                <h2>Message {{ isset($detail) ? 'Update' : 'Add'}}</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(isset($detail))
                {{ Form::open(['url'=>route('update-msg',$detail->id), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'msg-post']) }}
                @else
                {{ Form::open(['url'=>route('post-msg'), 'class' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'msg-post']) }}
                @endif
                <div class="form-group row">
                    {{ Form::label('title', "Title", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::text('title', @$detail->title, ['class'=>"form-control ".($errors->has('title') ? 'is-invalid' : ''), 'id'=>'title', 'required'=>true])}}

                        @if($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                 <div class="form-group row">
                    {{ Form::label('msgbody', "Your Message", ['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                        {{ Form::textarea('msgbody', @$detail->msgbody, ['class'=>"form-control ".($errors->has('msgbody') ? 'is-invalid' : ''), 'id'=>'msgbody', 'required'=>true])}}

                        @if($errors->has('msgbody'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('msgbody') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Group</label>
                        <div class="col-sm-9">
                            <select name="role_id" id="roledata" required class="form-control">
                                <option value="">--Select one group--</option>
                                        
                                    @if($role)
                                        @foreach($role as $role_data){
                                            <option value="{{$role_data->id}}"  {{($role_data->id == @$detail->teamrole_id)?'selected':''}}>{{$role_data->role_name}}</option>
                                        @endforeach
                                    @endif           
                            </select>
                        </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3">Members</label>
                        <div class="col-sm-9" id="members">
                        
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
@section('scripts')
<script>
    $('#roledata').on('change', function(){
        var role_id = $(this).val();
        $.ajax({
            url: '/msg/role/'+role_id,
            type: 'get',
            success: function(data){
                if(typeof(data) != 'object'){
                    data = $.parseJSON(data);
                }
                console.log(data);
                if(data.status && data.data != ''){
                    var html = '<select name="member_id[]" id="" required class="form-control" multiple>';
                        html += '<option value="" class="form-control" disabled selected>--Select Members To Send Message--</option>';
                        $.each(data.data,function( key,value ){ 
                            html += "<option value='"+value.id+"' class='form-control'>"+value.name+"</option>";
                        });
                        html += '</select>'
                     $('#members').html(html); 
                }
            }
               
        });
});
</script>
@endsection