@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Seller Stalls</h3>

                {{ session()->get('market') }}
                <table class="table table-group-divider">
                    <thead>
                    <tr>
                        <th>Seller</th>
                        <th>Stall No.</th>
                        <th>Section</th>
                        <th>Sqm</th>
                        <th>Location</th>
                        <th>Amount / sqm</th>
                        <th>Rental Fee</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stalls as $stall)
                        <tr>
                            <td> {{ $stall->seller->user->first_name }} {{ $stall->seller->user->last_name }}</td>
                            <td> {{ $stall->stall->number }}</td>
                            <td> {{ $stall->stall->section }}</td>
                            <td> {{ $stall->stall->sqm }}</td>
                            <td> {{ $stall->stall->market->market }}</td>
                            <td> {{ $stall->stall->amount_sqm }}</td>
                            <td> {{ $stall->stall->rental_fee }}</td>
                            <td>
                                @if($stall->contact_of_lease)
                                    <a href="{{ asset( 'public/contracts/' . $stall->contact_of_lease )}}"  target="_blank" class="btn option-btn">
                                        <span class="fa fa-eye"></span> View Contract
                                    </a>
                                @else
                                    <button  class="btn option-btn" data-toggle="modal" data-target="#uploadContract{{$stall->id}}" >  <span class="fa fa-upload"></span> Upload Contract</button>
                                @endif
                            </td>
                            <td>

                                @if( $stall->status == 'pending' &&  $stall->type == 0 )
                                    <form action="{{ route('admin.seller.stalls.approve') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="seller_id" value="{{  $stall->seller->user->id   }}">
                                        <input type="hidden" name="seller_stall_id" value="{{  $stall->id   }}">
                                        <button type="submit" target="_blank" class="btn btn-primary"> Approve</button>
                                    </form>
                                @else
                                    <div>{{ $stall->status }}</div>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal -->
    @foreach($stalls as $stall)
        <div class="modal fade" id="uploadContract{{$stall->id}}" tabindex="-1" role="dialog" aria-labelledby="uploadContractLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadContractLabel">Upload Contract</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form action="{{ route('admin.seller.stalls.upload.contract') }}" method="POST"enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="display: flex; flex-flow:  row wrap">

                                    <div class="form-group short">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ $stall->start_date }}">

                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group short">
                                        <label for="">End Date</label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ $stall->end_date }}">

                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group long">
                                        <label for="">Duration</label>
                                        <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration"  value="{{ $stall->duration }}" readonly>

                                        @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group long">
                                        <label for="">Occupancy Fee</label>
                                        <input type="text" class="form-control @error('occupancy_fee') is-invalid @enderror" name="occupancy_fee" id="occupancy_fee" value="{{ $stall->occupancy_fee }}">

                                        @error('occupancy_fee')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group long">
                                        <label for="">Contract Lease</label>
                                        <input type="file" class="form-control @error('contract_of_lease') is-invalid @enderror" name="contract_of_lease" id="contract_of_lease" >

                                        @error('contract_of_lease')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="seller_stall_id" value="{{  $stall->id   }}">
                                </div>
                                <button  class="btn option-btn" data-toggle="modal" data-target="#uploadModal" >  <span class="fa fa-upload"></span> Upload Contract</button>
                            </form>
                    </div>

                </div>
                <div class="modal-footer">
                    </div>
            </div>
        </div>

    @endforeach

    <script>
        let date_1 = '';
        let date_2 = '';
        const products = {
            initDuration: function( trigger ){
                trigger.change(function () {

                    var self = $(this);
                    if(self.attr('id') == 'end_date'){
                         date_1 = new Date(self.val());
                    }
                    if(self.attr('id') == 'start_date'){
                         date_2 = new Date(self.val());
                    }

                    if(date_1 !== '' && date_2 !== ''){
                    // let difference = date_1.getTime() - date_2.getTime();
                    // let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
                    // $('#duration').val(TotalDays);

                    
                        var months;
                        var result;
                        months = (date_1.getFullYear() - date_2.getFullYear()) * 12;
                        months -= date_2.getMonth();
                        months += date_1.getMonth();

                        result = months <= 0  ? 0 : months;
                        self.closest('form').find('#duration').val(result);
                    }
                });
            },

        };

            $(window).on('load', function(){
           

            products.initDuration($('input[type="date"]'));
        });

    </script>


@endsection


