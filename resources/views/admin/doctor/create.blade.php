@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{url('admin/doctor/store')}}" method="post">
                @csrf
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Add New Doctor</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group has-label">
                            <label>
                                Name
                            </label>
                            <input class="form-control" name="name" placeholder="Enter Doctor Name" type="text" required="true" />
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Phone
                                *
                            </label>
                            <input class="form-control" name="phone" id="registerPassword" placeholder="Phone NUmber....." type="text" required="true" />
                        </div>

                        <div class="form-group has-label">
                            <label>
                                Phone
                                *
                            </label>
                            <input class="form-control" name="speciality_ids[]" id="registerPassword" placeholder="speciality....." type="text" required="true" />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    Start Time
                                </label>
                                   <input type="text" name="start_time" class="form-control timepicker" required value="10/05/2018">

                             </div>

                            <div class="col-md-6">
                                <label>
                                    End Time
                                </label>
                                <input type="text" name="end_time" class="form-control timepicker" required value="10/05/2018">

                            </div>
                        <div>


                      </div>

                    <div class="card-footer text-right">

                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    @endsection

