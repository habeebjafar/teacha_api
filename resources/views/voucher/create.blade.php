@extends('layout')

@section('dashboard-content')

<h1>  Generate Voucher form</h1>

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


<form action = "{{URL::to('post-voucher-form')}}" method = "post" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Number of Vouchers</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Number of Vouchers" name="voucher_number">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Voucher Amount</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Voucher Amount" name="voucher_amount">
  </div>


  
  <button type="submit" class="btn btn-primary">Generate</button>
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