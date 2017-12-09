@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1 class="text-center">Guest VIew</h1>
                        <h2 class="text-center">Invitation ONLY.</h2>
                        <h3 class="text-center">Please Log in.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
