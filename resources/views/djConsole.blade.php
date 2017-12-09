@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 well well-sm">
                <div class="row">

                    <h3 class="text-center">All girls</h3>
                </div>
                <div class="row col-sm-8 col-sm-offset-2">
                        {{--{!!  Form::open(['method'=>'GET', 'action'=>'InClubPerformerController@index']) !!}--}}

                        {{--<div class="form-group">--}}
                            {{--{!! Form::text('allGirlSearch',null, ['class'=>'form-control']) !!}--}}
                        {{--</div>--}}

                            {{--{!! Form::close() !!}--}}
                    <input type="text" class="form-control" id="allGirlSearch">

                </div>
                <div class="row">
                    <div class="girlpool col-sm-12" id="status0">
                        <h3 class="text-center">Girl Pool</h3>
                    </div>
                </div>

            </div>
            <div class="col-sm-3 well well-sm">
                <div class="row">

                    <h3 class="text-center">In club girls</h3>
                </div>
                <div class="row col-sm-8 col-sm-offset-2">
                    {{--{!!  Form::open(['method'=>'GET', 'action'=>'InClubPerformerController@index']) !!}--}}

                    {{--<div class="form-group">--}}
                        {{--{!! Form::text('inClubSearch',null, ['class'=>'form-control']) !!}--}}
                    {{--</div>--}}

                    {{--{!! Form::close() !!}--}}

                    <input type="text" class="form-control" id="inClubSearch">
                </div>
                <div class="row">
                    <div class="girlpool col-sm-12" id="status1">
                        <h3 class="text-center">Girl Pool</h3>
                        @if($inHouseGirls)
                            @foreach($inHouseGirls as $girl)
                                <div class="girlContainer col-sm-3 inline" id="{{$girl->user->id}}">
                                    <img src="/storage/{{$girl->user->avatar}}" alt="User Avatar" class="img-circle" height="100"/>
                                    <div class="girlName caption post-content text-center">
                                        <h3>{{$girl->user->name}}</h3>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6 well">
                        <h3>Next</h3>
                            <div class="girlpool" id="status2">
                            @if($nextGirls)
                                @foreach($nextGirls as $girl)
                                    <div class="girlContainer col-sm-3 inline" id="{{$girl->user->id}}">
                                        <img src="/storage/{{$girl->user->avatar}}" alt="User Avatar" class="img-circle" height="100"/>
                                        <div class="girlName caption post-content text-center">
                                            <h3>{{$girl->user->name}}</h3>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h2>No performer On stage Now</h2>
                            @endif
                                <br>

                            </div>
                    </div>
                    <div class="col-sm-6 well">
                        <h3>On Stage</h3>
                        <div class="girlpool" id="status3">

                        @if($onStageGirls)
                                @foreach($onStageGirls as $girl)
                                    <div class="girlContainer col-sm-3 inline" id="{{$girl->user->id}}" >
                                        <img src="/storage/{{$girl->user->avatar}}" alt="User Avatar" class="img-circle" height="100"/>
                                        <div class="girlName caption post-content text-center">
                                            <h3>{{$girl->user->name}}</h3>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h2>No performer On stage Now</h2>
                            @endif
                            <br>
                        </div>
                    </div>

                </div>
                <div class="row well">
                    <div class="col-sm-8">
                        <h3>Chat Area</h3>
                        @include('chat.jqueryChat')

                    </div>
                    <div class="col-sm-4">
                        <h4>users</h4>
                        <ul class="list-group">
                            @foreach($onlineUsers as $user)

                                <li class="list-group-item">{{$user->name}}</li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <style>
        .girlpool {
            min-height: 160px;
        }
    </style>

    <script>
    $(document).ready(function () {
        function $(id) {
            return document.getElementById(id);
        }
        var status;
        var user_id;

            dragula([$('status0'), $('status1'), $('status2'), $('status3')])
                .on('drop', function (el, container) {
                    string = container.id;
                    status = string.replace("status", "");
                    user_id = el.id;

                    updateStatus(user_id, status);
                });



    });

    $(function(){
        $("input#inClubSearch").keyup(function(){
            var poolsearch = $("input#inClubSearch").val();
                poolsearch = poolsearch.trim();
                if(poolsearch.length > 0) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({

                        type: "GET",
                        url: "/poolsearch/" + poolsearch,
                        dataType: 'json',
                        success: function (data) {

                            $("div#status1").html(data.payload);

                            dragula([$('status0'), $('status1'), $('status2'), $('status3')])
                                .on('drop', function (el, container) {
                                    string = container.id;
                                    status = string.replace("status", "");
                                    user_id = el.id;

                                    updateStatus(user_id, status);
                                });
                            //                    alert(JSON.stringify(data.payload, null, 4));

                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
        });


    $("input#allGirlSearch").keyup(function(){
            var poolsearch = $("input#allGirlSearch").val();
            poolsearch = poolsearch.trim();
            if(poolsearch.length > 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    type: "GET",
                    url: "/allGirlsSearch/" + poolsearch,
                    dataType: 'json',
                    success: function (data) {

                        $("div#status0").html(data.payload);

                        dragula([$('status0'), $('status1'), $('status2'), $('status3')])
                            .on('drop', function (el, container) {
                                string = container.id;
                                status = string.replace("status", "");
                                user_id = el.id;

                                updateStatus(user_id, status);
                            });
                        //                    alert(JSON.stringify(data.payload, null, 4));

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });

    function updateStatus(user_id, status){

        var url ="/inclub";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            status: status,
            user_id: user_id
        };
        if(status > 0) {
            $.ajax({

                type: "POST",
                url: url,
                data: formData,
                dataType: 'json',
                success: function (data) {

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }else{
            $.ajax({

                type: "DELETE",
                url: url + "/" + user_id,
                data: formData,
                dataType: 'json',
                success: function (data) {

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        }
    }
    /*
    * Mainstage ajax copy
    *
    * */
    var chat_id = {{$chat_id}};
    var dj_user_id = {{$user_id}};

    //$(document).ready(function() {
    $(function(){
        $("#submit_message").click(function (e) {
            postMessage();
        });
    });


    //            $(function() {
    //                // Initializes and creates emoji set from sprite sheet
    //                window.emojiPicker = new EmojiPicker({
    //                    emojiable_selector: '[data-emojiable=true]',
    //                    assetsPath: '../img/',
    //                    popupButtonClasses: 'fa fa-smile-o'
    //                });
    //                // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
    //                // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
    //                // It can be called as many times as necessary; previously converted input fields will not be converted again
    //                window.emojiPicker.discover();
    //            });

    setInterval(function (){ getMessage();}, 4000);    //  Stupid timer

    function getMessage(){

        var url = "/MsChat/";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            type: "GET",
            url: url + chat_id,
            data: "",
            dataType: 'json',
            success: function (data) {
                if(data.newMessage){
                    var payload = data.payload;
                    var newMessage = " <li class=\"left clearfix\"><span class=\"chat-img pull-left\">\n" +
                        "                            <img src=\"/storage/" + payload.avatar  + "\" alt=\"User Avatar\" class=\"img-circle\" height=70' />\n" +
                        "                        </span>\n" +
                        "                                        <div class=\"chat-body clearfix\" style=\"padding: 5px;\">\n" +
                        "                                            <div class=\"header\">\n" +
                        "                                                <strong class=\"primary-font\">"+ payload.username +"</strong>\n" +
                        "                                            </div>\n" +
                        "                                            <p class='lead'>\n" + payload.message + "\n" +
                        "                                            </p>\n" +
                        "                                        </div>\n" +
                        "                                    </li>";

                    $(".chat").append(newMessage);
                    chat_id ++;

                    $(".panel-body").scrollTop($('ul li').last().position().top + $('ul li').last().height());
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    function postMessage(){

        var url = "/MsChatPost/";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            message: $("[name='message']").val(),
            user_id: dj_user_id
        };

        $.ajax({

            type: "POST",
            url: url + dj_user_id,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $(":text").val("");
                getMessage();

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    }

    $(document).keypress(function(e) {
        if(e.which == 13) {
            postMessage();
        }
    });


    </script>
    @stop

@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.js"></script>

@endsection