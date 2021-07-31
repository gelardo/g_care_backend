@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{url('admin/hospital/store')}}" method="post">
                @csrf
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Add New hospital</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group has-label">
                            <label>
                                Name
                            </label>
                            <input class="form-control" name="name" placeholder="Enter hospital Name" type="text" required="true" />
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Phone
                                *
                            </label>
                            <input class="form-control" name="phone" id="" placeholder="Phone NUmber....." type="text" required="true" />
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Location
                                *
                            </label>
                            <input class="form-control" name="location" id="Location" placeholder="Location....." type="text" required="true" />
                        </div>
                        <div class="row">
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Create New</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

