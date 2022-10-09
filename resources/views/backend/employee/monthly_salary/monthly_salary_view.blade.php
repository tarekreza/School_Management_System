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
                                <h4 class="box-title">Employee <strong>Monthly Salary</strong></h4>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('employee.monthly.salary.get') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Attendance Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="date"class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-top: 25px">
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
                                <h3 class="box-title">Employee List</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    @if (isset($allData))
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">SL</th>
                                                    <th>Employee Name</th>
                                                    <th>Basic Salary</th>
                                                    <th>Salary This Month</th>
                                                    <th width="25%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allData as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $value['employee_name'] }}</td>
                                                        <td>{{ $value['basic_salary'] }}</td>
                                                        <td>{{ $value['this_month_salary'] }}</td>
                                                        <td>
                                                            {{-- passing value with route : employee_id,date,totalAbsent,this_month_salary --}}
                                                            <a href="{{ route('employee.monthly.salary.payslip',[$value['employee_id'],$getdate,$value['totalAbsent'],$value['this_month_salary']]) }}" target="_blank"class="btn btn-success">Fee
                                                                slip</a>
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
