@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} replied to Thread:
        <a href="{{ $activity->subjectable->thread->path() }}">
            "{{ $activity->subjectable->thread->title }}"
        </a>
    @endslot

    @slot('body')
        {{ $activity->subjectable->body }}
    @endslot
@endcomponent