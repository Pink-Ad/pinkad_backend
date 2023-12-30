@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Areas Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Areas</span></li>
                <li><span>Areas Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" action="{{ route('area-management.update',$area->id) }}" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Update Area</h2>
                    </header>
                    <div class="card-body">
                        <div class="row form-group pb-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">City</label>
                                    <select class="form-control" name="city_id" id="formGroupExampleInput" placeholder="">
                                        @foreach ($city as $row)
                                            <option value="{{ $row->id }}" @if($row->id == $area->city_id) selected @endif>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Name</label>
                                    <input name="name" type="text" value="{{ $area->name }}" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Area Code</label>
                                    <input type="text" name="code"  value="{{ $area->code }}" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div>

                            {{-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="formGroupExampleInput">Facebook Page ID</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <footer class="card-footer text-end">
                        <a href="{{ Request::url() }}" class="btn btn-danger"><i class="fas fa-sync"></i> Reset</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Area</button>
                    </footer>
                </section>
            </form>
        </div>


    </div>

@stop
