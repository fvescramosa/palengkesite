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
                        <th>sqm</th>
                        <th>Section</th>
                        <th>Amount / sqm</th>
                        <th>Rental Fee</th>
                        <th>Status</th>
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
