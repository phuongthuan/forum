@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <h1>
                    {{ $profileUser->name }}
                </h1>
                <hr>

                @foreach($activities as $date =>  $activity)
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $date }}.</h3>
                        </div>

                        <div class="card-body">
                            @foreach($activity as $record)
                                @include("profiles.activities.{$record->type}", ['activity' => $record])
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    <br><br>
                @endforeach
                <br>
            </div>
        </div>

    </div>
@endsection