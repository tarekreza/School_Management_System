@extends('admin.admin_master')
@section('admin')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Registration Fee</strong></h4>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('student.registration.fee.classwise.get') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Year<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="year_id" required class="form-control">
                                                        <option value="" selected="" disabled="">Select
                                                            Year</option>
                                                        @foreach ($years as $year)
                                                            <option
                                                                value="{{ $year->id }}"{{ @$year_id == $year->id ? 'selected' : '' }}>
                                                                {{ $year->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="class_id" required class="form-control">
                                                        <option value="" selected="" disabled="">Select
                                                            Class</option>
                                                        @foreach ($classes as $class)
                                                            <option
                                                                value="{{ $class->id }}"{{ @$class_id == $class->id ? 'selected' : '' }}>
                                                                {{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top: 25px">
                                            <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search"
                                                value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student List</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    @if (isset($allData) && isset($registration_fee))
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">SL</th>
                                                <th>Name</th>
                                                <th>ID No</th>
                                                <th>Roll</th>
                                                <th>Registration Fee</th>
                                                <th>Discount</th>
                                                <th>Student Fee</th>
                                                <th width="25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allData as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->student->name }}</td>
                                                    <td>{{ $value->student->id_no }}</td>
                                                    <td>{{ $value->roll }}</td>
                                                    <td>{{ $registration_fee->amount }}</td>
                                                    <td>{{ $value->discount->discount }}</td>
                                                    {{-- for calculate total payable registration fee --}}
                                                    @php
                                                        $originalfee = $registration_fee->amount;
                                                        $discount = $value->discount->discount;
                                                        $discounttablefee = ($discount / 100) * $originalfee;
                                                        $finalfee = (float) $originalfee - (float) $discounttablefee
                                                    @endphp
                                                    <td>
                                                        {{ $finalfee }}
                                                    </td>
                                                    <td>
                                                        <a
                                                        href="{{ route('student.registration.fee.payslip', $value->student_id) }}" target="_blank"class="btn btn-success">Fee slip</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">SL</th>
                                                <th>Name</th>
                                                <th>ID No</th>
                                                <th>Roll</th>
                                                <th>Registration Fee</th>
                                                <th>Discount</th>
                                                <th>Student Fee</th>
                                                <th width="25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allData as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->student->name }}</td>
                                                    <td>{{ $value->student->id_no }}</td>
                                                    <td>{{ $value->roll }}</td>
                                                    <td>{{ $registration_fee->amount }}</td>
                                                    <td>{{ $value->discount->discount }}</td>
                                                    {{-- for calculate total payable registration fee --}}
                                                    @php
                                                        $originalfee = $registration_fee->amount;
                                                        $discount = $value->discount->discount;
                                                        $discounttablefee = ($discount / 100) * $originalfee;
                                                        $finalfee = (float) $originalfee - (float) $discounttablefee
                                                    @endphp
                                                    <td>
                                                        {{ $finalfee }}
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('student.registration.fee.payslip', $value->student_id) }}" target="_blank"class="btn btn-success" >Fee slip</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
