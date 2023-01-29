@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Stall Information
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <div class="alert alert-{{ ($success) ? 'success' : 'danger' }}"><strong>{{ $message  }}</strong></div>
                    @endif
                    <form action="{{ route('admin.stalls.update', [$stalls->id]) }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                            <div class="info-item long">
                                <label for="Number">Stall No.</label>
                                <input type="text"  class="form-control @error('number') is-invalid @enderror"
                                       id="number"
                                       name ="number"
                                       placeholder="" value="{{ $stalls->number }}" >

                                </select>
                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="info-item long">
                                <label for="Sqm">Sqm</label>
                                <input type="text"  class="form-control @error('sqm') is-invalid @enderror"
                                       id="sqm"
                                       name="sqm"
                                       placeholder="" value="{{ $stalls->sqm }}" >

                                </select>
                                @error('sqm')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="info-item long">
                                <label for="Amount_Sqm">Amount Sqm</label>
                                <input type="text"  class="form-control @error('amount_sqm') is-invalid @enderror"
                                       id="amount_sqm"
                                       name="amount_sqm"
                                       placeholder="" value="{{ $stalls->amount_sqm }}" >

                                </select>
                                @error('amount_sqm')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="info-item long">
                                <label for="Rental_Fee">Rental Fee</label>
                                <input type="text"  class="form-control @error('rental_fee') is-invalid @enderror"
                                       id="rental_fee"
                                       name="rental_fee"
                                       placeholder="" value="{{ $stalls->rental_fee }}" >

                                </select>
                                @error('rental_fee')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="info-item long">
                                <label for="Section">Section</label>
                                <input type="text"  class="form-control @error('section') is-invalid @enderror"
                                       id="section"
                                       name="section"
                                       placeholder="" value="{{ $stalls->section }}" >

                                </select>
                                @error('section')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="info-item short">
                                <label for="Market">Market</label>


                                <select   class="form-control @error('market') is-invalid @enderror" id="market"
                                         name="market">
                                    @foreach($markets as $market)
                                        <option value="{{ $market->id }}" {{ ($stalls->market->id == $market->id) ? 'selected' : '' }}>
                                            {{ $market->market }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('market')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="info-item long">
                                <label for="image">Image</label>
                                <input type="text"  class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       placeholder="" value="{{ $stalls->image }}" >

                                </select>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="info-item long">
                                <label for="status">Status</label>
                                <input type="text"  class="form-control @error('status') is-invalid @enderror"
                                       id="status"
                                       name="status"
                                       placeholder="" value="{{ $stalls->status }}" >

                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
