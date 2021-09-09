@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum threads</div>

                    <div class="card-body">
                        @foreach($threads as $thread)
                            <article>
                                {{--                                {{$thread = thread::orderBy('id', 'DESC')->get()}}--}}
                                <div class="level flex">
                                    <h4 class="flex"><a href="{{ $thread->path() }}"> {{$thread->title}} </a></h4>
                                    <a href="{{$thread->path()}}">{{$thread->replies_count}} {{str_plural('reply')}}</a>
                                </div>

                                <div>{{$thread->body}}</div>
                                <hr>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
