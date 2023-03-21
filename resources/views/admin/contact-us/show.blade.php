@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th>From</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->from }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ substr($contact->message, 100) }}...</td>
                                <td>
                                    <a href="{{ route('admin.contact-us.find', $contact->id) }}">View</a> |
                                    {{--<a href="{{ route('admin.contact-us.delete', $contact->id) }}">Delete</a>--}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
