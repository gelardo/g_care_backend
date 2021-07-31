@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{url('admin/doctor/update',$entry_to_respond->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Update Doctor</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group has-label">
                            <label>
                                Name
                            </label>
                            <input class="form-control" name="name"  value="{{$entry_to_respond->name}}" type="text" required="true" />
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
                                Specialities
                                *
                            </label> <br>
                            <select class="selectpicker" id="speciality_ids"  class="form-control" required name="speciality_ids[]"   multiple title="Select Specialities" data-size="7">
                                <option disabled> Select Specialities</option>

                            </select>
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Hospitals
                                *
                            </label> <br>
                            <select class="selectpicker" id="hospital_ids"  class="form-control" required name="hospital_ids[]"   multiple title="Select Hospitals" data-size="7">
                                <option disabled> Select hospitals</option>

                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    Start Time
                                </label>
                                <input type="text" name="start_time" class="form-control timepicker" required value="{{$entry_to_respond->start_time}}">

                            </div>

                            <div class="col-md-6">
                                <label>
                                    End Time
                                </label>
                                <input type="text" name="end_time" class="form-control timepicker" required value=" {{$entry_to_respond->end_time}}">

                            </div>
                            <div>


                            </div>

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
                url:'/api/speciality/index',
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {
                    $.each(data.data,function(key,value){
                        $('#speciality_ids').append($('<option>', {
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

