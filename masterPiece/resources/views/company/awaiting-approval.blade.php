@extends('layouts.app')

@section('title', 'Account Pending Approval')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="padding: 40px;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Awaiting Approval') }}</div>

                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-clock fa-4x text-warning"></i>
                        </div>

                        <h3>Your company account is waiting for admin approval</h3>

                        <p class="text-muted my-4">
                            Thank you for registering your company. Our admin team is currently reviewing your information.
                            Once approved, you will have full access to the company dashboard where you can post internship
                            opportunities and manage applications.
                        </p>

                        <p class="mb-0">
                            This process usually takes 1-2 business days. You will be notified by email when your account is
                            approved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
