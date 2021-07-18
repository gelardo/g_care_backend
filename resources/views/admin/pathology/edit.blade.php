@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{url('admin/pathology/update/'.$entry_to_respond->id)}}" method="post">
                @method('PUT')
                @csrf
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Update Pathology info</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group has-label">
                            <label>
                                Name
                            </label>
                            <input class="form-control" name="name" value="{{$entry_to_respond->name}}" type="text" required="true" />
                        </div>

                        <div class="form-group has-label">
                            <label>
                                Price
                            </label>
                            <input class="form-control" name="price" value="{{$entry_to_respond->price}}" type="number" required="true" />
                        </div>

                    </div>

                    <div class="card-footer text-right">

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

