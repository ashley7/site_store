@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">
                Add Stock Item
            </button>

            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                           <th>#</th>  <th>Name</th> <th>Unit</th> <th>Stock in</th> <th>Stock Used</th> <th>Lost</th> <th>Damaged</th> <th>Stock Left</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($items as $item)
                                <?php 
                                $stock_in = $item->stocks->sum('quantity');
                                $stock_issues = $item->controls($item->id,'issued');
                                $stock_lost = $item->controls($item->id,'lost');
                                $stock_damaged = $item->controls($item->id,'damaged');
                                $balance = $stock_in - ($stock_issues + $stock_lost + $stock_damaged + $stock_damaged);
                                ?>
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>{{$stock_in}}</td>
                                    <td>{{$stock_issues}}</td>
                                    <td>{{$stock_lost}}</td>
                                    <td>{{$stock_damaged}}</td>
                                    <td>{{$balance}}</td>
                                    <td>
                                        <a href="{{route('items.show',$item->id)}}">Details</a>
                                        <a href="{{route('items.edit',$item->id)}}">Edit</a>
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
        <h4 class="modal-title">Add Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <form action="{{route('items.store')}}" method="POST">
            @csrf 

            <label for="">Name</label>
            <input type="text" class="form-control" name="name">

            <label for="unit">Unit</label>
            <input type="text" class="form-control" name="unit">

            <hr>
            <button type="submit">Save</button>

        </form>
        
      </div>
 

    </div>
  </div>
</div>
@endsection
