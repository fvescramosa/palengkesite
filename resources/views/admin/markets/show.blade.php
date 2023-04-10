@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
        <div class="profile-wrapper">

                        <h3>Market Information</h3>

                @if (session('message'))
                    <div class="alert alert-{{ (session('success') ? 'success' : 'danger') }}">
                        <strong>{{ session('message')  }}</strong>
                    </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th>Market</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($markets as $market)
                            <tr>
                                <td>{{ $market->market }}</td>
                                <td>
                                    <a href="{{ route('admin.markets.edit', $market->id) }}">Edit</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.markets.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
