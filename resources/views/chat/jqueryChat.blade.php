<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-comment"></span> Chat
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
                <ul class="dropdown-menu slidedown">
                    <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                    <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                    <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                    <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                            Away</a></li>
                    <li class="divider"></li>
                    <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                            Sign Out</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <ul class="chat">

            </ul>
        </div>
        <div class="panel-footer">
            <div class="input-group">
                <div class="col-sm-12">
                    {!! Form::text('message',null, ['class'=>'form-control input-sm', 'placeholder'=>"Type your message here...", 'data-emojiable'=>"true"]) !!}
                </div>
                <input type="hidden" name="user_id" value="{{$user_id}}">
                <span class="input-group-btn">
                                    {!! Form::button('Post',['class'=>'btn btn-primary btn-sm', 'id' =>'submit_message']) !!}

                                    </span>
            </div>
        </div>
    </div>
</div>