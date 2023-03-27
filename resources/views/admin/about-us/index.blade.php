@extends('layouts.admin')

@section('content')

    <div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    ABOUT US
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif
                    <form action="{{ route('admin.about-us.store') }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">


                            <div class="form-group long">

                            </div>
                            <div class="form-group long">
                                <label for="photo">Image</label>
                                <input type="file"  class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       placeholder="" value="" >
                                <img src="{{ ($aboutUs) ? $aboutUs->image : '' }}" alt="" id="aboutUsImage" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="facebook">Title</label>
                                <input type="text"  class="form-control @error('title') is-invalid @enderror"
                                       id="title"
                                       name="title"
                                       placeholder="" value="{{ ($aboutUs) ? $aboutUs->title : '' }}" >

                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Product">Description</label>
                                <textarea   class="form-control @error('description') is-invalid @enderror"
                                       id="description"
                                       name="description"
                                       placeholder="Description"  cols="10" rows="10">{{ ($aboutUs) ? $aboutUs->description : '' }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                            <div class="form-group long">
                                <label for="facebook">URL</label>
                                <input type="text"  class="form-control @error('url') is-invalid @enderror"
                                       id="url"
                                       name="url"
                                       placeholder="" value="{{ ($aboutUs) ? $aboutUs->url : '' }}" >

                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="twitter">Label</label>
                                <input type="text"  class="form-control @error('label') is-invalid @enderror"
                                       id="label"
                                       name="label"
                                       placeholder="" value="{{ ($aboutUs) ? $aboutUs->label : '' }}" >


                                @error('label')
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


    <section class="about-us">
        <div class="container">
            <div class="about-us-flex">
                <div class="about-us-left reveal active">

                    @if($aboutUs)
                        <img src="{{ asset($aboutUs->image) }}" alt="">
                    @else
                        <img src="{{  asset('images/defaults/logo-palengkesite.png') }}" alt="" >
                    @endif
                </div>
                <div class="about-us-right reveal active">

                    @if($aboutUs)
                        <h3>{{ $aboutUs->title }}</h3>
                           <p>
                               {{ $aboutUs->description }}
                           </p>

                        <a href="{{ $aboutUs->url }}" class="pal-button btn-orange">{{ $aboutUs->label }}</a>
                    @else
                        <h3>WHY CHOOSE US?</h3>
                        <p>
                            PalengkeSite is an e-commerce website for Batangueñoes.
                            Categories including meat, fish, fruits, vegetables, and grocery items are available here.
                            It aims to ease up buying essential goods in a convenient and effective system.

                            PalengkeSite can produce a big impact to the community because it can give customers easy access to buy
                            their groceries and their needs in the market online and can help sellers to recover from financial loss
                        </p>

                        <a href="https://palengkesite.test/contact-us" class="pal-button btn-orange">Contact Us</a>
                    @endif


                </div>
            </div>
        </div>

    </section>


    <script>

        const doc = $(document);
        const dev = {
            onInit: function(){
                dev.previewProfileImage($('#image'));
                dev.previewTitle($('#title'));
                dev.previewDescription($('#description'));
                dev.previewURL($('#url'));
                dev.previewLabel($('#label'));
            },

            previewProfileImage: function (trigger) {
                trigger.change(function () {
                    const file = $(this).get(0).files[0];
                    const image = $('#aboutUsImage');
                    const aboutUsLeft = $('.about-us-left img');
                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(){
                            image.attr("src", reader.result);
                            aboutUsLeft.attr("src", reader.result);

                        };

                        reader.readAsDataURL(file);

                    }
                });
            },
            previewTitle: function (trigger) {
                trigger.change(function () {
                    var self = $(this);
                    if(self.val() !== '' ){
                        var title = $('.about-us-right h3');

                        title.text(self.val());
                    }
                });
            },
            previewDescription: function (trigger) {
                trigger.change(function () {
                    var self = $(this);
                    if(self.val() !== '' ){
                        var description = $('.about-us-right p');

                        description.text(self.val());
                    }
                });
            },
            previewURL: function (trigger) {
                trigger.change(function () {
                    var self = $(this);
                    if(self.val() !== '' ){
                        var url = $('.about-us-right a');

                        url.attr('href', self.val());
                    }
                });
            },
            previewLabel: function (trigger) {
                trigger.change(function () {
                    var self = $(this);
                    if(self.val() !== '' ){
                        var url = $('.about-us-right a');

                        url.text(self.val());
                    }
                });
            },
        }

        doc.ready(function () {
            dev.onInit();
        })
    </script>


@endsection
