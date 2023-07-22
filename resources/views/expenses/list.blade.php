@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">
                Record expenditures
            </button>

            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                           <th>Date</th>  <th>Particular</th> <th>Quantity</th> <th>Price</th>  <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($expenditures as $expenditure)
                            <?php 
                            $amount = $expenditure->qunatity * $expenditure->unit_price;                            
                            ?>                              
                            <tr>
                                <td>{{$expenditure->created_at}}</td>
                                <td>{{$expenditure->particluar}}</td>
                                <td>{{$expenditure->qunatity}} @ {{ number_format($expenditure->unit_price)}}</td>
                                <td>{{number_format($amount)}}</td>                                  
                                <td>
                                    <a href="{{route('expenses.edit',$expenditure->id)}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$expenditures->links()}}
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
        <h4 class="modal-title">Add Expenditure</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <form action="{{route('expenses.store')}}" method="POST">
            @csrf 

            <label for="">Particular</label>
            <input type="text" class="form-control" name="particluar">

            <label for="quantity">Quantity</label>
            <input type="number" step="any" class="form-control" name="quantity">

            <label for="unit">Unit price</label>
            <input type="text" class="form-control" name="unit_price">

            <hr>
            <button type="submit">Save</button>

        </form>
        
      </div>
 

    </div>
  </div>
</div>
@endsection
