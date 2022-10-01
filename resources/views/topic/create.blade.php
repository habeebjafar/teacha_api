@extends('layout')

@section('dashboard-content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<h1> Create Topic form</h1>

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


<form action="{{URL::to('post-topic-form')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Department :</label>
        <select class="drop-down related-post form-control select_department" name="department" id="select_department">
            <option value="">--Select Department--</option>
            @foreach($departments['data'] as $department)
            <option value="{{ $department->id }}"> {{ $department->department }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Course :</label>
        <select class="drop-down related-post form-control select_course" name="course" id="select_course" >
            <option value="">--Select Course--</option>
          
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Topic</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter topic name" name="topic">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Video URL</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Video URL link" name="video_url">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Icon</label>
        <input type="file" class="form-control" placeholder="Insert subject icon" name="icon" onchange="loadPhoto(event)">
    </div>

    <div>

        <img id="photo" width="100" height="100" />

    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
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

<script type='text/javascript'>
    $(document).ready(function() {

        // Department Change
        $('#select_department').change(function() {

            // Department id
            var id = $(this).val();

            // Empty the dropdown
            $('#select_course').find('option').not(':first').remove();

            // AJAX request 
            $.ajax({
                url: 'get-course-by-department/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {

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

                            $("#select_course").append(option);
                        }
                    }

                }
            });
        });

    });
</script>


@stop