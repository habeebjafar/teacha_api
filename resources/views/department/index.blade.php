@extends('layout')

@section('dashboard-content')






<div class="card shadow mb-4">
      <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All  Departments</h6>
      </div>
      <div class="card-body">
            <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                              <tr>
                                    <th>S/N</th>
                                    <th>Department</th>
                                    <th>Action</th>

                              </tr>
                        </thead>
                        <tfoot>
                              <tr>
                                    <th>S/N</th>
                                    <th>Department</th>
                                    <th>Action</th>
                              </tr>
                        </tfoot>
                        <tbody>
                              
                              @foreach($departments as $department)
                             

                              <tr>
                                    <td>{{$sn++}}</td>
                                    <td>{{ $department -> department}}</td>
                                    <td>
                                          <a href="{{ URL::to('edit-department')}}/{{$department->id}}" class="btn btn-outline-primary btn-sm"> <i class="fas fa-edit fa-fw"></i> </a>
                                          |
                                          <a href="#" class="btn btn-outline-danger btn-sm" onclick="checkDelete()"> <i class="fas fa-recycle fa-fw"></i> </a>
                                    </td>

                              </tr>
                              @endforeach
                        </tbody>
                  </table>
            </div>
      </div>
</div>

<script>
      function checkDelete() {
            var check = confirm('Are you sure you want to Delete this?');
            if (check) {
                  return true;
            }
            return false;
      }
</script>
@stop