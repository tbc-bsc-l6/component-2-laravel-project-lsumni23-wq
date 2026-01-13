@extends('layouts.app')

@section('title', 'Profile')
@section('page-title', 'Profile')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8 mx-auto">
            
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
@endsection
