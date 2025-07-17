@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover">
                        </div>
                        <div class="col-md-6 d-flex flex-column p-4">
                            <div class="mb-4">
                                <h2 class="fw-bold">{{ $product->name }}</h2>
                                <p class="text-muted">{{ $product->category->name ?? __('Без категории') }}</p>
                                <p class="lead">{{ $product->description }}</p>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-primary">${{ number_format($product->price, 2) }}</h4>
                            </div>

                            <div class="mt-auto">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                    &larr; {{ __('Back to Listing') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
