@extends('layouts.performer')

@section('content')
<div class="container">
    <div class="card card-dark">
        <div class="card-header">Performer Register Step 1</div>
            <div class="card-body">
                {!!  Form::open(['method'=>'POST', 'action'=>'PerformerProfileController@store', 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('nickname', 'Stage Name') !!}
                    {!! Form::text('nickname',null, ['class'=>'form-control', 'placeholder' => "Your Stage Name"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'About me') !!}
                    {!! Form::text('description',null, ['class'=>'form-control', 'placeholder' => "Describe yourself in short word."]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('birthday', 'Birth Day') !!}
                    {!! Form::text('birthday',null, ['class'=>'form-control', 'id' =>'bdfield']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('turnOn', 'Turn On') !!}
                    {!! Form::text('turnOn',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('turnOff', 'Turn Off') !!}
                    {!! Form::text('turnOff',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('ethnicity', 'Ethnicity') !!}
                    {!! Form::text('ethnicity',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('height', 'Height') !!}
                    {!! Form::text('height',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('hair_color', 'Hair Color') !!}
                    {!! Form::text('hair_color',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('eye_color', 'Eye Color') !!}
                    {!! Form::text('eye_color',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('build', 'Build') !!}
                    {!! Form::text('build',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('cup_size', 'Cup size') !!}
                    {!! Form::text('cup_size',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('avatar', 'Upload your Avatar') !!}
                    {!! Form::file('avatar', ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Next',['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}

            </div>


    </div>
</div>
<script>


    $(function(){
        $('#bdfield input').datepicker({
        });
    });
</script>

@stop

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    @stop