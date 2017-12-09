<div class="onlineGirls row" style="display: inline-flex;">
    @if($onStagePerformers)
        @foreach($onStagePerformers as $performer)
            <div class="girlContainer">
                <img src="/storage/avatar/{{$performer->user->avatar}}" alt="User Avatar" class="img-circle" height="100"/>
                <div class="girlName caption post-content">
                    <h3>{{$performer->user->name}}</h3>
                </div>
            </div>
        @endforeach

            @else
                <h2>No performer On stage Now</h2>
            @endif
        </div>