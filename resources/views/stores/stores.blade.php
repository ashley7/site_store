@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">
                Add Store
            </button>

            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                           <th>Item Number</th>  <th>Name</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($stores as $store)
                                <tr>
                                    <td>{{$store->id}}</td>
                                    <td>{{$store->name}}</td>
                                     <td>
                                        <a href="{{route('stores.edit',$store->id)}}">Edit</a>
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
</div>


<div class="modal" id="add_user">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Add Store</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <form action="{{route('stores.store')}}" method="POST">
            @csrf 

            <label for="">Name</label>
            <input type="text" class="form-control" name="name">

           
            <hr>
            <button type="submit">Save</button>

        </form>
        
      </div>
 

    </div>
  </div>
</div>
@endsection
