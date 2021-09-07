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
                                <a href="{{ $thread->path() }}"> {{$thread->title}} </a>
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
