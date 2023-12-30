@extends('admin.layouts.default')

@section('content')

    <header class="page-header page-header-left-inline-breadcrumb">
        <h2 class="font-weight-bold text-6">Salesman Update Form</h2>
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
            <form id="form1" class="form-horizontal" action="{{ route('salesman-management.update',$salesman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Update Salesman</h2>
                    </header>
                        <div class="card-body">
                            <div class="row form-group pb-3">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Name</label>
                                        <input type="text" disabled value="{{ $salesman->user->name }}" class="form-control" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div> --}}
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Email</label>
                                        <input type="text" disabled class="form-control" value="{{ $salesman->user->email }}"  id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Contact No.</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $salesman->phone }}" id="formGroupExampleInput" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Qualification</label>
                                        <select class="form-control mb-3" name="qualification">
                                            <option value="Matriculation" @if($salesman->qualification == "Matriculation") selected @endif>Matriculation</option>
                                            <option value="Intermediate" @if($salesman->qualification == "Intermediate") selected @endif>Intermediate</option>
                                            <option value="Graduation" @if($salesman->qualification == "Graduation") selected @endif>Graduation</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">CNIC No</label>
                                        <input type="text" class="form-control" value="{{ $salesman->cnic }}" id="formGroupExampleInput" name="cnic" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">CNIC</label>
                                        <input type="file" class="form-control" id="formGroupExampleInput" placeholder="" name="cnic_image">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Marital Status</label>
                                        <select class="form-control mb-3" name="marital_status">
                                            <option @if($salesman->qualification == "Single") selected @endif value="Single">Single</option>
                                            <option @if($salesman->qualification == "Married") selected @endif value="Married">Married</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Religion</label>
                                        <select class="form-control mb-3" name="religion">
                                            <option @if($salesman->qualification == "Islam") selected @endif value="Islam">Islam</option>
                                            <option @if($salesman->qualification == "Other") selected @endif value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Work History</label>
                                        <input type="file" class="form-control" id="formGroupExampleInput" placeholder="" name="work_history">
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Passport Size Picture</label>
                                        <input type="file" class="form-control" id="formGroupExampleInput" placeholder="" name="picture">
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Bank Name</label>
                                        <select class="form-control mb-3" name="bank_name">
                                            <option @if($salesman->qualification == "JazzCash") selected @endif value="JazzCash">JazzCash</option>
                                            <option @if($salesman->qualification == "EasyPaisa") selected @endif value="EasyPaisa">EasyPaisa</option>
                                            <option @if($salesman->qualification == "Meezan Bank") selected @endif value="Meezan Bank">Meezan Bank</option>
                                            <option @if($salesman->qualification == "Bank Al Falah") selected @endif value="Bank Al Falah">Bank Al Falah</option>
                                            <option @if($salesman->qualification == "Habib Bank") selected @endif value="Habib Bank">Habib Bank</option>
                                            <option @if($salesman->qualification == "Bank Al-Habib") selected @endif value="Bank Al-Habib">Bank Al-Habib</option>
                                            <option @if($salesman->qualification == "Allied Bank") selected @endif value="Allied Bank">Allied Bank</option>
                                            <option @if($salesman->qualification == "Askari") selected @endif value="Askari">Askari</option>
                                            <option @if($salesman->qualification == "Faysal") selected @endif value="Faysal">Faysal</option>
                                            <option @if($salesman->qualification == "UBL") selected @endif value="UBL">UBL</option>
                                            <option @if($salesman->qualification == "MCB Bank Limited") selected @endif value="MCB Bank Limited">MCB Bank Limited</option>
                                            <option @if($salesman->qualification == "Standard Chartere") selected @endif value="Standard Chartere">Standard Chartered</option>
                                            <option @if($salesman->qualification == "Silk") selected @endif value="Silk">Silk</option>
                                            <option @if($salesman->qualification == "Dubai Islamic") selected @endif value="Dubai Islamic">Dubai Islamic</option>
                                            <option @if($salesman->qualification == "Habib Metropolitan") selected @endif value="Habib Metropolitan">Habib Metropolitan</option>
                                            <option @if($salesman->qualification == "Summit") selected @endif value="Summit">Summit</option>
                                            <option @if($salesman->qualification == "JS") selected @endif value="JS">JS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Bank Account Details (if any)</label>
                                        <input type="text" value="{{ $salesman->bank_account }}" class="form-control" id="formGroupExampleInput" placeholder="" name="bank_account">
                                    </div>
                                </div>
                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Age</label>
                                        <input type="number" class="form-control" id="formGroupExampleInput" placeholder=""  value="{{ $salesman->age }}" name="age">
                                    </div>
                                </div>

                                <div class="col-lg-4 pb-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Address</label>
                                        <textarea class="form-control" rows="3" id="textareaDefault" name="address">{{ $salesman->address }}</textarea>                                </div>
                                </div>

                            </div>
                        </div>
                        <footer class="card-footer text-end">
                            <button type="button" class="btn btn-danger"><i class="fas fa-sync"></i> Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update Salesman</button>
                        </footer>
                </section>
            </form>
        </div>
    </div>

@stop
