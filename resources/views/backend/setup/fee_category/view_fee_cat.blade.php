@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student Fee List</h3>
                                <a href="{{ route('fee.category.add') }}" style="float: right;"
                                    class="btn btn-rounded btn-success mb-5">Add Student Fee</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">SL</th>
                                                <th>Name</th>
                                                <th width="25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allData as $key => $feeCat)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $feeCat->name }}</td>
                                                    <td>
                                                        <a href="{{ route('fee.category.edit',$feeCat->id) }}"class="btn btn-info">Edit</a>
                                                        <a href="{{  route('fee.category.delete',$feeCat->id)  }}"class="btn btn-danger" id="delete">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
