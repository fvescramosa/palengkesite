@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
        <div class="profile-wrapper">


                @if (session('message'))
                    <div class="alert alert-{{ (session('success') ? 'success' : 'danger') }}">
                        <strong>{{ session('message')  }}</strong>
                    </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th>Label</th>
                                <th>Keys</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keys as $key)
                            <tr>
                                <td>{{ $key->label }}</td>
                                <td>{{ $key->key }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $key->id) }}">Edit</a> |
                                    <a href="{{ route('admin.categories.delete', $key->id) }}">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.api.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
