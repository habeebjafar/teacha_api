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
            <h6 class="m-0 font-weight-bold text-primary">All Topics</h6>
      </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                    <th>  S/N </th>
                    <th>Topic</th>
                    <th> Course </th>
                        <th> Department </th>
                        <th> Icon </th>
                        <th>Actions </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                    <th>  S/N </th>
                    <th>Topic</th>
                    <th> Course </th>
                    <th>  Department </th>
                        <th> Icon </th>
                        <th>Actions </th>
                    </tr>
                    </tfoot>
                    <tbody>
                   

                    @foreach($topics as $topic)

                        <tr>
                            <td> {{$sn++}} </td>
                            <td> {{ $topic->topic}} </td>
                            <td> {{ !empty($topic->course) ? $topic->course->course:''}} </td>
                            <td>{{ !empty($topic->department) ? $topic->department->department : '' }}</td>
                            <td> <img src="{{ $topic->icon }}" width="100" height="100" /> </td>
                            <td>
                                <a href="{{ URL::to('edit-topic') }}/{{ $topic->id }}" class="btn btn-outline-primary btn-sm"> Edit </a>
                                |
                                <a href="{{ URL::to('delete-topic') }}/{{ $topic->id }}" class="btn btn-outline-danger btn-sm" onclick="checkDelete()"> Delete </a>
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

