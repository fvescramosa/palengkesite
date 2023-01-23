@extends('layouts.admin')

@section('content')
<div class="container">
        <div class="profile">
            <div class="profile-wrapper">
            
        <div class="form-area">

            @if (Session::has('message'))
                <div class="alert alert-success }}"><strong>{{ Session::get('message')  }}</strong></div>
            @endif

            <div class="form-wrapper">
                <h3>{{ 'Change Password' }}</h3>
                <form method="POST" action="{{ route('admin.update.password') }}">
                @csrf



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

                <div class="row mb-0">
                    <div class="">
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Update Password') }}
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
