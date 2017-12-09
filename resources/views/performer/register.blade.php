@extends('layouts.app')

@section('content')

        {!!  Form::open(['method'=>'POST', 'action'=>'PerformerAddressController@store']) !!}

            <div class="form-group">
                    {!! Form::label('', '') !!}
                    {!! Form::text('first',null, ['class'=>'form-control']) !!}
            </div>
        <div class="form-group">
            {!! Form::label('', '') !!}
            {!! Form::text('',null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('', '') !!}
            {!! Form::text('',null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('', '') !!}
            {!! Form::text('',null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('', '') !!}
            {!! Form::text('',null, ['class'=>'form-control']) !!}
        </div>
            <div class="form-group">
                {!! Form::submit('Next',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

    @stop