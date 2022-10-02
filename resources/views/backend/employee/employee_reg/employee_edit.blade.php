@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Employee</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('update.employee.registration',$editData->id) }} " enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Employee Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value ="{{ $editData->name }}" name="name"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Father's Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  value ="{{ $editData->fname }}" name="fname"class="form-control"required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Mother's Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  value ="{{ $editData->mname }}" name="mname"class="form-control"required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Mobile Number<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number"  value ="{{ $editData->mobile }}" name="mobile"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Address<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  value ="{{ $editData->address }}" name="address"class="form-control"required>
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
                                                <option value="Male" {{ $editData->gender =="Male"? "selected": "" }}>Male</option>
                                                <option value="Female"{{ $editData->gender =="Female"? "selected": "" }}>Female</option>
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
                                                <option value="Islam" {{ $editData->religion =="Islam"? "selected": "" }}>Islam</option>
                                                <option value="Hindu" {{ $editData->religion =="Hindu"? "selected": "" }}>Hindu</option>
                                                <option value="Christian" {{ $editData->religion =="Christian"? "selected": "" }}>Christian</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Date of Birth<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date"value="{{ $editData->dob }}" name="dob"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Designation<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="designation_id" required class="form-control">
                                                <option value="" selected="" disabled="">Select
                                                    Designation</option>
                                                    @foreach ($designation as $designation)
                                                    <option  value="{{ $designation->id }}" {{ $editData->designation_id ==$designation->id? "selected": "" }} >{{ $designation->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Salary<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="salary" value="{{ $editData->salary }}" class="form-control"required>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Joining Date<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="join_date" value="{{ $editData->join_date }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Profile Picture</h5>
                                        <div class="controls">
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
