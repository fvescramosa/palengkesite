@extends('layouts.admin')

@section('content')
<div class="dashboard-flex">
    <!-- display flex -->
        <!-- columns 1 x 3 border: 1px solid #e3e3e3; border-radius:25px; flex: 1 1 33.3333% -->
        <div class="dashboard-column" id="seller-col">
            <span class="icon-dashboard">
                <i class="fa fa-users"></i>
            </span>
            <div class="column-content">
                    <div class="col-left">
                        <h3>Sellers</h3>
                    </div>
                    <div class="col-right">
                        <span class="badge badge-danger">
                            {{ $sellers }}
                        </span>
                    </div>

            </div>

        </div>

        <div class="dashboard-column" id="buyer-col">
            <span class="icon-dashboard">
                <i class="fa fa-users"></i>
            </span>
            <div class="column-content">
                <div class="col-left">
                    <h3>Buyers</h3>
                </div>
                <div class="col-right">
                    <span class="badge badge-danger">
                        {{ $buyers }}
                    </span>
                </div>

            </div>
        </div>
        
        <div class="dashboard-column" id="staff-col">
            <span class="icon-dashboard">
                <i class="fa fa-users"></i>
            </span>
            <div class="column-content">
                <div class="col-left">
                    <h3>Staff</h3>
                </div>
                <div class="col-right">
                    <span class="badge badge-danger">
                    {{ $staff }}
                    </span>
                </div>

            </div>
        </div>

        <div class="dashboard-column" id="appointment-col">
            <span class="icon-dashboard">
                <i class="fa fa-calendar"></i>
            </span>
            <div class="column-content">
                <div class="col-left">
                    <h3>Stall Appointment</h3>
                </div>
                <div class="col-right">
                    <span class="badge badge-danger">
                        {{ $stallappointments }}
                    </span>
            </div>
        </div>

    </div>

        <div class="dashboard-column" id="approval-col">
            <span class="icon-dashboard">
                <i class="fa fa-user-shield"></i>
            </span>
            <div class="column-content">
                    <div class="col-left">
                        <h3>Stall Approval</h3>
                    </div>
                    <div class="col-right">
                        <span class="badge badge-danger">
                            {{ $stallapproval }}
                        </span>
                    </div>

            </div>
        </div>

        <div class="dashboard-column" id="approval-col">
            <span class="icon-dashboard">
                <i class="fa fa-cart-plus"></i>
            </span>
            <div class="column-content">
                    <div class="col-left">
                        <h3>Product Approval</h3>
                    </div>
                    <div class="col-right">
                        <span class="badge badge-danger">
                           {{ $products }}
                        </span>
                    </div>

            </div>
        </div>
        <!-- columns 1 x 3 -->
    <!-- display flex -->

    
</div>
@endsection
