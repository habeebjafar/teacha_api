@extends('layout')

@section('dashboard-content')

<h1>  Create Course form</h1>

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


<form action = "{{URL::to('post-course-form')}}" method = "post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
                            <label>Department :</label>
                            <select  class="drop-down related-post form-control" name="department" >
                                <option value="">--Select Department--</option>
                            @foreach($departments as $department)
                    <option value="{{ $department->id }}"> {{ $department->department }}</option>
                @endforeach
                            </select>
                        </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Course</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Course name" name="course">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Icon</label>
    <input type="file" class="form-control"  placeholder="Insert subject icon" name="icon" onchange="loadPhoto(event)">
  </div>

  <div>

  <img id="photo" width="100" height="100"/>
  
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
        function loadPhoto(event){
            var reader = new FileReader();

            reader.onload = function(){

                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            
        }
    
    </script>

@stop