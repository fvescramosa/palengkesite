@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Stalls</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Sqm</th>
                        <th>Section</th>
                        <th>Amount / Sqm</th>
                        <th>Rental Fee</th>
                        <th>Status</th>
                        <th>Rate</th>
                        <th>Coordinates</th>
                        <th>Meter Number</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stalls as $stall)
                        <tr>
                            <td>{{ $stall->number }}</td>
                            <td>{{ $stall->sqm }}</td>
                            <td>{{ $stall->section }}</td>
                            <td>{{ $stall->amount_sqm }}</td>
                            <td>{{ $stall->rental_fee }}</td>
                            <td>{{ $stall->status }}</td>
                            <td>{{ $stall->rate }}</td>
                            <td>{{ $stall->coords }}</td>
                            <td>{{ $stall->meter_num }}</td>
                            <td><a href="{{ route('admin.stalls.edit', $stall->id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.stalls.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i> Create</a>
            </div>
        </div>
    </div>
@endsection
