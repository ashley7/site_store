@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">
                Add Stock record
            </button>

            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                           <th>Date</th>  <th>Item</th> <th>Quantity</th> <th>Amount</th> <th>Store</th> <th>Supplier</th> <th>By</th> <th>particulars</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($stock_records as $stock_record)
                                <tr>
                                    <td>{{$stock_record->created_at}}</td>
                                    <td>{{$stock_record->item->name}}</td>
                                    <td>{{$stock_record->quantity." (".$stock_record->item->unit.")"}} @ {{number_format($stock_record->unit_price)}}</td>
                                    <td>{{ number_format($stock_record->price($stock_record))}}</td>
                                    <td>{{$stock_record->store->name}}</td>
                                    <td>{{$stock_record->supplier}}</td>
                                    <td>{{$stock_record->user->name}}</td>
                                    <td>{{$stock_record->particulars}}</td>
                                    <td>
                                        @if(Auth::user()->user_type == "admin")
                                            <a href="{{route('stock.edit',$stock_record->id)}}">Edit</a>
                                        @endif
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
        <h4 class="modal-title">Add Stock record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <form action="{{route('stock.store')}}" method="POST">
            @csrf 

            <label for="">Item</label>
            <select name="item_id" id="item_id" class="form-control">
                @foreach($items as $item)
                <option value="{{$item->id}}">{{$item->name}} ({{$item->unit}})</option>
                @endforeach
            </select>

            <label for="quantity">Quantity</label>
            <input type="number" step="any" name="quantity" class="form-control">

            <label for="unit_price">Unit price</label>
            <input type="number" step="any" name="unit_price" class="form-control">            

            <label for="supplier">Supplier</label>
            <input type="text" name="supplier" class="form-control">

            <label for="">Store</label>
            <select name="store_id" id="store_id" class="form-control">
                @foreach($stores as $store)
                <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
            </select> 
            
            <label for="particulars">Particulars</label>
            <textarea name="particulars" class="form-control" id="particulars" cols="30" rows="3"></textarea>

            <hr>
            <button type="submit">Save record</button>

        </form>        
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {

        $("#item_id,#store_id").chosen({
            width:"100%"
        })

     })
</script>

@endpush
