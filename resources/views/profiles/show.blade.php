@extends('layouts.app')

@section('content')

    <div class="container">


        {{--Thread--}}

        <div class="card">
            <div class="card-header">All Threads by {{ $profileUser->name }}.
                <small>Update {{ $profileUser->created_at->diffForHumans() }}</small>
            </div>

            <div class="card-body">
                @foreach($threads as $thread)
                    <article>
                        <div class="level">

                            <h4 class="flex">
                                <a href=" {{ $thread->path() }}">
                                    {{ $thread->title }}
                                </a>
                            </h4>

                            <span>{{ $thread->created_at->diffForHumans() }}</span>

                        </div>

                        <div class="body">{{ $thread->body }}</div>
                    </article>

                    <hr>
                @endforeach
            </div>
        </div>
        <br>
        {{ $threads->links() }}

    </div>
@endsection