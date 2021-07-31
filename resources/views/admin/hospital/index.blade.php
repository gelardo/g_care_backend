@extends('admin.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Hospital List</h4>
                    <a href="{{url('admin/hospital/create')}}" class="btn btn-instagram float-right">Add New</a>
                </div>
                <div class="card-body">
                    <div class="toolbar">

                    </div>
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>



                        @foreach($all as $r)
                            <tr>

                                <td>{{$r->name}}</td>
                                <td>{{$r->phone}}</td>
                                <td>{{$r->location}}</td>
                                <td class="text-right">
                                    <a href="{{url('admin/hospital/edit',$r->id)}}" class="btn btn-warning btn-link btn-icon btn-sm "><i class="fa fa-edit"></i></a>
                                    <form action="{{url('admin/hospital/delete/'.$r->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-link btn-icon btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div>
@endsection
