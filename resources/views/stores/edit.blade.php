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

                    <form action="{{route('items.update',$item->id)}}" method="POST">
                        @csrf 
                        {{method_field("PATCH")}}

                        <label for="">Name</label>
                        <input type="text" value="{{$item->name}}" class="form-control" name="name">

                        <label for="unit">Unit</label>
                        <input type="text" value="{{$item->unit}}" class="form-control" name="unit">

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