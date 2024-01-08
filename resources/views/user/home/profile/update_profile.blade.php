<!DOCTYPE html>
<html>
<head>
  @include('user.css.style')
  <style>
    /* body{
    background: #f7f7ff;
    margin-top:20px;
    } */
    .padding{
        padding-top: 100px;
    }

  </style>
</head>
<body class="sub_page">

    <div class="hero_area">
        <div class="bg-box">
        <img src="frontend/images/hero-bg.jpg" alt="">
        </div>
        <!-- header section strats -->
        @include('user.layout.header')
        <!-- end header section -->
    </div>

    <div class="container padding">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            {{-- error message --}}
                            @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error:</strong> {{Session::get('error_message')}}
                            </div>
                            @endif
                            {{-- success message --}}
                            @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success:</strong> {{Session::get('success_message')}}
                            </div>
                            @endif
                            <div class="card-header">Profile Details</div>
                            <div class="card-body">
                                <div class="d-flex align-item-center justify-content-between mb-2">
                                    <div>
                                    <img class="rounded-circle p-1 bg-primary" src="{{(!empty($profileData->image))
                                        ? url('frontend/user_images/'.$profileData->image):url('frontend/user_images/no_image.jpg')}}" width="110px" height="110px"alt="profile">
                                    <span class="h4 ms-3">{{Auth::guard('web')->user()->name}}</span>
                                    </div>
                                </div>                              
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0">Full Name:</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            <p class="text-muted">{{Auth::guard('web')->user()->name}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0">Email:</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            <p class="text-muted">{{Auth::guard('web')->user()->email}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0">Phone:</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            <p class="text-muted">{{Auth::guard('web')->user()->phone}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0 strong">Address:</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            <p class="text-muted">{{Auth::guard('web')->user()->address}}</p>
                                        </div>
                                    </div>                                                             
                                <hr class="my-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">Update Profile Details</div>
                            {{-- error message --}}
                            @if(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{session('error')}}
                            </div>
                            @endif
                            @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{session('success')}}
                            </div>
                            @endif
                            {{-- error message --}}
                            <form method="POST" action="{{route('user_profile.post')}}" enctype="multipart/form-data">
                                @csrf
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="user_name" class="form-control" value="{{Auth::guard('web')->user()->name}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="user_email" class="form-control" value="{{$profileData->email}}" readonly="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="user_phone" class="form-control" value="{{$profileData->phone}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="user_address" class="form-control" value="{{$profileData->address}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Photo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="form-control" id="user_image" name="user_image" type="file">
                                            </div>
                                        </div>
                                        {{-- <div class="mb-3">
                                            <label for="user_image">Photo</label>
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control" id="user_image" name="user_image" type="file">
                                        </div> --}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <img id="showImage" class="rounded-circle" src="{{(!empty($profileData->image))
                                                ? url('frontend/user_images/'.$profileData->image):url('frontend/user_images/no_image.jpg')}}" width="100px" height="100px" alt="profile">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-8 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        
	</div>
  <!-- footer section -->
  @include('user.layout.footer')
  <!-- footer section -->
  @include('user.js.script')
</body>
</html>