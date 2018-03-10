@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} created a thread <a href="{{ $activity->subjectable->path() }}">"{{ $activity->subjectable->title }}"</a>
    @endslot

    @slot('body')
        {{ $activity->subjectable->body }}
    @endslot
@endcomponent
