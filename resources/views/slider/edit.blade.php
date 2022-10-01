@extends('layout')
@section('dashboard-content')
    <h1> Update slider form</h1>

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

    <form action="{{ URL::to('update-slider-form') }}/{{$slider->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1"> Slider title</label>
            <input type="text" value="{{$slider->title}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider title" name="sliderTitle">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1"> Slider WebURL</label>
            <input type="text" value="{{$slider->slider_url}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider web url" name="sliderURL">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> Slider message </label>
            <textarea id="editor1" name="sliderMessage">{{$slider->message}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> Slider Image </label>
            <input type="file" class="form-control" name="sliderImage" onchange="loadPhoto(event)">
            <input hidden type="text" class="form-control" name="sliderImageUpdate" value="{{$slider->image_url}}">
        </div>

        <div class="form-group">
            <img id="photo" height="100" width="100" src="{{$slider->image_url}}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        function loadPhoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@stop