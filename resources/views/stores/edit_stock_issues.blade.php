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

                    <form action="{{route('issue_stock.update',$issues->id)}}" method="POST">
                        @csrf 
                        {{method_field('PATCH')}}

                        <label for="">Item</label>
                        <select name="item_id" id="item_id" class="form-control">
                            @foreach($items as $item)
                            <option value="{{$item->id}}" {{ $item->id==$issues->item_id ? "selected":"" }}>{{$item->name}} ({{$item->unit}})</option>
                            @endforeach
                        </select>

                        <label for="quantity">Quantity</label>
                        <input type="number" step="any" name="quantity" value="{{$issues->quantity}}" class="form-control">           

                        <label for="">Store</label>
                        <select name="store_id" id="store_id" class="form-control">
                            @foreach($stores as $store)
                            <option value="{{$store->id}}" {{ $store->id==$issues->store_id ? "selected":"" }}>{{$store->name}}</option>
                            @endforeach
                        </select> 

                        <label for="">Transaction type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control">
                            @foreach($transaction_types as $transaction_type)
                            <option value="{{$transaction_type}}" {{ $transaction_type==$issues->transaction_type ? "selected":"" }}>{{$transaction_type}}</option>
                            @endforeach
                        </select> 
                        
                        <label for="particulars">Particulars</label>
                        <textarea name="particulars" class="form-control" id="particulars" cols="30" rows="3">{{$issues->particulars}}</textarea>
        
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

@push('scripts')

<script>
    $(document).ready(function() {

        $("#item_id,#store_id").chosen({
            width:"100%"
        })

     })
</script>

@endpush