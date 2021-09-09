@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="paneel">{{$thread->title}}</div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>
            </div>


            <div class="col-md-8">

                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{$replies->links() }}

            </div>
            @if(auth()->check())
                <div class="col-md-8">
                    <form method="POST" action="{{ $thread->path() . '/replies'}}">
                        {{csrf_field()}}

                        <div class="form-group">
                                <textarea name="body" id="body" class="form-control" rows="5"
                                          placeholder="Have Something To  Say?"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                </div>
            @else
                <p class="text-center">please <a href="{{route('login') }}">Sign in </a>to participate in this
                    discussion
                </p>
            @endif
        </div>

        <div class="col-md-4 float-right">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        This Thread was published {{$thread->created_at->diffForHumans()}} by <a
                            href="#">{{$thread->creator->name}}</a>, and currently
                        has {{$thread->replies_count}} {{str_plural('comment', $thread->replies_count)}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
