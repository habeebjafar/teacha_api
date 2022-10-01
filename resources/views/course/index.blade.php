@extends('layout')
@section('dashboard-content')

    @if(Session::get('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('deleted') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('delete-failed'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('delete-failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
    <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Courses</h6>
      </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                    <th>  S/N </th>
                    <th> Course </th>
                        <th> Department </th>
                        <th> Icon </th>
                        <th>Actions </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                    <th>  S/N </th>
                    <th> Course </th>
                    <th>  Department </th>
                        <th> Icon </th>
                        <th>Actions </th>
                    </tr>
                    </tfoot>
                    <tbody>
                   

                    @foreach($courses as $course)

                        <tr>
                            <td> {{$sn++}} </td>
                            <td> {{ $course->course}} </td>
                            <!-- <td> {{ !empty($subjectTopic->subject) ? $subjectTopic->subject->subject:''}} </td> -->
                            <td>{{ !empty($course->department) ? $course->department->department : '' }}</td>
                            <td> <img src="{{ $course->icon }}" width="100" height="100" /> </td>
                            <td>
                                <a href="{{ URL::to('edit-course') }}/{{ $course->id }}" class="btn btn-outline-primary btn-sm"> Edit </a>
                                |
                                <a href="{{ URL::to('delete-topic') }}/{{ $course->id }}" class="btn btn-outline-danger btn-sm" onclick="checkDelete()"> Delete </a>
                            </td>

                        </tr>


                    @endforeach



                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

    <script>
        function checkDelete() {
            var check = confirm('Are you sure you want to Delete this?');
            if(check){
                return true;
            }
            return false;
        }
        </script>

@stop

