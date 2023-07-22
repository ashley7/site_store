@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">
                Add user
            </button>

            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Name</th> <th>Email</th>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
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
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <form action="{{route('users.store')}}" method="POST">
            @csrf 

            <label for="">Name</label>
            <input type="text" class="form-control" name="name">

            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">

            <hr>
            <button type="submit">Save</button>

        </form>
        
      </div>
 

    </div>
  </div>
</div>
@endsection
