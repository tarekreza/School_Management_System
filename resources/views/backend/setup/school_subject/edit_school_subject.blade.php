@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit School Subject</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('update.school.subject',$editData->id) }}">
                            @csrf
                                    <div class="form-group">
                                        <h5>School Subject Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name"class="form-control" value="{{ $editData->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
