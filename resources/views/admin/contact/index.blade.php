@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
      <div class="container">
        <div class="row">
<h4>Contact Page</h4>
        <a href="{{route('add.contact')}}"><button class="btn btn-info pull-right" >Add Contact</button></a>
<br><br>

        <div class="col-md-12">
            <div class="card">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card-header">All Contact Data</div>
    
    <table class="table mb-0">
  <thead>
    <tr>
      <th scope="col" width="5%">SL No</th>
      <th scope="col" width="15%">Contact Address</th>
      <th scope="col" width="25%">Contact Email</th>
      <th scope="col" width="15%">Contact Phone</th>
      <th scope="col" width="15%">Action</th>
    </tr>
  </thead>
  <tbody>
     @php($i=1)
      @foreach($contacts as $contact)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$contact->address}}</td>
      <td>{{$contact->email}}</td>
      <td>{{$contact->phone}}</td>
        
      <td>
          <a href="{{url('contact/edit/'.$contact->id)}}" class="btn btn-info">Edit</a>
          <a href="{{url('contact/delete/'.$contact->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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