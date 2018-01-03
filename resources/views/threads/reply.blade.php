{{--
<reply inline-template :attributes="{{ $reply }}" v-cloak>
  <div id="reply-{{ $reply->id }}" class="panel panel-default">
    <div class="panel-heading clearfix">
      <div class="left">
        <a href="{{ route('profile', $reply->owner->name) }}">
          {{ $reply->owner->name }}
        </a>
        said {{ $reply->created_at->diffForHumans() }}
      </div>

      <div class="right">
        <favorite :reply="{{ $reply }}" user="{{ auth()->check() }}"></favorite>
      </div>
    </div>

    <div class="panel-body">
      <div v-if="editing">
        <div class="form-group">
          <textarea class="form-control" v-model="body"></textarea>
        </div>

        <button class="btn btn-xs btn-primary" @click="update">Update</button>
        <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>
      </div>

      <div v-else v-text="body"></div>
    </div>

    @can('update', $reply)
      <div class="panel-footer">
        <button class="btn btn-xs" @click="editing = true">Edit</button>
        <button class="btn btn-danger btn-xs" @click="destroy">Delete</button>
      </div>
    @endcan
  </div>
</reply>--}}
