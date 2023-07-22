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

                    <form action="{{route('stock.update',$stock_record->id)}}" method="POST">
                        @csrf 
                        {{method_field('PATCH')}}

                        <label for="">Item</label>
                        <select name="item_id" id="item_id" class="form-control">
                            @foreach($items as $item)
                            <option {{$item->id==$stock_record->item_id ? "selected":""}} value="{{$item->id}}">{{$item->name}} ({{$item->unit}})</option>
                            @endforeach
                        </select>

                        <label for="quantity">Quantity</label>
                        <input type="number" step="any" name="quantity" value="{{$stock_record->quantity}}" class="form-control">

                        <label for="unit_price">Unit price</label>
                        <input type="number" step="any" name="unit_price" value="{{$stock_record->unit_price}}" class="form-control">            

                        <label for="supplier">Supplier</label>
                        <input type="text" name="supplier" class="form-control" value="{{$stock_record->supplier}}">

                        <label for="">Store</label>
                        <select name="store_id" id="store_id" class="form-control">
                            @foreach($stores as $store)
                            <option  {{$store->id==$stock_record->store_id ? "selected":""}} value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select> 
                        
                        <label for="particulars">Particulars</label>
                        <textarea name="particulars" class="form-control" id="particulars" cols="30" rows="3">{{$stock_record->particulars}}</textarea>

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