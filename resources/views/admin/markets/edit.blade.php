@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Market Information
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <div class="alert alert-{{ ($success) ? 'success' : 'danger' }}"><strong>{{ $message  }}</strong></div>
                    @endif
                    <form action="{{ route('admin.markets.update', [$market->id]) }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                            <div class="form-group long">
                                <label for="market">Market</label>
                                <input type="text"  class="form-control @error('market') is-invalid @enderror"
                                       id="market"
                                       name="market"
                                       placeholder="i.e. Apple" value="{{ $market->market }}" >
                                @error('market')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                        </div>
                        <div class="row-btn">
                            <div class="btn-container" style="padding: 0 10px 15px;">
                                <button type="submit" class="btn btn-primary" style="font-size: 11px; padding: 8px;">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
