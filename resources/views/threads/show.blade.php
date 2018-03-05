@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $thread->title }}</div>

                    <div class="card-body">
                        {{ $thread->body }}
                    <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)

                    <div class="card">
                        <div class="card-header">
                            <a href="#">
                                {{ $reply->owner->name }}
                            </a> said <b>{{ $reply->created_at->diffForHumans() }} ...</b>
                        </div>
                        <div class="card-body">
                            {{ $reply->body }}
                        </div>
                    </div>
                @endforeach
            </div>git
        </div>
    </div>
@endsection
