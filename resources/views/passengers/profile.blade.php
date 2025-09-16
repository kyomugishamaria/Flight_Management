@extends('layouts.passenger')

@section('content')
    <h1 class="mb-4">👤 My Profile</h1>

    <div class="card shadow p-4">
        <p><strong>First Name:</strong> {{ $passenger->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $passenger->last_name }}</p>
        <p><strong>Email:</strong> {{ $passenger->email }}</p>
        <p><strong>Phone:</strong> {{ $passenger->phone_number }}</p>
        <p><strong>Nationality:</strong> {{ $passenger->profile->nationality ?? '-' }}</p>
        <p><strong>Passport No:</strong> {{ $passenger->profile->passport_number ?? '-' }}</p>
    </div>
@endsection
