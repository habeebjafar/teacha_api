@extends('layout')

@section('dashboard-content')

<h1>  Update Course form</h1>

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


<form action = "{{URL::to('update-course-form')}}/{{ $course->id}}" method = "post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
                            <label>Department :</label>
                            <select  class="drop-down related-post form-control" name="department" >
                                <option value="">--Select Department--</option>
                            @foreach($departments as $department)
                    <option value="{{ $department->id }}" @if( $department->id == $course->department_id ) selected @endif> {{ $department->department }}</option>
                @endforeach
                            </select>
                        </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Course</label>
    <input value="{{ $course->course}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Course name" name="course">
   

</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Icon</label>
    <input type="file" class="form-control"  placeholder="Insert subject icon" name="icon" onchange="loadPhoto(event)">
    <input hidden type="text" value="{{ $course->icon}}" name="icon_update">
</div>

  <div>

  <img src="{{ $course->icon}}" id="photo" width="100" height="100"/>
  
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Update</button>
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