<div class="card">
    <div class="card-header">
        <a href="#">
            {{ $reply->owner->name }}
        </a> said <b>{{ $reply->created_at->diffForHumans() }} ...</b>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>