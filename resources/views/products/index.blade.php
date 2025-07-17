@extends('layouts.app')

@section('title', __('products.title'))

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center">{{ __('products.title') }}</h1>

        {{-- Filters --}}
        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <div class="row justify-content-center g-2">
                <div class="col-md-4">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">{{ __('products.select_category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                           placeholder="{{ __('products.search_placeholder') }}"
                           value="{{ $search }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('products.search') }}
                    </button>
                </div>
            </div>
        </form>

        {{-- Products grid --}}
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $product->image_url }}" class="card-img-top img-fluid"
                                 alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted small flex-grow-1">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                                <p class="mb-1"><strong>{{ __('products.price') }}:</strong>
                                    ${{ number_format($product->price, 2) }}</p>
                                <p class="mb-2"><strong>{{ __('products.category') }}
                                        :</strong> {{ $product->category->name ?? '-' }}</p>
                                <a href="#" class="btn btn-primary mt-auto w-100">{{ __('products.details') }}</a>
                                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm w-100 mt-2">
                                        🛒 {{ __('cart.add') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        {{ __('products.no_products') }}
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Paginattion with filters --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
