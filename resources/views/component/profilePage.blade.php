@extends('layouts.app')

@section('content')
<div class="container-fluid jumbotron" style="background-image:url('/storage/{{$profile->landing_image_path}}'); height: 500px;">
    <div class="container"   style="background: rgba(10, 10, 10 , 0.7);">
        <div class="row">
            <div class="col-md-2">
            <img src="/storage/{{$profile->user->avatar}}" alt="performers avatar" class="rounded float-left" height="100" >
            </div>
            @if($profile->BDGirl)
                {{--<div class="">--}}
                    {{--<img src="/storage/avatar/5GX1nEOXdrhmb7lRtcul6JG4CtpMZEjOtIheKnST.png" alt="pink tiara" height="50" style="position: absolute; margin-top: -50px; margin-left: -180px;">--}}
                {{--</div>--}}
                <h2 class="display-2 col-md-8">👸 Happy Birthday, {{$profile->nickname}} !! 👸</h2>
                {{--<div class="col-sm-2">--}}
                    {{--<img src="/storage/avatar/5GX1nEOXdrhmb7lRtcul6JG4CtpMZEjOtIheKnST.png" alt="pink tiara" height="50">--}}
                {{--</div>--}}
            @endif
        </div>
            <div class="background-panel">

                <h2 class="text-left">{{$profile->nickname}}</h2>
                <h3 class="text-left">{{$profile->description}}</h3>

                <dl class="row">
                    <dt class="col-sm-3">Turn On</dt>
                    <dd class="col-sm-9">{{$profile->turnOn}}</dd>

                    <dt class="col-sm-3">Turn Off</dt>
                    <dd class="col-sm-9">{{$profile->turnOff}}</dd>


                    <dt class="col-sm-3">Ethnicity</dt>
                    <dd class="col-sm-9">{{$profile->ethnicity}}</dd>

                    <dt class="col-sm-3">Height</dt>
                    <dd class="col-sm-9">{{$profile->height}}</dd>

                    <dt class="col-sm-3">Hair Color</dt>
                    <dd class="col-sm-9">{{$profile->hair_color}}</dd>

                    <dt class="col-sm-3">Build</dt>
                    <dd class="col-sm-9">{{$profile->build}}</dd>

                    <dt class="col-sm-3">Cup size</dt>
                    <dd class="col-sm-9">{{$profile->cup_size}}</dd>

                    <dt class="col-sm-3">Zodiac Sign</dt>
                    <dd class="col-sm-9">{{$profile->zodiac}}</dd>
                </dl>
            </div>
    </div>

</div>


<div class="container photo-gallery">
    @if($pictures > 0)

    @foreach($pictures as $picture)
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="/w3images/lights.jpg" target="_blank">
                        <img src="/storage/{{$picture->path}}" alt="Lights" style="width:100%">
                        <div class="caption">
                            <p>$picture->title</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

    @else

        <h2>No pictures</h2>

    @endif



</div>
@endsection
