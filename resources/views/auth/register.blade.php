@extends('layouts.login')

@section('content')

        <div class="form-area">


            <div class="form-wrapper">
                <h1>{{ 'Register' }}</h1>
                <form method="POST" action="{{ route('register') }}">
                @csrf

                 <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label ">{{ __('First Name') }}</label>


                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}"  autocomplete="first_name" autofocus>

                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                   
                </div>

                 <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label ">{{ __('Last Name') }}</label>


                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autofocus>

                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                 <div class="form-group">
                    <label for="email" class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>


                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                 <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                </div>

                 <div class="form-group">
                    <label for="password-confirm" class="col-md-4 col-form-label ">{{ __('Confirm Password') }}</label>


                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                    {{--<input id="user_type_id" type="hidden" class="form-control" name="user_type_id" value="{{$user_type}}" >--}}

                </div>
                <div class="form-inline">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_type_id" id="user_type_id"  value="2" required>
                        <label class="form-check-label" for="remember">
                            {{ __('Buyer') }}
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_type_id" id="user_type_id"  value="1" required>
                        <label class="form-check-label" for="remember">
                            {{ __('Seller') }}
                        </label>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="">
                        <button type="submit" class="home-btn option-btn">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>


@endsection
