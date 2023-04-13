@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Developer
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif
                    <form action="{{ route('admin.developers.store') }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">


                                <div class="form-group long">

                                </div>
                                <div class="form-group long">
                                    <label for="Product">Name</label>
                                    <input type="text"  class="form-control @error('name') is-invalid @enderror"
                                                        id="name"
                                                        name="name"
                                                        placeholder="" value="" >

                                    </select>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group long">
                                    <label for="facebook">Facebook</label>
                                    <input type="text"  class="form-control @error('facebook') is-invalid @enderror"
                                                        id="facebook"
                                                        name="facebook"
                                                        placeholder="" value="" >

                                    </select>
                                    @error('facebook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group long">
                                    <label for="twitter">Twitter</label>
                                    <input type="text"  class="form-control @error('twitter') is-invalid @enderror"
                                                        id="twitter"
                                                        name="twitter"
                                                        placeholder="" value="" >

                                    </select>
                                    @error('twitter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group long">
                                    <label for="srp">Instagram</label>
                                    <input type="text"  class="form-control @error('instagram') is-invalid @enderror"
                                                        id="instagram"
                                                        name="instagram"
                                                        placeholder="" value="" >

                                    </select>
                                    @error('instagram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            <div class="form-group long">
                                <label for="srp">Linked In</label>
                                <input type="text"  class="form-control @error('linkedin') is-invalid @enderror"
                                       id="linkedin"
                                       name="linkedin"
                                       placeholder="" value="" >

                                @error('linkedin')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group long">
                                <label for="photo">Photo</label>
                                <input type="file"  class="form-control @error('photo') is-invalid @enderror"
                                       id="profile_image"
                                       name="photo"
                                       placeholder="" value="" >
                                <img src="" alt="" id="profileImg" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
                                @error('photo')
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
<script>

    const doc = $(document);
    const dev = {
        onInit: function(){
            dev.previewProfileImage($('#profile_image'));
        },

        previewProfileImage: function (trigger) {
            trigger.change(function () {
                const file = $(this).get(0).files[0];
                const image = $('#profileImg');
                if (file) {
                    var reader = new FileReader();

                    reader.onload = function(){
                        image.attr("src", reader.result);
                    };

                    reader.readAsDataURL(file);

                }
            });
        },
    }

    doc.ready(function () {
        dev.onInit();
    })
</script>

@endsection
