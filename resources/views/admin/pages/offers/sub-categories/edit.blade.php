@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Sub Category Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Sub Categories</span></li>
                <li><span>Sub Category Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" method="POST" action="{{ route('offer-sub-categories.update',$subcat->id) }}" class="form-horizontal">
                @csrf
                @method('PUT')
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Update Sub-Category</h2>
                    </header>
                    <div class="card-body">
                        <div class="row form-group pb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Category Name</label>
                                    <select name="category_id"  class="form-control" id="formGroupExampleInput" required>
                                        <option>-- Select Category --</option>
                                        @foreach ($cat as $row)
                                            <option value="{{ $row->id }}" @if($row->id == $subcat->category_id) selected @endif>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Sub Category Name</label>
                                    <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $subcat->name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Sub Category Code</label>
                                    <input type="text" name="code" class="form-control" id="formGroupExampleInput" placeholder="" value="{{ $subcat->code }}" required>
                                </div>
                            </div>

                            {{-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Hashtags</label>
                                    <input type="text" class="bs-input" data-role="tagsinput" />
                                </div>
                            </div> --}}


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
