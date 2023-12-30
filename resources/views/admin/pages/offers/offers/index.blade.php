@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Offers</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Offers</span></li>
                <li><span>Offers List</span></li>

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
                                {{-- <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                    <a href="/offers/form" class="btn btn-primary btn-md font-weight-semibold btn-py-2 px-4">+ Add Offer</a>
                                </div> --}}
                                <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">

                                </div>
                                <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">

                                </div>
                                <div class="col-12 col-lg-auto ps-lg-1">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input type="text" class="search-term form-control" name="search-term"
                                                id="search-term" placeholder="Search Offer">
                                            <button class="btn btn-default" type="submit"><i
                                                    class="bx bx-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('admin.change.action') }}" method="POST" id="action-form">
                            @csrf
                            <table class="table table-ecommerce-simple table-borderless table-striped mb-0"
                                id="datatable-ecommerce-list" style="min-width: 640px;">

                                <thead>

                                    <tr>
                                        <th width="8%"><input type="checkbox" name="select_all"
                                                class="select-all checkbox-style-1 p-relative top-2" value="" required/></th>
                                        {{--                                <th width="5%">ID</th> --}}
                                        <th width="10%">Shop</th>
                                        <th width="20%">Image</th>
                                        <th width="15%">Title</th>
                                        <th width="25%">Description</th>
                                        <th width="10%">Status</th>
                                        <th width="10%" style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post as $key => $row)
                                        <tr>
                                            <td><input type="checkbox" name="offers[]" class="checkbox-style-1 p-relative top-2"
                                                    value="{{ $row->id }}" /></td>
                                            {{--                                        <td>{{ ++$key }}</td> --}}
                                            <td>{{ $row->shop->name }}</td>
                                            <td><img src="{{ asset('/public/storage/' . $row->banner) }}"
                                                    style="width:150px; height:150px;" /></td>
                                            <td><strong>{{ $row->title }}</strong></td>
                                            <td>{{ $row->description }}</td>
                                            <td>
                                                <select id="status_change-{{ $row->id }}" class="form-control"
                                                    data-id="{{ $row->id }}" onchange="status({{ $row->id }})">
                                                    <option @if ($row->status == 1) selected @endif value="1">
                                                        Active</option>
                                                    <option @if ($row->status == 0) selected @endif value="0">
                                                        InActive</option>
                                                    <option @if ($row->status == 2) selected @endif value="2">
                                                        Rejected</option>
                                                </select>

                                            </td>
                                            <td style="text-align: center">
                                                <form action="{{ route('delete.offer', $row->id) }}"
                                                    id="delete-offer-{{ $row->id }}" method="GET">
                                                </form>
                                                <div class="modal fade" id="viewModal-{{ $row->id }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document"
                                                        style="max-width: 1000px">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="verticalCenterTitle">View Offer</h5>
                                                                <button type="button" class="close"
                                                                    onclick="closeViewModal({{ $row->id }})"
                                                                    aria-label="Close">
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
                                                                                        <div
                                                                                            class="profile-img text-center rounded-circle">
                                                                                            <div class="pt-5">
                                                                                                <div class="bg-img m-auto">
                                                                                                    <img class="img-fluid"
                                                                                                        alt="Offer Image">
                                                                                                </div>
                                                                                                <div class="profile pt-4">
                                                                                                    <h4 class="mb-1">
                                                                                                        {{ $row->title }}
                                                                                                    </h4>
                                                                                                    <p>by
                                                                                                        {{ $row->shop->seller->user->name }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="py-3 profile-counter">
                                                                                            <ul
                                                                                                class="nav justify-content-center text-center">
                                                                                                <li
                                                                                                    class="nav-item border-right px-3">
                                                                                                    <div>
                                                                                                        <h4 class="mb-0">
                                                                                                            @if ($row->insights != null)
                                                                                                                {{ $row->insights->views }}
                                                                                                            @else
                                                                                                                0
                                                                                                            @endif
                                                                                                        </h4>
                                                                                                        <p>Views</p>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li class="nav-item  px-3">
                                                                                                    <div>
                                                                                                        <h4 class="mb-0">
                                                                                                            @if ($row->insights != null)
                                                                                                                {{ $row->insights->conversion }}
                                                                                                            @else
                                                                                                                0
                                                                                                            @endif
                                                                                                        </h4>
                                                                                                        <p>Conversion</p>
                                                                                                    </div>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-xl-9 col-md-6 col-12 border-t border-right">
                                                                                    <div class="page-account-form">
                                                                                        <div
                                                                                            class="form-titel border-bottom p-3">
                                                                                            <h5 class="mb-0 py-2">Offer Details
                                                                                            </h5>
                                                                                        </div>
                                                                                        <div class="p-4">
                                                                                            <div
                                                                                                class="form-row border-bottom mb-4">
                                                                                                <div class="col-md-4 mb-3">
                                                                                                    <label
                                                                                                        for="name1">Featured:
                                                                                                        @if ($row->IsFeature == 1)
                                                                                                            Yes
                                                                                                        @else
                                                                                                            No
                                                                                                        @endif
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="col-md-4 mb-3">
                                                                                                    <label
                                                                                                        for="name1">Title:
                                                                                                        {{ $row->title }}</label>
                                                                                                </div>
                                                                                                <div class="col-md-12 mb-3">
                                                                                                    <label
                                                                                                        for="title1">Category:
                                                                                                        {{ $row->category->name }},
                                                                                                        {{-- {{ $row->subcategory->name }} --}}
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="col-md-12 mb-3">
                                                                                                    <label
                                                                                                        for="phone1">Targeted
                                                                                                        Area:
                                                                                                        {{ $row->getarea->name }},
                                                                                                        {{ $row->getarea->city->name }},
                                                                                                        {{ $row->getarea->city->province->name }}</label>
                                                                                                </div>

                                                                                                <div class="col-md-12 mb-3">
                                                                                                    <label
                                                                                                        for="phone1">Decription:
                                                                                                        {{ $row->description }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <h5 class="">Uploaded Details
                                                                                            </h5>
                                                                                            <div class="form-row">
                                                                                                <div class="col-md-6 mb-3">
                                                                                                    <label
                                                                                                        for="name1">Created
                                                                                                        At:
                                                                                                        {{ $row->created_at->diffForHumans() }}</label>
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
                                                                <button type="button" class="btn btn-primary"
                                                                    onclick="closeViewModal({{ $row->id }})">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger" onclick="openDeleteModal({{ $row->id }})"
                                                    style="padding: 6px 8px;font-size: 14px;"><i
                                                        class="fas fa-times"></i></button>
                                                <button class="btn btn-primary" onclick="openViewModal({{ $row->id }})"
                                                    style="padding: 6px 8px;font-size: 14px;"><i
                                                        class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                {{-- </table> --}}
                                <hr class="solid mt-5 opacity-4">
                                <div class="datatable-footer">
                                    <div class="row align-items-center justify-content-between mt-3">
                                        <div class="col-md-auto order-1 mb-3 mb-lg-0">
                                            <div class="d-flex align-items-stretch">
                                                <div class="d-grid gap-3 d-md-flex justify-content-md-end me-4">
                                                    <select class="form-control select-style-1 bulk-action"  name="bulk_action"
                                                        style="min-width: 170px;" required>
                                                        <option value="" selected>Bulk Actions</option>
                                                        <option value="delete">Delete</option>
                                                        <option value="status-active">InActive</option>
                                                    </select>
                                                    <button type="button" onclick="openActionModal()"
                                                        class="bulk-action-apply btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Apply</button>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalCenterTitle">Remove Offer</h5>
                    <button type="button" class="close" onclick="closeDeleteModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput">Reason for Offer Removal</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeDeleteModal()">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteOffer()">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verticalCenterTitle">Action Perform</h5>
                    <button type="button" class="close" onclick="closeActionModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to Perform this action ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeActionModal()">Close</button>
                    <button type="button" class="btn btn-danger" onclick="formSubmit()">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var frmid = 0;

        function openDeleteModal(id) {
            frmid = id;
            $('#deleteModal').modal('show');
        }
        function openActionModal() {
            $('#actionModal').modal('show');
        }
        function closeActionModal() {
            $('#actionModal').modal('hide');
        }
        function formSubmit()
        {
            $('#action-form').submit();

        }

        function deleteOffer() {
            console.log(frmid);
            $("#delete-offer-" + frmid).submit();
        }

        function closeDeleteModal() {
            $('#deleteModal').modal('hide');
        }

        function openViewModal(id) {
            $('#viewModal-' + id).modal('show');
        }

        function closeViewModal(id) {
            $('#viewModal-' + id).modal('hide');
        }
    </script>
    <script>
        function status(id) {
            // var id = $('#status_change').attr("data-id");
            var value = $('#status_change-' + id).val();

            var url = "{{ route('admin.offer.status') }}";
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    offer_id: id,
                    status: value,
                },
            }).done(function(data) {
                successModal(data.message);
                // var id = $('#changeSelect' + value).html('');
                // html = '';
                // var id = $('#changeSelect' + value).html(html);
            });

        }
    </script>
@stop
