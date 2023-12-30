@extends('admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Seller Update Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Sellers</span></li>
                <li><span>Seller Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" action="{{ route('seller-management.update',$seller->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Update Seller</h2>
                    </header>
                        <div class="card-body">
                            <div class="row form-group pb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Name</label>
                                        <input type="text" disabled class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $seller->user->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Contact No.</label>
                                        <input type="tel" class="form-control" name="phone" id="formGroupExampleInput" value="{{ $seller->phone }}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Buisness Logo</label>
                                        <input type="file" class="form-control" name="logo" id="formGroupExampleInput" placeholder="">
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
                                        <input type="tel" class="form-control" name="whatsapp" id="formGroupExampleInput" placeholder="" value="{{ $seller->whatsapp }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Business Name</label>
                                        <input type="text" class="form-control" name="business_name" id="formGroupExampleInput" placeholder="" value="{{ $seller->business_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Business Address</label>
                                        <input type="text" class="form-control" name="business_address" id="formGroupExampleInput" placeholder="" value="{{ $seller->business_address }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Facebook Page</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" name="faecbook_page" placeholder="" value="{{ $seller->faecbook_page }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Instagram Page</label>
                                        <input type="url" class="form-control" id="formGroupExampleInput" placeholder="" name="insta_page" value="{{ $seller->insta_page }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Website URL</label>
                                        <input type="url" class="form-control" id="formGroupExampleInput" placeholder="" name="web_url" value="{{ $seller->web_url }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Featured</label>
                                        <select class="form-control" id="formGroupExampleInput" placeholder="" name="isFeatured">
                                            <option value="0" @if($seller->isFeatured == 1) selected @endif>YES</option>
                                            <option value="1" @if($seller->isFeatured == 0) selected @endif>NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="card-footer text-end">
                            <button class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update Seller</button>
                        </footer>
                    </form>
                </section>
            </form>
        </div>
    </div>

@stop
