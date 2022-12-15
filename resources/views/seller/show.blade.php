@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
            @foreach($sellers as $seller)
                <tr>
                    <td>{{ $seller->user->first_name }}</td>
                    <td>{{ $seller->birthday }}</td>
                    <td>{{ $seller->gender }}</td>
                    <td>{{ $seller->age }}</td>
                    <td><a href="{{ route('seller.edit', $seller->id) }}">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
