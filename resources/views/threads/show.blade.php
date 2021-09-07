@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$thread->title}}</div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            @foreach($thread->replies as $reply)

                @include('threads.reply')

            @endforeach
        </div>


    @if(auth()->check())
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ $thread->path() . '/replies'}}">
                    {{csrf_field()}}

                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" rows="5" placeholder="Have Something To  Say?"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default">Post</button>
                </form>
            </div>
        </div>
        @else
            <p class="text-center">please <a href="{{route('login') }}">Sign in </a>to participate in this discussion</p>
        @endif

    </div>
@endsection
