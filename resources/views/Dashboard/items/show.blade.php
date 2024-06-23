@extends(auth()->check() && auth()->user()->user_type === 'admin' ? 'layouts.dash' : 'layouts.app')

@section('css-file')
<link rel="stylesheet" href="{{ asset('css/view-product.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashnav.css') }}">
@endsection

@section('title')
<title>Show Product</title>
@endsection

@section('content')
@if(auth()->check() && auth()->user()->user_type === 'admin')
<header>
    <h1>Show Product</h1>
</header>
@endif

<div class="d-flex flex-column flex-md-row nav-left-mobile">
  <!-- Sidebar -->
  @if(auth()->check() && auth()->user()->user_type === 'admin')
  @include('Dashboard.SideNav')
  @endif

  <div class="view-product">
    <div id="container" class="container">
      <div class="row">
        <div class="col-md-6 product-details">
          <h1>{{$items->name}}</h1>
          <div class="control">
            <button class="btn-product">
              <span class="price">{{$items->sale_price}} LE</span>
              <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
              <span class="buy">Add To Cart</span>
            </button>
          </div>
        </div>
        <div class="col-md-6 product-image">
          <img src="{{ asset('storage/' . $items->product_image) }}" alt="{{ $items->name }}">
          <div class="info">
            <h2>Description</h2>
            <ul>
              <li>
                <p class="information">{{$items->description}}</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
