@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                {{--Thread--}}
                <div class="card">
                    <div class="card-header">
                        <a href="/threads?by={{ $thread->creator->name }}"> {{ $thread->creator->name }} </a> posted:
                        <strong>{{ $thread->title }}</strong></div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <hr>

                {{--Reply--}}
                @foreach($replies as $reply)
                    @include('threads.reply')
                    <br>
                @endforeach

                {{ $replies->links() }}



                {{--Comment-Form--}}
                @if(auth()->check())
                    <form method="POST" action="{{ $thread->path() . '/replies'}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                @else
                    <div class="col-md-auto">
                        <p class="text-center">Please <a href="/login">Sign In</a> to participate in this discussion.</p>
                    </div>
                @endif

            </div>


            {{--Side-bar--}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>,
                            and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
