@extends('layouts.app')

@section('title', __('cart.title'))

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">🛒 {{ __('cart.title') }}</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (empty($cart))
            <div class="alert alert-info">{{ __('cart.empty') }}</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>{{ __('cart.product') }}</th>
                        <th>{{ __('cart.quantity') }}</th>
                        <th>{{ __('cart.price') }}</th>
                        <th>{{ __('cart.subtotal') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td>
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" width="50">
                                {{ $item['name'] }}
                            </td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">
                                        {{ __('cart.remove') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h4 class="text-end">{{ __('cart.total') }}: ${{ number_format($total, 2) }}</h4>
            </div>
        @endif

        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mt-3">
            &larr; {{ __('cart.back') }}
        </a>
    </div>
@endsection
