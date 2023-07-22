@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>
            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">

                    <form action="{{route('stores.update',$store->id)}}" method="POST">
                        @csrf 
                        {{method_field("PATCH")}}

                        <label for="">Name</label>
                        <input type="text" value="{{$store->name}}" class="form-control" name="name">
 
                        <hr>
                        <button type="submit">Save changes</button>


                    </form>
                     
                </div>
                                     
                </div>
            </div>
        </div>
    </div>
</div>

@endsection