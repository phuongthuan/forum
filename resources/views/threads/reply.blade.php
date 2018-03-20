<reply :attributes="{{ $reply }}" inline-template v-cloak>
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
                        <button type="submit" class="btn btn-default btn-sm" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                            {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                        </button>
                    </form>
                </div>
            </div>

        </div>


        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button @click="update" type="submit" class="btn btn-primary btn-sm">Update</button>
                <button @click="editing = false" type="submit" class="btn btn-link btn-sm">Cancel</button>
            </div>

            <div v-else v-text="body">
            </div>
        </div>

        @can('update', $reply)
            <div class="card-footer level">
                <button @click="editing = true" type="submit" class="btn btn-sm mr-1">Edit</button>
                <button @click="destroy" type="submit" class="btn btn-danger btn-sm mr-1">Delete</button>
                {{--<form method="POST" action="/replies/{{ $reply->id }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--{{ method_field('DELETE') }}--}}
                    {{--<button type="submit" class="btn btn-danger btn-sm">Delete</button>--}}
                {{--</form>--}}
            </div>
        @endcan
    </div>
</reply>