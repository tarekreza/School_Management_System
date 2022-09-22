@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add Student</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('store.student.registration') }} " enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Student Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Father's Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="fname"class="form-control"required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Mother's Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="mname"class="form-control"required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Mobile Number<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="mobile"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Address<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="address"class="form-control"required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Gender<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="gender" id="gender" required class="form-control">
                                                <option value="" selected="" disabled="">Select
                                                    Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Religion<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="religion" id="religion" required class="form-control">
                                                <option value="" selected="" disabled="">Select
                                                    Religion</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Christian">Christian</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Date of Birth<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="dob"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Discount<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="discount"class="form-control"required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Year<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="year_id" required class="form-control">
                                                <option value="" selected="" disabled="">Select
                                                    Year</option>
                                                    @foreach ($years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Class<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="class_id" required class="form-control">
                                                <option value="" selected="" disabled="">Select
                                                    Class</option>
                                                    @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Group<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="group_id" required class="form-control">
                                                <option value="" selected="" disabled="">Select
                                                    Group</option>
                                                    @foreach ($groups as $group)
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Shift<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="shift_id" required class="form-control">
                                                <option value="" selected="" disabled="">Select
                                                    Shift</option>
                                                    @foreach ($shifts as $shift)
                                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Profile Picture</h5>
                                        <div class="controls">
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
