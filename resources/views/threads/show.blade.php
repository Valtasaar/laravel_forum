@extends('layouts.app')

@section('content')
  <thread-view inline-template initial-replies-count="{{ $thread->replies_count }}">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading clearfix">
              <div class="left">
                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                posted:
                {{ $thread->title }}
              </div>

              <div class="right">
                @can('update', $thread)
                  <form method="post" action="{{ $thread->path() }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}

                    <button type="submit" class="btn btn-link">Delete Thread</button>
                  </form>
                @endcan
              </div>
            </div>

            <div class="panel-body">
              {{ $thread->body }}
            </div>
          </div>

          <replies
              :data="{{ $thread->replies }}"
              @added="repliesCount++"
              @removed="repliesCount--">
          </replies>
        </div>

        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-body">
              This thread was publish {{ $thread->created_at->diffForHumans() }}
              by <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>, and currently has
              <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.

              <p>
                <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <br>
      <br>
    </div>
  </thread-view>
@endsection
