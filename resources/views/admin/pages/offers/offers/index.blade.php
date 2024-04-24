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
                                
                                <div class="col-6 col-lg-8 ps-lg-1 mb-3 mb-lg-0">
                                    <div>
                                        <form type="GET" action="{{ route('filter.offers') }}" class="d-flex align-items-lg-center flex-column flex-lg-row">
                                            @csrf
                                            <label class="ws-nowrap me-3 mb-0"><i class="bx bx-filter-alt" style="font-size:24px;color:#96207a"></i></label>
                                            <select class="form-control select-style-1 filter-by" name="filter_id">
                                                <option value="1">active</option>
                                                <option value="2">rejected</option>
                                                <option value="0">inactive</option>
                                                <option value="4" selected>All</option>
                                            </select>
                                            <button type="submit" class="ml-2 btn btn-primary">Filter Offers</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-4 col-lg-auto ps-lg-1" >
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group" >
                                            <input type="text" class="search-term form-control" name="search-term"
                                                id="search-term" placeholder="Search Offer" style="float:right">
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
                                        <th><input type="checkbox" name="select_all" class="select-all checkbox-style-1 p-relative top-2" value="" required/></th>
                                        <th>Shop</th>
                                        <th>Image</th>
                                          <th>Status</th>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                     
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($posts as $key => $row)
                                  
                                  <tr>
                                      <td><input type="checkbox" name="offers[]" class="checkbox-style-1 p-relative top-2"
                                              value="{{ $row['id'] }}" /></td>
                                      {{-- <td>{{ ++$key }}</td> --}}
                                      <td>{{ $row['shop_name'] ?? 'N/A' }}</td>
                                      <td>
                                          @if ($row['banner'])
                                              <img src="{{ asset('/public/storage/' . $row['banner']) }}"
                                                  style="width:150px; height:150px;" />
                                          @else
                                              No Image
                                          @endif
                                      </td>
                                       <td>
                                          <select id="status_change-{{ $row['id'] }}" class="form-control"
                                              data-id="{{ $row['id'] }}" onchange="status({{ $row['id']}})">
                                              <option @if ($row['status'] == 1) selected @endif value="1">
                                                  Active</option>
                                              <option @if ($row['status'] == 0) selected @endif value="0">
                                                  InActive</option>
                                              <option @if ($row['status'] == 2) selected @endif value="2">
                                                  Rejected</option>
                                          </select>
                                      </td>
                                      <td>{{ $row['status'] }}</td>
                                      <td><strong>{{ $row['title'] }}</strong></td>
                                      <td>{{$row['description'] }}</td>
                                     
                                      <td style="text-align: center">
                                          {{-- Your modal and action buttons --}}
                                          <button class="btn btn-danger" onclick="openDeleteModal({{ $row['id'] }})"
                                                  style="padding: 6px 8px;font-size: 14px;"><i class="fas fa-times"></i></button>
                                          <button class="btn btn-primary" onclick="openViewModal({{ $row['id'] }})"
                                                  style="padding: 6px 8px;font-size: 14px;"><i class="fas fa-eye"></i></button>
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
                                                        <option value="status-active">Active</option>
                                                        <option value="status-inactive">InActive</option>
                                                        <option value="status-reject">Reject</option>
                                                        <option value="promote">Promote</option>
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
