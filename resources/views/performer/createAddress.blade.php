@extends('layouts.performer')

@section('content')
    <div class="container">
        <div class="card card-dark">
            <div class="card-header">Performer Register Step 2 -Payment Information-</div>
            <div class="card-body">
                {!!  Form::open(['method'=>'POST', 'action'=>'PerformerProfileController@store']) !!}

                <div class="form-group">
                    {!! Form::label('first_name', 'First Name') !!}
                    {!! Form::text('first_name',null, ['class'=>'form-control', 'placeholder' => ""]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('last_name', 'Last Name') !!}
                    {!! Form::text('last_name',null, ['class'=>'form-control', 'placeholder' => ""]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Address') !!}
                    {!! Form::text('address',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address2', 'Address2') !!}
                    {!! Form::text('address2',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city', 'City') !!}
                    {!! Form::text('city',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state', 'State') !!}
                    {!! Form::text('state',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('zipcode', 'Zip Code') !!}
                    {!! Form::text('zipcode',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('last4SSN', 'Last 4 digits of SSN') !!}
                    {!! Form::text('last4SSN',null, ['class'=>'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::submit('Next',['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>


        </div>
    </div>

@stop