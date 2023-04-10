@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                   Category
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif
                    <form action="{{ route('admin.markets.store') }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">



                                <div class="form-group long">
                                    <label for="market">Market</label>
                                    <input type="text"  class="form-control @error('market') is-invalid @enderror"
                                                        id="market"
                                                        name="market"
                                                        placeholder="" value="" >
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
