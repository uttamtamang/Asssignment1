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
.ImageContainer{
  display:flex;
}

.mediaImage{
  display:flex;
}
/* .mediaImage div{
  width: 300px;
  height: 300px;
} */
.mediaImage img{
  margin:10px;
  
}
</style>

<div class="container">
<!-- Message Handelling Section -->
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


<!-- POSTING COMPANY DETAIL -->
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

<!-- Company's Information and Media Card -->
@if($companies -> count())
@foreach($companies as $key=>$company)

<div class="card " id="companyCard">
  <div class="card-header">
    {{$company->companyName}}
  </div>
  <div class="card-body" >
  <form action="/addmedia" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
					<input type="file" class="form-control" name="image" id="inputGroupFile01" >
				</div>
        <div class='form-group'>
        <input type="hidden" name="company_id"  value="{{$company->company_id}}">
        </div>
        <button type="submit" class="btn btn-success" margin="5px 0px">Add Media</button>
      </form>
    <!-- TRIED TO ADD MEDIA TO MODEL BUT COULDN'T -->
    <!-- <button href="/addmedia" type="button" class="btn btn-success" data-toggle="modal" data-target="#addMediaModal">Add Medias</button> -->

  </div>
  <div class="mediaImage">
  @foreach($medias as $key=>$media)
  @if($media->company_id == $company->company_id)
      <img src="{!! asset('uploads/medias/'.$media->image) !!}" style="height:300px; width:300px; "  alt="image.jpg"/>

  @endif
@endforeach
</div>
</div>
@endforeach
@endif


  <!-- POST MEDIA MODALS-->
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
        <input type="text" name="company_id" value="2">
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