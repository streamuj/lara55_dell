@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="playerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="flowplayer" data-ratio="0.5625">
                <video>
                    {{--<source type="application/x-mpegurl" src="https://s3.amazonaws.com/2001live-test/nadia_intro.mp4">--}}
                    <source type="video/mp4" src="https://s3.amazonaws.com/2001live-test/nadia_intro.mp4">
                </video>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Purchase Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to buy this Video <span id="title"></span> for <span id="price"></span> credits?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary video_purchase" id="">Purchase Video</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="page-header">
            <div class="btn-toolbar pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Free Videos</button>
                    <button type="button" class="btn btn-secondary">Paid Videos</button>
                    <button type="button" class="btn btn-success">VR Videos</button>
                    @if(Auth::check())
                    <button type="button" class="btn btn-info">My Videos</button>

                    @endif
                </div>
            </div>
            <h2>All Videos</h2>
        </div>
    <div class="row">
    {{--@if($videos > 0)--}}

        @foreach($videos as $video)
                <div class="card col-sm-6 col-md-4 col-lg-4 text-white">
                    <img src="{{$video->thumbnail}}" alt="Video Thumbnail" id="{{$video->id}}" class="card image top img-rounded video_thumb" style="cursor: pointer;" height="180">
                    <div class="card-body">
                        <a href="/profile/{{$video->performerProfile->nickname}}">
                            <p class="text-left">{{$video->performerProfile->nickname}}</p>
                        </a>

                        <h3 class="text-left">
                            {{$video->title}}
                            @if($video->is_vr)
                                <span class="badge badge-primary">VR</span>
                            @endif
                        </h3>
                        <p class="text-left">{{$video->description}}</p>

                        @if($video->is_paid > 0)
                            <p class="text-left">{{$video->is_paid}} Credits</p>
                        @else
                            <p class="text-left">FREE!</p>
                        @endif
                    </div>

                </div>

        @endforeach


    {{--@endif--}}
    </div>
    {{$videos->links()}}
    </div>

    <script>
        $(function(){
            $(".video_thumb").click(function (e) {
                var id = $(this).attr('id');
                var url = "/videos/";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    type: "GET",
                    url: url + id,
                    data: "",
                    dataType: 'json',
                    success: function (data) {
                        if(data.haveNotPaid){
                            $('span#price').html(data.is_paid);
                            $('span#title').html(data.title);
                            $('.video_purchase').attr('id', data.id);
                            $('#confirmationModal').modal({
                                show: 'true'
                            });

                        }else{
                            $('#playerModal').modal({
                                show: 'true'
                            });
                        }

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });


            });

        $(".video_purchase").click(function (e) {
            var id = $(this).attr("id");
            var url = "/videoPurchase";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var formData = {
                video_id: id

            };

            $.ajax({

                type: "POST",
                url: url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    if(data.haveNotPaid){
                        $('#playerModal').modal({
                            show: 'true'
                        });

                    }else{

                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });




        });


        });


        function postMessage(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                message: $("[name='message']").val(),
                user_id: user_id
            };

            $.ajax({

                type: "POST",
                url: url + user_id,
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


    </script>

@endsection

@section('scripts');
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>--}}

    @endsection