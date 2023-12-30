@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Settings</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>settings</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="tabs tabs-vertical tabs-left">
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a class="nav-link" data-bs-target="#tab1" href="#tab1" data-bs-toggle="tab"> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab2" href="#tab2" data-bs-toggle="tab">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab3" href="#tab3" data-bs-toggle="tab">User Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab4" href="#tab4" data-bs-toggle="tab">Visitors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab5" href="#tab5" data-bs-toggle="tab">Sellers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab6" href="#tab6" data-bs-toggle="tab">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab7" href="#tab7" data-bs-toggle="tab">Banners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab8" href="#tab8" data-bs-toggle="tab">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab9" href="#tab9" data-bs-toggle="tab">Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab10" href="#tab10" data-bs-toggle="tab">Chats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab11" href="#tab11" data-bs-toggle="tab">Salesman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#tab12" href="#tab12" data-bs-toggle="tab">Finance</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="tab1" class="tab-pane active">
                    <p>Home</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab2" class="tab-pane">
                    <p>Users</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab3" class="tab-pane">
                    <p>User Roles</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab4" class="tab-pane">
                    <p>Visitors</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab5" class="tab-pane">
                    <p>Sellers</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab6" class="tab-pane">
                    <p>Packages</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab7" class="tab-pane">
                    <p>Banners</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab8" class="tab-pane">
                    <p>Categories</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="tab9" class="tab-pane">
                    <p>OFFERS</p>
                    <form class="form-horizontal form-bordered form-bordered" action="#">
                        <div class="form-group row pb-3">
                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Title Words Limit</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Images Allowed</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Description Length</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Offer Validity Days</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2 col-lg-3">Restricted Words</label>
                            <div class="col-lg-6 pb-3">
                                <div class="form-group mb-0 bs-select-1">
                                    <input type="text" class="bs-input" data-role="tagsinput" />
                                </div>
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2 col-lg-3">Enable Featured Offer</label>
                            <div class="col-lg-6 pb-3">
                                <div class="switch switch-sm switch-primary">
                                    <div class="ios-switch on"><div class="on-background background-fill"></div><div class="state-background background-fill"></div><div class="handle"></div></div><input type="checkbox" name="switch" data-plugin-ios-switch="" checked="checked" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <footer class="text-end">
                            <button class="btn btn-primary">Submit </button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </footer>
                    </form>
                </div>
                <div id="tab10" class="tab-pane">
                    <p>CHAT</p>
                    <form class="form-horizontal form-bordered form-bordered" action="#">
                        <div class="form-group row pb-3">
                            <label class="col-lg-3 control-label text-lg-end pt-2" for="textareaDefault">Restricted Message</label>
                            <div class="col-lg-9 pb-3">
                                <input class="form-control" placeholder="Customer Support is only available for premium Sellers." data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-3 control-label text-lg-end pt-2 col-lg-3">Allow Premium Sellers</label>
                            <div class="col-lg-9 pb-3">
                                <div class="switch switch-sm switch-primary">
                                    <div class="ios-switch on"><div class="on-background background-fill"></div><div class="state-background background-fill"></div><div class="handle"></div></div><input type="checkbox" name="switch" data-plugin-ios-switch="" checked="checked" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <footer class="text-end">
                            <button class="btn btn-primary">Submit </button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </footer>
                    </form>
                </div>
                <div id="tab11" class="tab-pane">
                    <p class="text-dark">Salesman</p>
                    <form class="form-horizontal form-bordered form-bordered" action="#">
                        <div class="form-group row pb-3">
                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Seller I Title</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Seller I Comission</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Seller II Title</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Seller II Comission</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Seller III Title</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>

                            <label class="col-lg-4 control-label text-lg-end pt-2" for="textareaDefault">Seller III Comission</label>
                            <div class="col-lg-6 pb-3">
                                <input class="form-control" type="number" data-plugin-maxlength maxlength="50" />
                            </div>
                        </div>
                        <footer class="text-end">
                            <button class="btn btn-primary">Submit </button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </footer>
                    </form>
                </div>
                <div id="tab12" class="tab-pane">
                    <p>Finance</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
            </div>
        </div>
    </div>
@stop
