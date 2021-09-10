<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                <a href="#">{{$reply->owner->name}}</a>
                said {{$reply->created_at->diffForHumans()}}...
            </h5>
            <form action="/replies/{{$reply->id}}/favorites" method="post">
                {{csrf_field()}}

                <button class="btn btn-default">
                    {{--                    {{$reply->favorites()->count() }} {{ str_plural('Favorite', $reply->favorites()->count()) }}--}}
                </button>
            </form>
        </div>

    </div>
    <hr>
    <div class="panel-body">
        {{$reply->body}}
    </div>
</div>

