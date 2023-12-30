@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Seller Guide</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Tutorials</span></li>
                <li><span>Seller Guide</span></li>
            </ol>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col">
            <div class="card card-modern card-modern-table-over-header">
                <div class="card-body">
                    <div class="datatables-header-footer-wrapper">
                        <div class="datatable-header">
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                    <a href="{{ route('video-management.create') }}" class="btn btn-primary btn-md font-weight-semibold btn-py-2 px-4">+ Add Video</a>
                                </div>
                                <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">

                                </div>
                                <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">

                                </div>
                                <div class="col-12 col-lg-auto ps-lg-1">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input type="text" class="search-term form-control" name="search-term" id="search-term" placeholder="Search Seller Guide">
                                            <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-ecommerce-simple table-borderless table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 640px;">
                            <thead>
                                <tr>
                                    <th width="5%"><input type="checkbox" name="select-all" class="select-all checkbox-style-1 p-relative top-2" value="" /></th>
                                    <th width="8%">ID</th>
                                    <th width="20%">Video</th>
                                    <th width="20%">Title</th>
                                    <th width="30%">Description</th>
                                    <th width="30" style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($video as $key => $row)
                                    <tr>
                                        <td></td>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <video loop autoplay muted style="width:200px; height:150px;">
                                                <source src="{{asset('public/storage/'.$row->video)}}" type="video/mp4">

                                                Your browser does not support HTML video.
                                            </video>
                                        </td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>
                                            {{-- <form action="{{ route('video-management',$row->id) }}" id="delete-visitor-{{ $row->id }}" method="GET">
                                            </form> --}}
                                            <button class="btn btn-danger" onclick="openDeleteModal({{ $row->id }})" style="padding: 4px 6px;font-size: 12px;"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-warning" style="padding: 4px 6px;font-size: 12px;"><i class="fas fa-pen"></i></button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="solid mt-5 opacity-4">
                        <div class="datatable-footer">
                            <div class="row align-items-center justify-content-between mt-3">
                                <div class="col-md-auto order-1 mb-3 mb-lg-0">
                                    <div class="d-flex align-items-stretch">
                                        <div class="d-grid gap-3 d-md-flex justify-content-md-end me-4">
                                            <select class="form-control select-style-1 bulk-action" name="bulk-action" style="min-width: 170px;">
                                                <option value="" selected>Bulk Actions</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <a href="ecommerce-orders-detail.html" class="bulk-action-apply btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Apply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-auto text-center order-3 order-lg-2">
                                    <div class="results-info-wrapper"></div>
                                </div>
                                <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                    <div class="pagination-wrapper"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalCenterTitle">Delete Banner</h5>
                    <button type="button" class="close" onclick="closeDeleteModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeDeleteModal()">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openDeleteModal(){
            $('#deleteModal').modal('show');
        }
        function closeDeleteModal(){
            $('#deleteModal').modal('hide');
        }
    </script>
@stop
