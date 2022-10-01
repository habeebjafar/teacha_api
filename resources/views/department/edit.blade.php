
@extends('layout')

@section('dashboard-content')

<h1>  Update Department Form</h1>

@if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('success') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('failed'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


<form action = "{{URL::to('update-department-form')}}/{{$department ->id}}" method = "post">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Update Deparment</label>
    <input value="{{ $department -> department}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name of Department" name="department_name">
  </div>


  
  <button type="submit" class="btn btn-primary">Update Department</button>
</form>


@stop