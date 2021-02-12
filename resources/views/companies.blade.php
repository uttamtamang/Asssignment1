@extends('layouts.app')
@section('content')
<style>
#companyCard{
  margin:20px auto;
}

#success-message{
  margin:0.5rem 0rem;
  padding:1rem;
}
</style>

<div class="container">
@if(session()->has('success'))
  <div class="alert-success" id="success-message">
    <h3> {!! session()->get('success') !!}</h3>
  </div>
@endif

 @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li> {{ $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<form action='/companies' method="post">
{{csrf_field()}}
<div class="input-group mb-3">
<div class="input-group">
    <span class="input-group-addon"></span>
    <input type="text" name="companyName" class="form-control" placeholder="Please Enter Company Name">
</div>
</div>
<button type="submit" class="btn btn-primary" >Add Companies</button>
</form>

<!-- Company's Media -->
@if($companies -> count())
@foreach($companies as $key=>$company)
<div class="card " id="companyCard" style={margin-top:20px}>
  <div class="card-header">
    {{$company->companyName}}
  </div>
  <div class="card-body" >
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMediaModal">Add Medias</button>
  </div>
 
  <div class="text-center">
    <img src="..." class="rounded" alt="...">
  </div>

</div>
@endforeach
@endif


  <!-- Media modal -->
<div class="modal fade" id="addMediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/addmedia" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="input-group mb-3">
        <!-- <div class="custom-file">
          <input type="file" name='image' class="form-control" id="inputGroupFile01">
          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div> -->
        <div class="form-group">
							
							<input type="file" class="form-control" name="image" >
							
                            </div>
        <div class='form-group'>
        <input type="hidden" name="company_id" value="1">
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Save Media</button>
      </div>
      </form>
    </div>
  </div>



</div>

@endsection