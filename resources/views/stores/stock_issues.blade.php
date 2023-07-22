@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">
                Record Issue of stock
            </button>

            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                           <th>Date</th> <th>Store</th> <th>Item</th>  <th>Quantity</th> <th>Transaction type</th> <th>Particular</th> <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($issues as $issue)
                                <tr>
                                    <td>{{$issue->created_at}}</td>
                                    <td>{{$issue->item->name}}</td>
                                    <td>{{$issue->store->name}}</td>
                                    <td>{{$issue->quantity."(".$issue->item->unit.")"}}</td>
                                    <td>
                                        @if($issue->transaction_type=="lost")
                                        <span class="text-danger">{{$issue->transaction_type}}</span>
                                        @elseif($issue->transaction_type=="issued")
                                        <span class="text-success">{{$issue->transaction_type}}</span>
                                        @else 
                                        <span class="text-primary">{{$issue->transaction_type}}</span>
                                        @endif
                                    </td>
                                    <td>{{$issue->particulars}}</td>
                                    <td>
                                    @if(Auth::user()->user_type == "admin")
                                        <a href="{{route('issue_stock.edit',$issue->id)}}">Edit</a>
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
        <h4 class="modal-title">Record stock issue</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <form action="{{route('issue_stock.store')}}" method="POST">
            @csrf 

            <label for="">Item</label>
            <select name="item_id" id="item_id" class="form-control">
                @foreach($items as $item)
                <option value="{{$item->id}}">{{$item->name}} ({{$item->unit}})</option>
                @endforeach
            </select>

            <label for="quantity">Quantity</label>
            <input type="number" step="any" name="quantity" class="form-control">           

            <label for="">Store</label>
            <select name="store_id" id="store_id" class="form-control">
                @foreach($stores as $store)
                <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
            </select> 

            <label for="">Transaction type</label>
            <select name="transaction_type" id="transaction_type" class="form-control">
                @foreach($transaction_types as $transaction_type)
                <option value="{{$transaction_type}}">{{$transaction_type}}</option>
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
