@extends('admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Salesman Form</h2>
        <div class="right-wrapper">
            <ol class="breadcrumbs">
                <li><span>Dashboard</span></li>
                <li><span>Salesman</span></li>
                <li><span>Salesman Form</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="form1" class="form-horizontal" action="{{ route('salesman-management.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">New Salesman</h2>
                    </header>
                        <div class="card-body">
                            <div class="row form-group pb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="formGroupExampleInput" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="formGroupExampleInput" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Email</label>
                                        <input type="text" class="form-control" name="email" id="formGroupExampleInput" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Contact No.</label>
                                        <input type="text" class="form-control" name="phone" id="formGroupExampleInput" placeholder="" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Qualification</label>
                                        <select class="form-control mb-3" name="qualification" required>
                                            <option value="Matriculation">Matriculation</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Graduation">Graduation</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">CNIC No</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" name="cnic" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">CNIC</label>
                                        <input type="file" class="form-control" id="formGroupExampleInput" placeholder="" name="cnic_image" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Marital Status</label>
                                        <select class="form-control mb-3" name="marital_status" required>
                                            <option>Single</option>
                                            <option>Married</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Religion</label>
                                        <select class="form-control mb-3" name="religion" required>
                                            <option>Islam</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Work History</label>
                                        <input type="file" class="form-control" id="formGroupExampleInput" placeholder="" name="work_history" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Passport Size Picture</label>
                                        <input type="file" class="form-control" id="formGroupExampleInput" placeholder="" name="picture" required>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Bank Name</label>
                                        <select class="form-control mb-3" name="bank_name" required>
                                            <option>JazzCash</option>
                                            <option>EasyPaisa</option>
                                            <option>Meezan Bank</option>
                                            <option>Bank Al Falah</option>
                                            <option>Habib Bank</option>
                                            <option>Bank Al-Habib</option>
                                            <option>Allied Bank</option>
                                            <option>Askari</option>
                                            <option>Faysal</option>
                                            <option>UBL</option>
                                            <option>MCB Bank Limited</option>
                                            <option>Standard Chartered</option>
                                            <option>Silk</option>
                                            <option>Dubai Islamic</option>
                                            <option>Habib Metropolitan</option>
                                            <option>Summit</option>
                                            <option>JS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Bank Account Details (if any)</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="bank_account" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Age</label>
                                        <input type="number" class="form-control" id="formGroupExampleInput" placeholder="" name="age" required>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Address</label>
                                        <textarea class="form-control" rows="3" id="textareaDefault" name="address" required></textarea>                                </div>
                                </div>

                            </div>
                        </div>
                        <footer class="card-footer text-end">
                            <button type="button" class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Salesman</button>
                        </footer>
                </section>
            </form>
        </div>
    </div>

@stop
