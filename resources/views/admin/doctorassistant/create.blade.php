@extends('admin.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{route('add_doctor_assistant')}}" method="post">
                @csrf
                <div class="card ">
                    @include('admin.layouts.message')
                    <div class="card-header ">
                        <h4 class="card-title">Add New Doctor Assistant</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group has-label">
                            <label>
                                Name
                            </label>
                            <input class="form-control" name="name" placeholder="Enter Assistant Name" type="text" required="true" />
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
                                Doctor
                                *
                            </label> <br>
                            <select class="selectpicker" id="doctor_ids"  class="form-control" required name="doctor_id"   multiple title="Select Doctor" data-size="7">
                                <option disabled> Select Doctor</option>

                            </select>
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Email
                                *
                            </label>
                            <input class="form-control" name="email" id="registerEmail" placeholder="Enter Email" type="email" required="true" />
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Password
                                *
                            </label>
                            <input class="form-control" name="password" id="registerPassword" placeholder="Password" type="password" required="true" />
                        </div>

                      </div>

                    <div class="card-footer text-right">

                        <button type="submit" class="btn btn-primary">Create New</button>
                    </div>
             </div>
             </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).onload(
            $.ajax({
                type:'get',
                url:'/api/doctor/index',
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {
                    $.each(data.data,function(key,value){
                        $('#doctor_ids').append($('<option>', {
                            value: value.id,
                            text: value.name
                        }));
                    })
                }
            })
        );

    </script>
    @endsection

