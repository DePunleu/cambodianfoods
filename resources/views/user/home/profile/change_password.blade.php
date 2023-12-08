<!DOCTYPE html>
<html>
<head>
@include('user.css.style')
<style>
    /* body{
    background: #f7f7ff;
    margin-top:20px;
    } */
    .pass_show{
        position: relative} 
    .pass_show .ptxt { 
    position: absolute; 
    top: 50%; 
    right: 10px; 
    z-index: 1; 
    color: #f36c01; 
    margin-top: -10px; 
    cursor: pointer; 
    transition: .3s ease all; 
    } 
    .pass_show .ptxt:hover{
        color: #333333;
    } 
    .form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fef5f5;
        border-radius: 10px;
        width: 500px;
        margin-left: auto;
        margin-right: auto; 
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
    <div class="form-container mt-3">
        <div class="card">
        <div class="card-header text-center">
        Change Password
        </div>
        <br>
        
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('error') }}
                </div>
            @endif
                <form action="{{ route('user.update-password') }}" method="POST">
                    @csrf
                    <div class="col-sm-12">
                        <label for="oldPasswordInput">Current Password</label>
                        <div class="form-group pass_show"> 
                            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                            placeholder="Current Password"> 
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                        <label for="newPasswordInput">New Password</label>
                        <div class="form-group pass_show"> 
                            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror 
                        </div> 
                        <label  for="confirmNewPasswordInput">Confirm Password</label>
                        <div class="form-group pass_show"> 
                            <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                    placeholder="Confirm New Password"> 
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark rounded-pill py-2 btn-block">
                                SAVE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- footer section -->
{{-- @include('user.layout.footer') --}}
<!-- footer section -->
@include('user.js.script')
<script>
    $(document).ready(function(){
    $('.pass_show').append('<span class="ptxt">Show</span>');  
    });
    $(document).on('click','.pass_show .ptxt', function(){ 
    $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
    $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
});  
</script>
</body>
</html>