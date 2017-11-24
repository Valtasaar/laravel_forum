@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Create a New Thread</div>

          <div class="panel-body">
            <form method="post" action="/threads">
              {{ csrf_field() }}

              <div class="form-group">
                <label for="channel_id">Choose a Channel:</label>
                <select name="channel_id" id="channel_id" class="form-control" required>
                  <option value="">Choose one</option>

                  @foreach($channels as $channel)
                    <option
                        value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}
                    >
                      {{ $channel->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="title">Title:</label>
                <input
                    id="title"
                    class="form-control"
                    name="title"
                    type="text"
                    value="{{ old('title') }}"
                    required
                >
              </div>

              <div class="form-group">
                <label for="body">Body:</label>
                <textarea
                    id="body"
                    class="form-control"
                    name="body"
                    rows="8"
                    required
                >
                  {{ old('body') }}
                </textarea>
              </div>

              <div class="form-group">
                <button class="btn btn-primary" type="submit">Publish</button>
              </div>

              @if(count($errors))
                <ul class="alert alert-danger">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection