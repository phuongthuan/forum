@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <h1>
                    {{ $profileUser->name }}
                </h1>
                <hr>

                @forelse($activities as $date =>  $activity)
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $date }}.</h3>
                        </div>

                        <div class="card-body">
                            @foreach($activity as $record)
                                @if(view()->exists("profiles.activities.{$record->type}"))
                                    @include("profiles.activities.{$record->type}", ['activity' => $record])
                                @endif
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    <br><br>
                @empty
                    <p>There is no activity for this user yet.</p>
                @endforelse
                <br>
            </div>
        </div>

    </div>
@endsection