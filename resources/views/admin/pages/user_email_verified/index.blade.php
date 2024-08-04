@extends('.admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Users</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Users Email Verified</span></li>
                <li><span>Users Email Verified List</span></li>
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

                      

                          <!--  -->
                          <div class="col-4 col-lg-auto ps-lg-1" >
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                    <form action="{{ route('all-user.index') }}" method="GET">
                                        <div class="input-group" >
                                            <input type="text" class="search-term form-control" name="search_term"
                                                id="search-term" placeholder="Search User" style="float:right">
                                            <button class="btn btn-default" type="submit"><i
                                                    class="bx bx-search "></i></button>
                                        </div>
                                </form>
                                    </div>
                                </div>
                            <!--  -->
                    </div>
                </div>
               
              
                <table class="table table-ecommerce-simple table-borderless table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 640px;">
                    <thead>
                    <tr>
                       
                      
                    
                        <th width="12%">Name</th>
                        <th width="20%">Email</th>
                        <th width="15%">Email Verified At</th>
                        <th width="30%">Action</th>
                     
                    </tr>
                    </thead>
                    <tbody id="sellerTable">
                        @foreach ($seller as $key => $row)
                            <tr>
                                
                               
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                                <td>{{ $row->email_verified_at }}</td>
                                <td> 
                                    <a class="btn btn-warning" style="padding: 4px 6px;font-size: 12px;" 
                                    href="{{ route('all-user.edit',$row->id) }}"><i class="fas fa-pen"></i>
                                    </a>
                                </td>
                              
                              
                            </tr>
                        @endforeach

                        </tbody>
                        </table>
                        </form>
                    </div>
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
      
        function openActionModal() {
            $('#actionModal').modal('show');
        }
        function formSubmit()
        {
            $('#action-form').submit();
        }
        function closeActionModal() {
            $('#actionModal').modal('hide');
        }
    </script>
@stop
