@extends('layouts.app')

@section('content')
    <thread-view :number-of-replies="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    {{--Thread--}}
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                            <span class="flex">
                                <a href="/profiles/{{ $thread->creator->name }}"> {{ $thread->creator->name }} </a> posted:
                                <strong>{{ $thread->title }}</strong>
                            </span>


                                @can('update', $thread)
                                    <form action="{{ $thread->path() }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-link">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>

                    <hr>

                    {{--Reply--}}
                    <replies @removed="repliesCount--" @added="repliesCount++"></replies>

                    <br>

                </div>

                {{--Side-bar--}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>This thread was published {{ $thread->created_at->diffForHumans() }} by
                                <a href="#">{{ $thread->creator->name }}</a>,
                                and currently has <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.
                            </p>

                            <p>
                                <subcribe-button :active="{{ json_encode($thread->isSubcribedTo) }}"></subcribe-button>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </thread-view>
@endsection
