@extends('layouts.app')
@section('style')
<style>

        .navbar-laravel{
            z-index: 999;
        }

        body{
            background: url('/img/home.jpg') no-repeat;
            background-size: cover;
        }
        
        .cover::before{
          content: "";
          width: 100%;
          height: 100%;
          position: absolute;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          background: rgba(0, 0, 0, 0.8);
          z-index: 0;
        }
        body .container{
            position: relative;
            z-index: 1;
        }
        .logo{
           
            padding: 0.1rem;
        }
        .logo img{
            max-width: 18rem;
            max-height: 18rem;
            overflow: hidden;
            border-radius: 100%;
        }
</style>
@endsection
@section('content')
    <div class="cover"></div>
   <div class="container">
        <h1 class="display-4 pt-5  text-center text-white">الاداره العامه للعهد والمخازن</h1>
        <div class="logo text-center">
                <div>
                    <img src="/img/logo.jpg" title="logo" />
                </div>
                <div>
                    <h2 class="display-4 text-white"><bdi>404 الصفحه غير موجوده !!</bdi></h2>
                    <p class="text-white text-text-center" style="font-size:18pt; direction:rtl;">
                        الصفحه التي تحاول الوصول اليها غير موجوده من فضلك تاكد من عنوان الالكتروني ثم حاول مجددا او تاكد من اتصالك بالانترنت
                    </p>
                </div>
            </div>

        </div>
   </div>

@endsection