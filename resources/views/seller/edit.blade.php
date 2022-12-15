@extends('layouts.seller')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Basic Information
                </div>
                <div class="basic-info-body">
                     @if(isset($message))
                         <strong>{{ $message  }}</strong>
                     @endif
                    <form action="{{ route('seller.update') }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">
                            <div class="form-group info-item short">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror " id="first_name" name="first_name" placeholder="First Name" value="{{ auth()->user()->first_name }}" >
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group info-item short">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror " id="last_name" name="last_name" placeholder="Last Name" value=" {{ auth()->user()->last_name }}" >
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group info-item short">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value=" {{ auth()->user()->email }}" readonly >
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            @if(auth()->user()->seller()->exists())
                            <div class="form-group info-item short">
                                <label for="email">Birthday</label>
                                <input type="text" class="form-control @error('birthday') is-invalid @enderror " id="birthday" name="birthday" placeholder="Birthday" value="{{ date('m/d/Y', strtotime(auth()->user()->seller->birthday)) }}" >
                                 @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror

                            </div>

                            <div class="form-group info-item xshort">
                                <label for="email">Age</label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" placeholder="Age" value="{{ auth()->user()->seller->age }}" readonly>
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="email">Gender</label>
                                <input type="text" class="form-control @error('gender') is-invalid @enderror " id="gender" name="gender" placeholder="Age" value="{{ auth()->user()->seller->gender }}" >
                                @error('gender')
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
