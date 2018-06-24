<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>المخازن العامه</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <style>
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
              width: 18rem;
              height: 18rem;
              overflow: hidden;
              border-radius: 100%;
              padding: 0.1rem;
              border: 1px solid #f3f3f3;
              margin: auto;
          }
          .logo img{
              border-radius: 100%;
              width: 100%;
              height: 100%;
          }
          .modal-backdrop{
              z-index: 0 !important;
          }
      </style>
    </head>
    <body>
        <div class="cover"></div>
        <div class="container">
            <div class="content pt-5">
                <h1 class="display-4 pt-5  text-center text-white">الاداره العامه للعهد والمخازن</h1>
                <div class="logo">
                    <img src="/img/logo.jpg" title="logo" />
                </div>

                <div class="bottons text-center mt-4">
                    @if (Route::has('login'))
                    @auth
                        <a class="btn btn-outline-success" href="{{ url('/dashboard') }}">لوحه التحكم</a>
                    @else
                        <a class="btn btn-outline-success" href="{{ route('login') }}">تسجيل الدخول</a>
                    @endauth

                    @endif
                    <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#modalCove">اصحاب العهد</a>
                </div>
            </div>

            <div class="modal fade" id="modalCove" tabindex="-1" role="dialog" aria-labelledby="modalCove">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center" id="myModalLabel">اصحاب العهد</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="covenant" action="/employee" method="POST">
                                @csrf
                               
                                <div class="form-group">
                                    <input name="ssn" autocomplete="off" style="direction:rtl;" class="form-control" placeholder="الرقم القومي"> 
                                </div>                            
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button form="covenant" type="submit" type="button" class="btn btn-outline-primary">ارسال</button>
                        </div>
                    </div>
                </div>
            </div>

                
        </div>
        
        <script src="{{ asset('js/app.js') }}" ></script>
        <script src="/res/js/jquery.js"></script>
        <script src="/res/js/jquery-ui.min.js"></script>
        <script src="/js/sweetalert.js"></script>
        <script>
            $('body,html').height($(window).height());    
            
            if(window.location.hash == '#not-found'){
                swal({
                    'text':'لا توجد عهد لهذا الموظف ',
                    'icon':'warning',
                });
            }
         </script>
    </body>
</html>
