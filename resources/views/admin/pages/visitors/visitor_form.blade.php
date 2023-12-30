@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Visitor Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Visitors</span></li>
                <li><span>Visitor Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" method="post" action="{{ route('visitor-management.store') }}" class="form-horizontal">
                @csrf
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">New Visitor</h2>
                    </header>
                    <div class="card-body">
                        <div class="row form-group pb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Email</label>
                                    <input type="email" name="email" class="form-control" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Contact No.</label>
                                    <input type="tel" class="form-control" name="phone" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>

                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Whatsapp No.</label>
                                    <input type="tel" class="form-control" name="whatsapp" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Business Name</label>
                                    <input type="text" class="form-control" name="business_name" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Business Address</label>
                                    <textarea class="form-control" rows="3" id="textareaDefault" name="business_address" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4 pb-3">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Facebook Page</label>
                                    <input type="url" class="form-control" id="formGroupExampleInput" name="faecbook_page" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Instagram Page</label>
                                    <input type="url" class="form-control" id="formGroupExampleInput" placeholder="" name="insta_page" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Website Url</label>
                                    <input type="url" class="form-control" id="formGroupExampleInput" placeholder="" name="web_url" required>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Area</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Intrest</label>

                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <footer class="card-footer text-end">
                        <button type="button" class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Visitor</button>
                    </footer>
                </section>
            </form>
        </div>


    </div>

@stop
