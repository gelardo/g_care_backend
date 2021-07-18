@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{url('admin/speciality/store')}}" method="post">
                @csrf
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Add New Speciality</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group has-label">
                            <label>
                                Name
                            </label>
                            <input class="form-control" name="name" placeholder="Enter Speciality Name" type="text" required="true" />
                        </div>

                      </div>

                    <div class="card-footer text-right">

                        <button type="submit" class="btn btn-primary">Create New</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    @endsection

