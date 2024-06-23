@extends('layouts.app')
@section('css-file')
<link rel="stylesheet" href="{{ asset('css/add-to-cart.css') }}">
@endsection
@section('title')
<title>User Cart</title>
@endsection
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- start cart -->
            @php
            $subtotal = 0;
            $subquantity = 0;
            @endphp
            @foreach($cartItems as $cartItem)
            <div class="area d-flex card container m-5" style="width: 35rem;">
                <div class="item-wrapper">
                    <div class="card-body mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6  flex-shrink-0">
                                <img class="p-2" src="{{ asset('storage/' . $cartItem->item->product_image) }}" alt="{{ $cartItem->item->name }}">
                            </div>
                            <div class="col-sm-12 col-lg-6 ">
                                <div class="d-flex flex-column mb-3 flex-grow-1 ms-3  ">
                                    <div class="d-flex">
                                        <h4 class="Fh p-2 w-100">{{ $cartItem->item->name }}</h4>
                                        <h4 class="p-2 flex-shrink-1">{{ $cartItem->item->price }}</h4>
                                    </div>
                                    <div class="pcs p-2">
                                        {{ $cartItem->item->description }}
                                    </div>
                                    <div class="return p-2">
                                        <i class="fa-solid fa-retweet">
                                        </i>
                                        item cannot be exchange or returned
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="p-2 w-100">
                                        <form method="POST" action="{{ route('cart.delete', ['cartItem' => $cartItem->id]) }} ">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-secondary p-2"><i class="fa-solid fa-trash-can"></i> Remove</button>
                                        </form>
                                    </div>

                                    <form method="POST" action="{{ route('cart.update', ['cartItem' => $cartItem->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="p-2 flex-shrink-1 btn-group">
                                            <button type="submit" name="quantity" value="{{ max($cartItem->quantity - 1, 0) }}" class="btn btn-secondary{{ $cartItem->quantity == $cartItem->quantity - 1 ? ' active' : '' }}">-</button>
                                            <button type="submit" name="quantity" value="{{ $cartItem->quantity }}" class="btn btn-secondary active">{{ $cartItem->quantity }}</button>
                                            <button type="submit" name="quantity" value="{{ $cartItem->quantity + 1 }}" class="btn btn-secondary{{ $cartItem->quantity == $cartItem->quantity + 1 ? ' active' : '' }}">+</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $subtotal += $cartItem->quantity * $cartItem->item->price;
                $subquantity += $cartItem->quantity
                @endphp

            </div>
            @endforeach
            <!-- end cart -->
        </div>       
        <div class="col-md-2">
            <div class="Order-summary card container" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Order summary</h5>

                    <div class="Subtotal">
                        <div class="d-flex justify-content-between">
                            <p class="p-2 ">Subtotal({{$subquantity}} item)</p>
                            <p class="p-2 ">EGP {{ $subtotal }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="p-2 ">shipping fee</p>
                            <p class="p-2 ">EGP 35</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="p-2 ">Total</p>
                        <p class="p-2 flex-shrink-1">EGP {{ $subtotal + 35 }}</p>
                    </div>
                    <div class="d-flex justify-content-between">

                    <button type="button" class="btn-l btn-light">
                        Checkout
                        <i class="fa-solid fa-chevron-right"></i>
                        <i class="fa-solid fa-chevron-right"></i>
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
