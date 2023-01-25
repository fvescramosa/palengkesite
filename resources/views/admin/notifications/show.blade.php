@extends('layouts.admin')

@section('content')

<div class="notif-container">
  @foreach($notifs as $notif)
  <div class="content">
      <div class="notif-title">
        <h3>{{ $notif->title }}</h3>
      </div>
      <div class="description">
        <p>{{ $notif->description }}</p>
      </div>
    </div>
  @endforeach
  </div>
</div>

@endsection