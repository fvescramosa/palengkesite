@extends('layouts.buyer')

@section('content')


    {{$message ?? ''}}

    <div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Buyer Information
                </div>
                <div class="basic-info-body">
                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif
                    <form action="{{ route('buyer.store') }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                            @if(!auth()->user()->buyer()->exists())

                            <div class="info-item short">
                                    <label for="email">Birthday</label>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday" placeholder="Birthday" value="{{ old('birthday') }}" >
                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item xshort">
                                    <label for="email">Age</label>
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" placeholder="Age" value="{{ old('agen') }}" readonly>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item xshort">
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

                                <div class="info-item short">
                                    <label for="contact">Contact Number</label>
                                    <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="Enter your contact number" value="">
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="stnumber">Street Number</label>
                                    <input type="text" class="form-control @error('stnumber') is-invalid @enderror" id="stnumber" name="stnumber" placeholder="Example: 123" value="">
                                    @error('stnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="stname">Sreet Name</label>
                                    <input type="text" class="form-control @error('stname') is-invalid @enderror" id="stname" name="stname" placeholder="Example: Dalipit East" value="">
                                    @error('stname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="city">City/Municipality</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Example: Alitagtag" value="">
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" placeholder="Example: Batangas" value="">
                                    @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" placeholder="Example: Philippines" value="">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="zip">Zip Code</label>
                                    <input type="number" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" placeholder="Example: 123" value="">
                                    @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            @endif
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
