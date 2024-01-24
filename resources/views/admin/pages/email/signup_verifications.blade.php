<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    @include('.admin.includes.head')
    <style>
        .orange-text {
            color: orange;
        }

        .black-text {
            color: black;
        }

        .smaller-font {
            font-size: 90%; /* Adjust the percentage as needed */
        }

        .bg-lightblue {
            background-color: lightblue;
        }

        .black-checkbox {
            background-color: black;
        }

        .checkbox-text {
            display: inline-block;
            margin-left: 10px;
        }
    </style>

</head>
<body>
<!-- start: page -->

<!-- old section -->
<!-- <div class="container">
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
</div> -->
<!-- old section -->
<!-- new section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="orange-text">Bitly</h1>
                    <br>
                    <h2 class="lead black-text">Welcome to Bitly!</h2>
                </div>
                <br>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <p class="smaller-font">We are happy to have you on board.</p>
                    <br>
                    <p class="smaller-font">Here are some great steps to take...</p>
                    <br>

                    @if(isset($data['verify_token']))
                    <div class="bg-lightblue text-center p-3">
                    <h2 class="black-text mb-4">Bitly 101 Checklist</h2>
                    <ul class="list-unstyled">
                        <li class="black-checkbox">
                            <input type="checkbox" class="form-check-input" id="checkbox1">
                            <label for="checkbox1" class="checkbox-text">Checkbox 1: Your first step.</label>
                        </li>
                        <li class="black-checkbox">
                            <input type="checkbox" class="form-check-input" id="checkbox2">
                            <label for="checkbox2" class="checkbox-text">Checkbox 2: Create a Bitlink from any URL.</label>
                        </li>
                        <li class="black-checkbox">
                            <input type="checkbox" class="form-check-input" id="checkbox3">
                            <label for="checkbox3" class="checkbox-text">Checkbox 3: Another important step.</label>
                        </li>
                        <li class="black-checkbox">
                            <input type="checkbox" class="form-check-input" id="checkbox4">
                            <label for="checkbox4" class="checkbox-text">Checkbox 4: Yet another step.</label>
                        </li>
                        <li class="black-checkbox">
                            <input type="checkbox" class="form-check-input" id="checkbox5">
                            <label for="checkbox5" class="checkbox-text">Checkbox 5: Final step.</label>
                        </li>
                    </ul>
            </div>

                    @endif

                    <br>
                    <p>Continue with the remaining steps...</p>
                    <!-- <a href="{{$data['verify_token']}}" class="btn btn-primary">Click Here to Verify Your Email</a> -->
                    <a href="https://app.pinkad.pk/email-verified" class="btn btn-primary">Click Here to Verify Your Email</a>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- new section -->
<!-- end: page -->
<footer class="row">
    @include('.admin.includes.footer')
</footer>
</body>
</html>
