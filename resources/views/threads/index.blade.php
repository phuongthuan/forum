@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($threads as $thread)
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                                <h4 class="flex">
                                    <a href=" {{ $thread->path() }}">
                                        {{ $thread->title }}
                                    </a>
                                </h4>
                                <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
                            </div>
                            <small>Created by: {{ $thread->creator->name }} <p>{{ $thread->created_at->diffForHumans() }}</p>
                            </small>
                        </div>
                        <div class="card-body">
                            <article>
                                <div class="body">{{ $thread->body }}</div>
                            </article>
                        </div>
                    </div>
                    <br>

                @empty
                    <p>There are no relevant results at this time. </p>
                @endforelse

            </div>
        </div>
    </div>
@endsection
