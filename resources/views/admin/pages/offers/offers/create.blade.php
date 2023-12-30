@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Offer Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Offers</span></li>
                <li><span>Offer Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" class="form-horizontal">
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">New Offer</h2>
                    </header>
                    <div class="card-body">
                        <div class="row form-group pb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Title</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Description</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Hashtags</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Select Category</label>
                                        <span class="multiselect-native-select">

                                            <div class="btn-group">
                                                <button type="button" class="multiselect dropdown-toggle form-select text-center" style="font-size: 0.9rem" data-bs-toggle="dropdown"  aria-expanded="false">
                                                    <span class="multiselect-selected-text">Category - sub Category</span>
                                                </button>
                                                <div class="multiselect-container dropdown-menu" style="max-height: 200px; overflow: hidden auto;">
                                                    <button type="button" class="multiselect-option dropdown-item" title="Cheese">
                                                        <span class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="cheese">
                                                            <label class="form-check-label">Category 1 - Sub Category 1</label>
                                                        </span>
                                                    </button>
                                                    <button type="button" class="multiselect-option dropdown-item" title="Tomatoes">
                                                        <span class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="tomatoes">
                                                            <label class="form-check-label">Category 1 - Sub Category 2</label>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Is Featured ?</label>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Images</label>

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
