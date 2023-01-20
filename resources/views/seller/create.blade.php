@extends('layouts.seller')

@section('content')


    {{$message ?? ''}}

    <div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Seller Information
                </div>
                <div class="basic-info-body">
                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif
                    <form action="{{ route('seller.store') }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                            @if(!auth()->user()->seller()->exists())
                                <div class="form-group info-item ">
                                    <label for="email">Birthday</label>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday" placeholder="Birthday" value="{{ old('birthday') }}" >
                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group info-item ">
                                    <label for="email">Age</label>
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" placeholder="Age" value="{{ old('agen') }}" readonly>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group info-item ">
                                    <label for="email">Gender</label>
                                    <select  class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" placeholder="Gender" value="" >
                                        <option value="Male" {{ ( old('gender') == 'Male')   ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ ( old('gender') == 'Female')  ? 'selected' : '' }}>Female</option>
                                        <option value="Others" {{ ( old('gender') == 'Others')  ? 'selected' : '' }}>Others</option>

                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <select  class="form-control" id="seller_type" name="seller_type" placeholder="" value="" >
                                    <option value="wholesaler">Wholesaler</option>
                                    <option value="retailer">Retailer</option>
                                </select>
                                
                                <select  class="form-control" id="market_id" name="market_id" placeholder="" value="" >
                                    <option value="1">Poblacion</option>
                                    <option value="2">Anilao</option>
                                    <option value="3">Talaga</option>
                                </select>
                            


                            @endif


                            {{--<div class="info-item xshort">
                                <label for="email">Stall No.</label>
                                <select  class="form-control @error('stall') is-invalid @enderror" id="stall" name="stall" placeholder="stall" value="" >
                                    @foreach($stalls as $stall)
                                        <option value="{{ $stall->id }}"> {{ $stall->number }}</option>
                                    @endforeach
                                </select>

                                @error('stall')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="info-item short">
                                <label for="email">Contract of Lease</label>
                                <input type="file" class="form-control @error('contract') is-invalid @enderror" id="contract" name="contract" placeholder="contract" value="{{ old('contract') }}" readonly>
                                @error('contract')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>--}}

                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getAge(dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        $('#birthday').on('change', function () {

            var age = getAge( $(this).val());
            $('#age').val( age );
        })
    </script>
@endsection
