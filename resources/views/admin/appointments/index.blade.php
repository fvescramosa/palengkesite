@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Stall Appointment</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Seller</th>
                        <th>Stall No.</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->seller->user->first_name }} {{ $appointment->seller->user->last_name }}</td>
                            <td> {{ $appointment->stall->number }}</td>
                            <td> {{ $appointment->date }}</td>
                            <td> {{ $appointment->status }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <form action="{{ route('admin.appointments.approve') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{  $appointment->id   }}">
                                        <button type="submit" target="_blank" class="btn btn-primary"> Approve</button>
                                    </form>
                                @else
                                    <div>{{ $appointment->status }}</div>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
