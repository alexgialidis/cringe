@extends('layout')

@section('content')

<div class="container">
    <div class="row">

        <div class ="col-md-10 col-md-offset-2">
            <div>
                <div class="panel-heading">
                    <h3>My Profile</h3>
                </div>
                <div class="panel-body">
                    <div class="row">


                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>First Name:</td>
                                        <td>{{ $provider->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Name:</td>
                                        <td>{{ $provider->surname }}</td>
                                    </tr>
                                    <tr>
                                        <td>A.F.M.</td>
                                        <td>{{ $provider->afm }}</td>
                                    </tr>
                                    <tr>
                                        <td>Company Name</td>
                                        <td>{{ $provider->company }}</td>
                                    </tr>
                                    <tr>
                                        <td>Company Address</td>
                                        <td>{{ $provider->city }}, {{ $provider->address }} {{ $provider->number }}</td>
                                    </tr>
                                        <tr>
                                            <td>Zip</td>
                                            <td>{{ $provider->zip }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $provider->email }}</td>
                                        </tr>


                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@if ({{ Auth::guard('provider')->user()->lock }}== "0")
<form action="/events/create">
<button type="link" class="btn btn-primary btn-lg center-block">Create Event</button>
</form>
@else
    <p><strong>You are locked. Contact with cringeTeam.</strong></p>
@endif


@endsection
