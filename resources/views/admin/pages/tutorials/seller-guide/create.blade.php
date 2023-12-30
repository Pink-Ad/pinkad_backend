@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Seller Guide Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Tutorial</span></li>
                <li><span>Seller Guide Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            {{-- <form id="form1" class="form-horizontal"> --}}
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">New Video</h2>
                    </header>
                    <form action="{{ route('video-management.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row form-group pb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Title</label>
                                        <input type="text" class="form-control" name="title" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Description</label>
                                        <input type="text" class="form-control" name="description" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInputthumbnail">Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail" id="formGroupExampleInput"thumbnail placeholder="">

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Video</label>
                                        <input type="file" class="form-control" name="video" id="formGroupExampleInput" placeholder="">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <footer class="card-footer text-end">
                            <button type="button" class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Video</button>
                        </footer>
                    </form>
                </section>
            {{-- </form> --}}
        </div>


    </div>

@stop
