@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    User Information
                </div>
                <div class="basic-info-body">

                    <!-- @if(isset($message))
                        <div class="alert alert-{{ ($success) ? 'success' : 'danger' }}"><strong>{{ $message  }}</strong></div>
                    @endif -->
                    <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                            <div class="info-item long">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control"
                                       id="first_name"
                                       name ="first_name"
                                       placeholder="" value="{{ $user->first_name }}" >
                            </div>

                            <div class="info-item long">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control"
                                       id="last_name"
                                       name="last_name"
                                       placeholder="" value="{{ $user->last_name }}" >
                            </div>

                            <div class="info-item long">
                                <label for="email">Email</label>
                                <input type="email" class="form-control"
                                       id="email"
                                       name="email"
                                       placeholder="" value="{{ $user->email }}" >
                            </div>

                            <div class="info-item long">
                                <label for="password">Password</label>
                                <input type="password" class="form-control"
                                       id="password"
                                       name="password"
                                       placeholder="" value="" >
                            </div>

                            @if($user->seller()->exists())
                                <div class="info-item long">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" class="form-control"
                                        id="birthday"
                                        name="birthday"
                                        placeholder="" value="{{ date('m-d-Y', strtotime($user->seller->birthday)) }}" >
                                </div>

                                <div class="info-item long">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control"
                                        id="age"
                                        name="age"
                                        placeholder="" value="{{ $user->seller->age }}" readonly>
                                </div>

                                <div class="info-item long">
                                    <label for="gender">Gender</label>
                                    <select  class="form-control" id="gender" name="gender" placeholder="Gender" value="{{ $user->seller->gender }}" >
                                        <option value="Male"   {{ ( $user->seller->gender == 'Male')   ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ ( $user->seller->gender == 'Female')  ? 'selected' : '' }}>Female</option>
                                        <option value="Others" {{ ( $user->seller->gender == 'Others')  ? 'selected' : '' }}>Others</option>
                                    </select>
                                </div>
                            @endif

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
