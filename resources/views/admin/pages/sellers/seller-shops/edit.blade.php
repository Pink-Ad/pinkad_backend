@extends('admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Seller Shop Update Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Seller Shop</span></li>
                <li><span>Seller Shop Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Seller New Shop</h2>
                    </header>
                        <div class="card-body">


                            <div class="row form-group pb-3">
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Seller Name</label>
                                        <select class="form-control" id="formGroupExampleInput" placeholder="" name="isFeatured">
                                            <option value="Seller 1">Seller 1</option>
                                            <option value="Seller 2">Seller 2</option>
                                            <option value="Seller 3">Seller 3</option>
                                            <option value="Seller 4">Seller 4</option>
                                            <option value="Seller 5">Seller 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Branch Name</label>
                                        <input type="text" name="first_name" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Branch Area</label>
                                        <select class="form-control" id="formGroupExampleInput" placeholder="" name="isFeatured">
                                            <option value="Seller 1">Area 1</option>
                                            <option value="Seller 2">Area 2</option>
                                            <option value="Seller 3">Area 3</option>
                                            <option value="Seller 4">Area 4</option>
                                            <option value="Seller 5">Area 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Branch Contact</label>
                                        <input type="tel" class="form-control" name="email" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Cover Image</label>
                                        <input type="file" class="form-control" name="coverimage" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Whatsapp No.</label>
                                        <input type="tel" class="form-control" name="whatsapp" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Branch Address</label>
                                        <input type="text" class="form-control" name="business_address" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="card-footer text-end">
                            <button class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Shop</button>
                        </footer>
                    </form>
                </section>
            </form>
        </div>
    </div>

@stop
