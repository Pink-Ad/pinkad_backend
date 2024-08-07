@extends('admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Users Email Verified  Update Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Users Email Verified</span></li>
                <li><span>Users Email Verified Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
      
            <form id="form1" class="form-horizontal" action="{{ route('all-user.update',$seller->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Update Users Email Verified</h2>
                    </header>
                        <div class="card-body">
                            <div class="row form-group pb-3">
                               
                            <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Users Email Verified</label>
                                        <input type="text"  class="form-control" name="email_verified_at"  id="formGroupExampleInput" placeholder="Users Email Verified" value="{{ $seller->email_verified_at}}">
                                    </div>
                                </div>
                              
                               
                            </div>
                        </div>
                        <footer class="card-footer text-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update User</button>
                        </footer>
                    </form>
                </section>
            </form>
          
        </div>
    </div>

@stop
