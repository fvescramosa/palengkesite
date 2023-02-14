@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="profile">
        <div class="profile-wrapper">
            
            <div class="form-area">

            @if(($errors->any()))
                <div class="alert alert-danger alert-dismissible" role="alert" id="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Reminder!</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                </div>
            @endif


                <div class="form-wrapper">
                    <h3>{{ 'Register' }}</h3>
                    <form method="POST" action="{{ route('admin.store') }}">
                    @csrf

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label ">{{ __('Name') }}</label>


                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                        
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>


                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label ">{{ __('Confirm Password') }}</label>


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            {{--<input id="user_type_id" type="hidden" class="form-control" name="user_type_id" value="{{$user_type}}" >--}}

                        </div>

                        <div class="row-btn">
                            <div class="btn-container">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
