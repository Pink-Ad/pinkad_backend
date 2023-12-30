@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Banner Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Banner</span></li>
                <li><span>Banner Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" method="POST" action="{{ route('banner-management.update',$banner->id) }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Update Banner</h2>
                    </header>
                    <div class="card-body">
                        <div class="row form-group pb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Select Shop</label>
                                    <select name="shop_id" class="form-control">
                                        @foreach ($shop as $row)
                                            <option  value="{{ $row->id }}" @if($banner->shop_id == $row->id) selected @endif> {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Select Area</label>
                                    <select name="area" class="form-control">
                                        @foreach ($area as $row)
                                            <option  value="{{ $row->id }}" @if($banner->area == $row->id) selected @endif> {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Redirect URL</label>
                                    <input type="url" value="{{ $banner->redirect_url }}" class="form-control" name="redirect_url" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Select Category</label>
                                    <select name="subcat_id" class="form-control">
                                        @foreach ($subcat as $row)
                                            <option  value="{{ $row->id }}"  @if($banner->subcat_id == $row->id) selected @endif>{{ $row->category->name }} -> {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Banner Image</label>
                                    <input type="file" class="form-control" name="image" id="formGroupExampleInput" placeholder="">
                                    <img src="{{ asset('public/storage/'.$banner->image) }}" width="200px"/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <footer class="card-footer text-end">
                        <button class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                        <button class="btn btn-primary"><i class="fas fa-check"></i> Add Category</button>
                    </footer>
                </section>
            </form>
        </div>


    </div>

@stop
