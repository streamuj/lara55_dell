@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                {{--<div class="flowplayer" data-ratio="0.5625" data-live="true" data-autoplay="true" data-dvr="true">--}}
                    {{--<video>--}}
                        {{--<source type="application/x-mpegurl" src="{{$videoUrl}}">--}}
                    {{--</video>--}}
                {{--</div>--}}
                <dl8-cinema title="2001 Main Stage Live Stream" poster="poster.jpg" author="LVNetworks"
                                format="MONO_FLAT" room-format="MONO_360" room-src="/storage/images/ibiza_nightclub_reduced_4k.jpg"  screen-width="5" screen-height="3" screen-distance="2" force-show-cinema seekable>
                    <source src="{{$videoUrl}}" type="application/x-mpegurl" />
                </dl8-cinema>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <div id="tabs">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="#tabs-1" class="nav-link active"  id="onStage" data-toggle="tab">On Stage</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tabs-2" id="inClub" data-toggle="tab">In Club</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tabs-3" id="users" data-toggle="tab">Users</a></li>
                    </ul>


                    <div class="tab-content clearfix">
                        <div class="text-center tab-pane fade show active"  id="tabs-1">
                            <h2 class="text-center">On Stage Now</h2>

                            <div class="onlineGirls row" style="display: inline-flex;">
                                @if($onStageGirls)
                                    @foreach($onStageGirls as $girl)
                                    <div class="dropdown">
                                        <div class="girlContainer dropdown-toggle" data-toggle="dropdown" style="margin:5px;">
                                            <img src="/storage/{{$girl->user->avatar}}" alt="User Avatar" class="img-circle"  height="100"/>

                                            <div class="girlName caption post-content">
                                                <h3>{{$girl->user->name}}</h3>
                                            </div>
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li><a href="/profile/{{$girl->user->name}}">{{$girl->user->name}}'s Profile</a></li>
                                            <li><a href="">Tip {{$girl->user->name}}</a></li>
                                            <li><a href="">Make it Rain!</a></li>
                                        </ul>
                                    </div>
                                    @endforeach

                                @else
                                    <h2>No girl On stage Now</h2>
                                @endif

                            </div>
                        </div>

                        <div class="text-center tab-pane fade"  id="tabs-2">
                            <h2 class="text-center">In club Girls</h2>

                            <div class="onlineGirls row" style="display: inline-flex;">

                                @if($allInClubGirls)
                                    @foreach($allInClubGirls as $girl)
                                        <div class="girlContainer">
                                            <img src="/storage/{{$girl->user->avatar}}" alt="User Avatar" class="img-circle" height="100"/>
                                            <div class="girlName caption post-content">
                                                <h3>{{$girl->user->name}}</h3>
                                            </div>
                                        </div>
                                    @endforeach

                                @else
                                    <h2>No performers in club Now</h2>
                                @endif

                        </div>
                    </div>
                    <div class="text-center tab-pane fade"  id="tabs-3">
                        <h2 class="text-center">Online Users</h2>
                        <ul class="list-group">
                        @foreach($onlineUsers as $user)

                            <li class="list-group-item">{{$user->name}}</li>

                        @endforeach
                        </ul>
                        <div class="onlineGirls row" style="display: inline-flex;">



                        </div>
                    </div>
                </div>
            </div>

            {{--</div>--}}
            {{--<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">--}}
{{--                @include('chat.jqueryChat')--}}
                @include('chat.vueMSChat')

            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <h2>Online girls</h2>
                <h3>No performers</h3>
            </div>
            <div class="col-sm-6">
                <h2>Next on Stage</h2>
                {{--@if (Cache::has($user_id))--}}
                    {{--TRUE--}}
                    {{--@endif--}}
                @if($nextGirls)
                    @foreach($nextGirls as $girl)
                        <div class="dropdown">
                            <div class="girlContainer dropdown-toggle" data-toggle="dropdown" style="margin:5px;">
                                <img src="/storage/{{$girl->user->avatar}}" alt="User Avatar" class="img-circle"  height="100"/>

                                <div class="girlName caption post-content">
                                    <h3>{{$girl->user->name}}</h3>
                                </div>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="">{{$girl->user->name}}'s Profile</a></li>
                                <li><a href="">Tip {{$girl->user->name}}</a></li>
                                <li><a href="">Make it Rain!</a></li>
                            </ul>
                        </div>
                    @endforeach

                @else
                    <h2>No performer On stage Now</h2>
                @endif

            </div>
        </div>


    {{--<script>--}}

        {{--var chat_id = {{$chat_id}};--}}
        {{--var url = "/MsChatPost/";--}}
        {{--var user_id = {{$user_id}};--}}

        {{--//$(document).ready(function() {--}}
        {{--$(function(){--}}
            {{--$("#submit_message").click(function (e) {--}}
                {{--postMessage();--}}
            {{--});--}}
        {{--});--}}


{{--//            $(function() {--}}
{{--//                // Initializes and creates emoji set from sprite sheet--}}
{{--//                window.emojiPicker = new EmojiPicker({--}}
{{--//                    emojiable_selector: '[data-emojiable=true]',--}}
{{--//                    assetsPath: '../img/',--}}
{{--//                    popupButtonClasses: 'fa fa-smile-o'--}}
{{--//                });--}}
{{--//                // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields--}}
{{--//                // You may want to delay this step if you have dynamically created input fields that appear later in the loading process--}}
{{--//                // It can be called as many times as necessary; previously converted input fields will not be converted again--}}
{{--//                window.emojiPicker.discover();--}}
{{--//            });--}}

        {{--setInterval(function (){ getMessage();}, 4000);    //  Stupid timer--}}

        {{--function getMessage(){--}}
            {{--var url = "/MsChat/";--}}

            {{--$.ajaxSetup({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--}--}}
            {{--});--}}

            {{--$.ajax({--}}

                {{--type: "GET",--}}
                {{--url: url + chat_id,--}}
                {{--data: "",--}}
                {{--dataType: 'json',--}}
                {{--success: function (data) {--}}
                    {{--if(data.newMessage){--}}
                        {{--var payload = data.payload;--}}
                        {{--var newMessage = " <li class=\"left clearfix\"><span class=\"chat-img pull-left\">\n" +--}}
                            {{--"                            <img src=\"/storage/" + payload.avatar  + "\" alt=\"User Avatar\" class=\"img-circle\" height=70' />\n" +--}}
                            {{--"                        </span>\n" +--}}
                            {{--"                                        <div class=\"chat-body clearfix\" style=\"padding: 5px;\">\n" +--}}
                            {{--"                                            <div class=\"header\">\n" +--}}
                            {{--"                                                <strong class=\"primary-font\">"+ payload.username +"</strong>\n" +--}}
                            {{--"                                            </div>\n" +--}}
                            {{--"                                            <p class='lead'>\n" + payload.message + "\n" +--}}
                            {{--"                                            </p>\n" +--}}
                            {{--"                                        </div>\n" +--}}
                            {{--"                                    </li>";--}}

                        {{--$(".chat").append(newMessage);--}}
                        {{--chat_id ++;--}}

                        {{--$(".panel-body").scrollTop($('ul li').last().position().top + $('ul li').last().height());--}}
                    {{--}--}}

                {{--},--}}
                {{--error: function (data) {--}}
                    {{--console.log('Error:', data);--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

        {{--function postMessage(){--}}
            {{--$.ajaxSetup({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--}--}}
            {{--});--}}
            {{--var formData = {--}}
                {{--message: $("[name='message']").val(),--}}
                {{--user_id: user_id--}}
            {{--};--}}

            {{--$.ajax({--}}

                {{--type: "POST",--}}
                {{--url: url + user_id,--}}
                {{--data: formData,--}}
                {{--dataType: 'json',--}}
                {{--success: function (data) {--}}
                    {{--$(":text").val("");--}}

                    {{--getMessage();--}}

                {{--},--}}
                {{--error: function (data) {--}}
                    {{--console.log('Error:', data);--}}
                {{--}--}}
            {{--});--}}

        {{--}--}}

        {{--$(document).keypress(function(e) {--}}
            {{--if(e.which == 13) {--}}
                {{--postMessage();--}}
            {{--}--}}
        {{--});--}}

    {{--</script>--}}
@endsection
@section('scripts')
{{--<script--}}
        {{--src="https://code.jquery.com/jquery-3.2.1.min.js"--}}
        {{--integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="--}}
        {{--crossorigin="anonymous"></script>--}}


{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}

<script src="{{asset('js/config.js')}}"></script>
<script src="{{asset('js/util.js')}}"></script>
<script src="{{asset('js/jquery.emojiarea.js')}}"></script>
<script src="{{asset('js/emoji-picker.js')}}"></script>
<script src="//cdn.delight-vr.com/latest/dl8-0aaabae7aaa09240eff98ea7bba3dc1d1da220ef.js"
        async></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.1.5/js/config.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.1.5/js/util.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.1.5/js/jquery.emojiarea.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.1.5/js/emoji-picker.min.js"></script>--}}

@endsection



