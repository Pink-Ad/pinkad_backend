@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Category Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Categories</span></li>
                <li><span>Category Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" method="POST" action="{{ route('offer-categories.store') }}" class="form-horizontal">
                @csrf
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">New Category</h2>
                    </header>
                    <div class="card-body">
                        <div class="row form-group pb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Category Name</label>
                                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Category Code</label>
                                    <input type="text" class="form-control" name="code" id="formGroupExampleInput" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer text-end">
                        <button type="button" class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Category</button>
                    </footer>
                </section>
            </form>
        </div>


    </div>

@stop
