@extends('layouts.main_layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">
                <h3 class="text-center">Register</h3>
                <form action="/registerSubmit" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="text_username" class="form-label">Email</label>
                        <input type="email" class="form-control bg-dark text-info" id="text_username" name="text_username" required>
                        @error('text_username')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="text_password" class="form-label">Password</label>
                        <input type="password" class="form-control bg-dark text-info" id="text_password" name="text_password" required>
                        @error('text_password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="text_password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control bg-dark text-info" id="text_password_confirmation" name="text_password_confirmation" required>
                        @error('text_password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-secondary w-100">Register</button>
                </form>

                @if(session('registerError'))
                <div class="alert alert-danger mt-3">
                    {{ session('registerError') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection