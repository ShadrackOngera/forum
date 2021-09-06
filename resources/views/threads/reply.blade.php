
    <div class="card">

        <div class="panel-heading">
            <a href="#">{{$reply->owner->name}}</a> <br>
            {{$reply->created_at->diffForHumans()}}
        </div>
        <hr>
        <div class="card-body">
            {{$reply->body}}
        </div>
    </div>

