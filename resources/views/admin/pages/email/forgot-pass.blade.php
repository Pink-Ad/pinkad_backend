<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    @include('.admin.includes.head')
</head>
<body>
<!-- start: page -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email Address</div>
                  <div class="card-body">
                   @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                           {{ __('A fresh verification link has been sent to your email address.') }}
                       </div>
                   @endif
                   <a href="{{$data['verify_token']}}">Click Here</a>.
               </div>
           </div>
       </div>
   </div>
</div>
<!-- end: page -->
<footer class="row">
    @include('.admin.includes.footer')
</footer>
</body>
</html>
