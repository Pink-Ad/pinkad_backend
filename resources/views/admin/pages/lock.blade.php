<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    @include('.admin.includes.head')
</head>
<body>
<!-- start: page -->

<section class="body-sign body-locked">
    <div class="center-sign">
        <div class="panel card-sign">
            <div class="card-body">
                <form action="home">
                    <div class="current-user text-center">
                        <img src="{{ asset('/assets/img/favicon.jpg') }}" class="rounded-circle user-image" />
                        <h2 class="user-name text-dark m-0">User Name</h2>
                        <p class="user-email m-0">user@gmail.com</p>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input id="pwd" type="password" class="form-control form-control-lg" placeholder="Password" />
                            <span class="input-group-text">
										<i class="bx bx-lock"></i>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <p class="mt-1 mb-5">
                                <a href="#">User Name</a>
                            </p>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary pull-right">Unlock</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->
<footer class="row">
    @include('.admin.includes.footer')
</footer>
</body>
</html>
