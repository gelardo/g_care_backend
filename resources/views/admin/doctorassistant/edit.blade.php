@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{route('edit_doctor_assistant')}}" method="post">
                @csrf
                @method('PUT')
                <div class="card ">
                    @include('admin.layouts.message')
                    <div class="card-header ">
                        <h4 class="card-title">Update Doctor</h4>
                    </div>
                    <input type="hidden" name="id" value="{{$entry_to_respond->id}}">
                    <div class="card-body ">
                        <div class="form-group has-label">
                            <label>
                                Name
                            </label>
                            <input class="form-control" name="name"  value="{{$entry_to_respond->name}}" type="text" required="true" />
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Email
                                *
                            </label>
                            <input class="form-control" name="email" id="registerEmail" value="{{$entry_to_respond->email}}" type="email" required="true" />
                        </div>
                          <div class="form-group has-label">
                            <label>
                                Phone
                                *
                            </label>
                            <input class="form-control" name="phone" id="registerPassword" value="{{$entry_to_respond->phone}}" type="text" required="true" />
                        </div>

                        <div class="form-group has-label">
                            <label>
                                Doctor
                            </label> <br>
                            <select class="selectpicker" id="doctor_ids"  class="form-control"  name="doctor_id"   multiple title="Select Doctor" data-size="7">
                                <option disabled> Select Doctor</option>

                            </select>
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Password
                                *
                            </label>
                            <input class="form-control" name="password" id="registerPassword"   type="password"  />
                        </div>
                        <div class="row">

                            <div class="card-footer text-right">

                                <button type="submit" class="btn btn-primary">Update</button>
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
            }),
            $.ajax({
                type:'get',
                url:'/api/hospital/index',
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {
                    $.each(data.data,function(key,value){
                        $('#hospital_ids').append($('<option>', {
                            value: value.id,
                            text: value.name
                        }));
                    })
                }
            })
        );

    </script>
@endsection

