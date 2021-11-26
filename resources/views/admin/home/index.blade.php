@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
      <div class="container">
        <div class="row">
<h4>Home About</h4>
        <a href="{{route('add.about')}}"><button class="btn btn-info pull-right" >Add About</button></a>
<br><br>

        <div class="col-md-12">
            <div class="card">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card-header">All About Data</div>
    
    <table class="table mb-0">
  <thead>
    <tr>
      <th scope="col" width="5%">SL No</th>
      <th scope="col" width="15%">Home Title</th>
      <th scope="col" width="25%">Short Description</th>
      <th scope="col" width="15%">Long Description</th>
      <th scope="col" width="15%">Action</th>
    </tr>
  </thead>
  <tbody>
     @php($i=1)
      @foreach($homeabout as $about)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$about->title}}</td>
      <td>{{$about->short_dis}}</td>
      <td>{{$about->long_dis}}</td>
        
      <td>
          <a href="{{url('about/edit/'.$about->id)}}" class="btn btn-info">Edit</a>
          <a href="{{url('about/delete/'.$about->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
        </td>
    </tr>

    @endforeach
  </tbody>
</table>
</div>
</div>        
       

        </div>
       </div>

    </div>
@endsection