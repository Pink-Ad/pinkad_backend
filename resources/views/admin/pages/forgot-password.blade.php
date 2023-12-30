<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    @include('.admin.includes.head')
</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <div class="panel card-sign">
            <div class="col-md-6">
                <a href="home" class="logo float-left">
                    <img src="{{ asset('/assets/img/logo-default.png') }}" alt="PinkAd Admin" />
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <p class="m-0">Enter your e-mail below and we will send you reset instructions!</p>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <input name="email" id="email" type="email" placeholder="E-mail" class="form-control form-control-lg" />
                            <button class="btn btn-primary btn-lg" type="submit">Reset!</button>
                        </div>
                    </div>

                    <p class="text-center mt-3">Remembered? <a href="/">Sign In!</a></p>
                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3"><a href="https://pinkad.pk/">PinkAd</a> &copy; Copyright 2023. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->
<footer class="row">
    @include('.admin.includes.footer')
</footer>
</body>
</html>
