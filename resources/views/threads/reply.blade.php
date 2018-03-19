<div id="reply-{{ $reply->id }}" class="card">
    <div class="card-header">
        <div class="level">
            <h6 class="flex">
                <a href="/profiles/{{ $reply->owner->name }}">
                    {{ $reply->owner->name }}
                </a> said <b>{{ $reply->created_at->diffForHumans() }} ...</b>
            </h6>
            <div>

                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>

    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>

    @can('update', $reply)
        <div class="card-footer">
            <form method="POST" action="/replies/{{ $reply->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            </form>
        </div>
    @endcan
</div>