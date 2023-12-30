@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Sellers</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Sellers</span></li>
                <li><span>Seller List</span></li>
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
                                    <a href="{{ route('seller-management.create') }}" class="btn btn-primary btn-md font-weight-semibold btn-py-2 px-4">+ Add Seller</a>
                                </div>
                                <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
{{--                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">--}}
{{--                                        <label class="ws-nowrap me-3 mb-0">Filter By:</label>--}}
{{--                                        <select class="form-control select-style-1 filter-by" name="filter-by">--}}
{{--                                            <option value="all" selected>All</option>--}}
{{--                                            <option value="1">ID</option>--}}
{{--                                            <option value="2">Company Name</option>--}}
{{--                                            <option value="3">Slug</option>--}}
{{--                                            <option value="4">Parent Category</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
{{--                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">--}}
{{--                                        <label class="ws-nowrap me-3 mb-0">Show:</label>--}}
{{--                                        <select class="form-control select-style-1 results-per-page" name="results-per-page">--}}
{{--                                            <option value="12" selected>12</option>--}}
{{--                                            <option value="24">24</option>--}}
{{--                                            <option value="36">36</option>--}}
{{--                                            <option value="100">100</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="col-12 col-lg-auto ps-lg-1">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input type="text" class="search-term form-control" name="search-term" id="search-term" placeholder="Search Seller">
                                            <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-ecommerce-simple table-borderless table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 640px;">

                            <thead>
                            <tr>
                                <th width="3%"><input type="checkbox" name="select-all" class="select-all checkbox-style-1 p-relative top-2" value="" /></th>
                                <th width="8%">ID</th>
                                <th width="15%">Logo</th>
                                <th width="12%">Name</th>
                                <th width="20%">Email</th>
                                <th width="15%">Contact</th>
                                <th width="15%">Status</th>
                                <th width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($seller as $key => $row)
                                    <tr>
                                        <td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
                                        <td>{{ $row->SELL_ID }}</td>
                                        <td><img src="{{ asset('/public/storage/'.$row->logo) }}" style="width:100px; height:100px; border-radius:50%;"></td>
                                        <td><a href="#"><strong>{{ $row->user->name }}</strong></a></td>
                                        <td>{{ $row->user->email }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>
                                            <select id="status_change-{{ $row->id }}" class="form-control" data-id="{{ $row->id }}" onchange="status({{ $row->id }})">
                                                <option @if($row->status == 1) selected @endif value="1">Active</option>
                                                <option @if($row->status == 0) selected @endif value="0">De-Active</option>
                                            </select>
                                        </td>
                                        <td>
                                            <form action="{{ route('delete.seller',$row->id) }}" id="delete-seller-{{ $row->id }}" method="GET">
                                            </form>
                                            <button class="btn btn-danger"  onclick="openDeleteModal({{ $row->id }})" style="padding: 4px 6px;font-size: 12px;"><i class="fas fa-trash"></i></button>
                                            <a class="btn btn-warning" style="padding: 4px 6px;font-size: 12px;" href="{{ route('seller-management.edit',$row->id) }}"><i class="fas fa-pen"></i></a>
                                            <button class="btn btn-primary"   onclick="openViewModal({{ $row->id }})" style="padding: 4px 6px;font-size: 12px;"><i class="fas fa-eye"></i></button>
                                            <div class="modal fade" id="viewModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="verticalCenterTitle">View Seller</h5>
                                                            <button type="button" class="close" onclick="closeViewModal({{ $row->id }})" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <div class="card card-statistics">
                                                                    <div class="card-body p-0">
                                                                        <div class="row no-gutters">
                                                                            <div class="col-xl-3 pb-xl-0 pb-5 border-right">
                                                                                <div class="page-account-profil pt-5">
                                                                                    <div class="profile-img text-center rounded-circle">
                                                                                        <div class="pt-5">
                                                                                            <div class="bg-img m-auto">
                                                                                                <img class="img-fluid" style="width:100px; height:100px; border-radius:50%;" src="{{ asset('/public/storage/'.$row->logo) }}" alt="">
                                                                                            </div>
                                                                                            <div class="profile pt-4">
                                                                                                <h4 class="mb-1">{{ $row->user->name }}</h4>
                                                                                                <p>Seller ID</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="py-3 profile-counter">
                                                                                        <ul class="nav justify-content-center text-center">
                                                                                            <li class="nav-item border-right px-3">
                                                                                                <div>
                                                                                                    <h4 class="mb-0">{{ count($row->shop) }}</h4>
                                                                                                    <p>Shops</p>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="nav-item  px-3">
                                                                                                <div>
                                                                                                    <h4 class="mb-0">20</h4>
                                                                                                    <p>Offers</p>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl-9 col-md-6 col-12 border-t border-right">
                                                                                <div class="page-account-form">
                                                                                    <div class="bg-img m-auto">
                                                                                        <img class="img-fluid" style="width:200px; height:100px;" src="{{ asset('/public/storage/'.$row->coverimage) }}" alt="">
                                                                                    </div>
                                                                                    <div class="form-titel border-bottom p-3">
                                                                                        <h5 class="mb-0 py-2">Seller Details</h5>
                                                                                    </div>
                                                                                    <div class="p-4">
                                                                                        <div class="form-row border-bottom mb-4" >
                                                                                            <div class="col-md-6 mb-3">
                                                                                                <label for="name1">Name: {{ $row->user->name }}</label>
                                                                                            </div>
                                                                                            <div class="col-md-6 mb-3">
                                                                                                <label for="title1">Phone: {{ $row->phone }} </label>
                                                                                            </div>
                                                                                            <div class="col-md-6 mb-3">
                                                                                                <label for="phone1">CNIC: 42201-4501150-3 </label>
                                                                                            </div>
                                                                                            <div class="col-md-6 mb-3">
                                                                                                <label for="phone1">Email: {{ $row->user->email }}</label>
                                                                                            </div>
                                                                                            <div class="col-md-12 mb-3">
                                                                                                <label for="phone1">Address: {{ $row->business_address }}</label>
                                                                                            </div>
                                                                                            <div class="col-md-4 mb-3">
                                                                                                <label class="">Age: 21</label>
                                                                                            </div>
                                                                                            <div class="col-md-4 mb-3">
                                                                                                <label class="">Religion: Islam</label>
                                                                                            </div>
                                                                                            <div class="col-md-4 mb-3">
                                                                                                <label class="">Qualification: Intermediate</label>
                                                                                            </div>
                                                                                            <div class="col-md-4 mb-3">
                                                                                                <label class="">Marital Status: Single</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h5 class="">Account Details</h5>
                                                                                        <div class="form-row">
                                                                                            <div class="col-md-6 mb-3">
                                                                                                <label for="name1">Bank Name: Meezan</label>
                                                                                            </div>
                                                                                            <div class="col-md-6 mb-3">
                                                                                                <label for="title1">Account No:</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" onclick="closeViewModal()">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalCenterTitle">Delete Seller</h5>
                    <button type="button" class="close" onclick="closeDeleteModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeDeleteModal()">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteSeller()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var formId = 0;
        function openDeleteModal(id){
            formId = id;
            $('#deleteModal').modal('show');
        }
        function deleteSeller()
        {
            $("#delete-seller-"+formId).submit();
        }
        function closeDeleteModal(){
            $('#deleteModal').modal('hide');
        }
        function openViewModal(id){
            console.log(id);
            $('#viewModal-'+id).modal('show');
        }
        function closeViewModal(id){
            $('#viewModal-'+id).modal('hide');
        }
    </script>
    <script>
        function status(id) {
            // var id = $('#status_change').attr("data-id");
            var value = $('#status_change-'+id).val();

            var url = "{{ route('admin.seller.status', ['', ''],) }}";
            url = url + '/' + value + '/' + id;
            $.ajax({
                type: 'GET',
                url: url,
            }).done(function(data) {
                successModal(data.message);
                // var id = $('#changeSelect' + value).html('');
                // html = '';
                // var id = $('#changeSelect' + value).html(html);
            });

        }
    </script>
@stop
