@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{url('admin/user/update',$entry_to_respond->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Update Patient Information</h4>
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
                                Age
                                *
                            </label>
                            <input class="form-control" name="age" id="registerPassword" value="{{$entry_to_respond->age}}" type="number" required="true" />
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Gender
                                *
                            </label>
                            <div class="d-flex justify-content-center">
                                <div class="m-1"> <input  name="gender" value="Male" @if($entry_to_respond->gender == 'Male')  checked @endif type="checkbox"  /> Male </div>
                                <div class="m-1"> <input  name="gender" value="Female" @if($entry_to_respond->gender == 'Female')  checked @endif     type="checkbox"  /> Female </div>
                                <div class="m-1">  <input  name="gender" value="others"  @if($entry_to_respond->gender == 'others')  checked @endif    type="checkbox"  /> others </div>
                            </div>
                        </div>
                        <div class="form-group has-label">
                            <label>
                                Address
                                *
                            </label>
                            <textarea class="form-control" name="address"   required> {{$entry_to_respond->address}}  </textarea>
                        </div>



                        <div class="card-footer text-right">

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

