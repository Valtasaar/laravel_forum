@extends('layouts.app')

@section('content')
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

        @foreach($replies as $reply)
          @include('threads.reply')
        @endforeach

        @if(auth()->check())
          <form action="{{ $thread->path() . '/replies' }}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
              <textarea name="body" id="body" class="form-control" rows="5"
                placeholder="Have something to say?">
              </textarea>
            </div>

            <button class="btn btn-default" type="submit">Post</button>
          </form>
        @else
          <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion</p>
        @endif
      </div>

      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-body">
            This thread was publish {{ $thread->created_at->diffForHumans() }}
            by <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>, and currently has
            {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
          </div>
        </div>
      </div>
    </div>

    <br>
    <br>
  </div>
@endsection
