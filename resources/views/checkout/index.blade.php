@extends('layouts.app')

@section('title', __('checkout.title'))

@section('content')
    <div class="container py-5">
        <h2>{{ __('checkout.title') }}</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label">{{ __('checkout.name') }}</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">{{ __('checkout.email') }}</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <h5 class="mt-4">{{ __('checkout.total') }}: ${{ number_format($total, 2) }}</h5>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">{{ __('checkout.submit') }}</button>
            </div>
        </form>
    </div>
@endsection
