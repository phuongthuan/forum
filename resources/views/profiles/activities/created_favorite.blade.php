@component('profiles.activities.activity')

    @slot('heading')

        {{--        @dd( $activity->subjectable->favoritable->path() )--}}

        <a href="#"> {{--It failed--}}
            {{ $profileUser->name }} favorited a reply.
        </a>

    @endslot

    @slot('body')
        {{--{{ $activity->subjectable->favoritable->body }} --}}{{--It failed--}}

        {{ $activity->subjectable->favoritable['body'] }}
    @endslot

@endcomponent