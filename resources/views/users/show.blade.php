@extends(auth()->check() && auth()->user()->user_type === 'admin' ? 'layouts.dash' : 'layouts.app')

@section('css-file')
<link rel="stylesheet" href="{{ asset('css/add-product.css') }}">
<link rel="stylesheet" href="{{ asset('css/customer-details.css') }}">
<link rel="stylesheet" href="{{ asset('css/customer-details2.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashnav.css') }}">


@endsection
@section('title')
<title>Show Customer</title>
@endsection
@section('content')
@if(auth()->check() && auth()->user()->user_type === 'admin')
<header>
    <h1>Show Customer</h1>
</header>
@endif
<div class="d-flex nav-left-mobile">
    @if(auth()->check() && auth()->user()->user_type === 'admin')
    @include('Dashboard.SideNav')
    @endif
    <div class="app-content">
        <div class="col-sm-12 col-lg-6">
            <div class="card card-mobile" >
                <div class="row card-body">
                    <h5 class="col-sm-12 col-lg-3 card-title"><img src="{{ asset('img/User.webp') }}" alt=""></h5>
                    <div class="col-sm-12 col-lg-3">
                        <h1 class="card-text">{{$users->name}}</h1>
                        <div class="email">
                            <p>{{$users->email}}</p>
                        </div>
                    </div>
                    <div class="personal-info col-sm-12 col-lg-3">
                        <h3>personal informaion</h3>
                        <div>
                            <p>contact number : <span>{{$users->phone_num}}</span></p>
                            <p> member since : <span>{{$users->created_at}}</span></p>
                        </div>
                    </div>
                    <div class="personal-info col-sm-12 col-lg-2">
                        <h3>Shipping Address</h3>
                        <div>
                            <p>{{$users->address}}</p>
                        </div>

                    </div>

                    <div class="row profile-btns">
                        @if(auth()->check() && auth()->user()->user_type === 'admin')

                        <div class="col text-center">
                            <a href="{{ route('users.edit', $users->id) }}" class="btn btn-submit">Edit</a>
                        </div>
                        @endif

                        <div class="col text-center">
                            <form style="display: inline;" method="POST" action="{{ route('users.destroy', Auth::user()->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-submit " style="background-color: red;">{{ __('Delete User') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
    
                <hr>
                <div class="app-content-actions">
                    <input class="search-bar" placeholder="Search..." type="text">
                    <div class="app-content-actions-wrapper">
                    </div>
                </div>
                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell image">
                            ORDER ID
                            <button class="sort-button">

                            </button>
                        </div>
                        <div class="product-cell category">CREATED<button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button></div>

                        <div class="product-cell price">CUSTOMERS<button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button></div>
                        <div class="product-cell price">TOTAL<button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button></div>
                        <div class="product-cell action">
                            ACTION
                            <button class="sort-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="products-row">
                        <button class="cell-more-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="12" cy="5" r="1" />
                                <circle cx="12" cy="19" r="1" />
                            </svg>
                        </button>
                        <div class="product-cell image">
                            <span>#132158</span>
                        </div>
                        <div class="product-cell category"><span class="cell-label">created</span>2 min ago</div>
                        <div class="product-cell price"><span class="cell-label">customers</span>salma</div>
                        <div class="product-cell price"><span class="cell-label">total</span>25,000</div>
                        <div class="action product-cell action">
                            <button type="button" class="btn btn-success"><i class="fa-solid fa-square-plus"></i></button>
                            <button type="button" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="products-row">
                        <button class="cell-more-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="12" cy="5" r="1" />
                                <circle cx="12" cy="19" r="1" />
                            </svg>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>




</div>




</div>
@endsection
