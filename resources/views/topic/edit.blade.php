@extends('layout')

@section('dashboard-content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<h1> Update Topic form</h1>

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


<form action="{{URL::to('update-topic-form')}}/{{ $topic->id }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Department :</label>
        <select   class="drop-down related-post form-control select_department_update" name="department" id="select_department_update">
            <option value="">--Select Department--</option>
            @foreach($departments as $department)
            <option value="{{ $department->id }}" @if($department->id == $topic->department_id) selected @endif> {{ $department->department }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Course :</label>
        <select class="drop-down related-post form-control select_course_update" name="course" id="select_course_update" >
            <option value="">--Select Course--</option>

            @foreach($courses as $course)

            <option value="{{ $course->id }}" @if($course->id == $topic->course_id) selected @endif> {{ $course->course }}</option>

            @endforeach
          
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Topic</label>
        <input value="{{ $topic->topic}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter topic name" name="topic">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Video URL</label>
        <input value="{{ $topic -> topic_vd_url}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Video URL link" name="video_url">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Icon</label>
        <input type="file" class="form-control" placeholder="Insert subject icon" name="icon" onchange="loadPhoto(event)">
        <input hidden type="text" value="{{ $topic->icon}}" name="icon_update">
    </div>

    <div>

        <img src="{{ $topic->icon}}" id="photo" width="100" height="100" />

    </div>
    <br>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<script>
    function loadPhoto(event) {
        var reader = new FileReader();

        reader.onload = function() {

            var output = document.getElementById('photo');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);

    }
</script>

<!-- 

<script type='text/javascript'>
    $(document).ready(function() {

        // Department Change
        $('#select_department_update').change(function() {

           

            // Department id
            var id = $(this).val();

            
            // Empty the dropdown
            $('#select_course_update').find('option').not(':first').remove();

            // AJAX request 
            $.ajax({
                url: 'get-course-by-department/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    alert('hello world');

                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        // Read data and create <option >
                        for (var i = 0; i < len; i++) {

                            var id = response['data'][i].id;
                            var course = response['data'][i].course;

                            var option = "<option value='" + id + "'>" + course + "</option>";
                            


                            $("#select_course_update").append(option);
                        }
                    }

                },
                
            });
        });

    });
</script> -->


@stop