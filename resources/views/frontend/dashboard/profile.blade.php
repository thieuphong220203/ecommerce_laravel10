@extends('frontend.dashboard.layouts.master')
@section('content')
    <!--=============================
  DASHBOARD START
==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="dashboard_sidebar">
        <span class="close_icon">
          <i class="far fa-bars dash_bar"></i>
          <i class="far fa-times dash_close"></i>
        </span>
                <a href="{{route('user.dashboard')}}" class="dash_logo"><img src="{{asset('frontend/images/logo.png')}}" alt="logo" class="img-fluid"></a>
                <ul class="dashboard_link">
                    <li><a href="{{route('user.dashboard')}}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
                    <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> Orders</a></li>
                    <li><a href="dsahboard_download.html"><i class="far fa-cloud-download-alt"></i> Downloads</a></li>
                    <li><a href="dsahboard_review.html"><i class="far fa-star"></i> Reviews</a></li>
                    <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
                    <li><a class="active" href="{{route('user.profile')}}"><i class="far fa-user"></i> My Profile</a></li>
                    <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>

                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <li><a href="{{route('logout')}}" onclick="event.preventDefault();this.closest('form').submit();">
                                <i class="far fa-sign-out-alt">
                                </i> Log out</a>
                        </li>
                    </form>
                </ul>
            </div>

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> profile</h3>


                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>Profile</h4>
                                <form action="{{route('user.profile.update')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="wsus__dash_pro_img">
                                                <img src="{{Auth::user()->image ? asset(Auth::user()->image) : asset("frontend/images/ts-2.jpg")}}" alt="img" class="img-fluid w-100">
                                                <input type="file" name="image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-5">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie"></i>
                                                <input type="text" name="name" placeholder="Name" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fal fa-envelope-open"></i>
                                                <input type="email" name="email" placeholder="Email" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                                    </div>
                                </form>


                                <div class="wsus__dash_pass_change mt-2">
                                        <div class="row">
                                            <h4>Update Password</h4>
                                            <form action="{{route('user.profile.update.password')}}" method="POST">
                                                @csrf
                                                <div class="wsus__dash_pass_change mt-2">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-md-6">
                                                            <div class="wsus__dash_pro_single">
                                                                <i class="fas fa-unlock-alt"></i>
                                                                <input type="password" name="current_password" placeholder="Current Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-md-6">
                                                            <div class="wsus__dash_pro_single">
                                                                <i class="fas fa-lock-alt"></i>
                                                                <input type="password" name="password" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="wsus__dash_pro_single">
                                                                <i class="fas fa-lock-alt"></i>
                                                                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button class="common_btn" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
      DASHBOARD START
    ==============================-->
@endsection
