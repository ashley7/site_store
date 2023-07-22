@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $counter = 0 ?>
            <h2>{{$title}}</h2>
            <hr>
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                           <th>Date</th> <th>Store</th> <th>Item</th>  <th>Quantity</th> <th>Price</th> <th>Transaction type</th> <th>Particular</th>
                        </thead>

                        <tbody>
                            @foreach($stock_issues as $issue)
                                <tr>
                                    <td>{{$issue->created_at}}</td>
                                    <td>{{$issue->item->name}}</td>
                                    <td>{{$issue->store->name}}</td>
                                    <td>{{$issue->quantity."(".$issue->item->unit.")"}}</td>
                                    <td></td>
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
                                    
                                </tr>
                                <?php $counter = $counter - $issue->quantity;?>
                            @endforeach


                            <?php $total_amount = 0;?>

                            @foreach($stock_records as $stock_record)
                                <?php 
                                    $amount = $stock_record->price($stock_record);

                                    $total_amount = $total_amount + $amount;
                                ?>
                                <tr>
                                    <td>{{$stock_record->created_at}}</td>
                                    <td>{{$stock_record->item->name}}</td>
                                    <td>{{$stock_record->store->name}}</td>
                                    <td>{{$stock_record->quantity."(".$stock_record->item->unit.")"}}</td>
                                    <td>{{number_format($amount)}}</td>
                                    <td>
                                        <span>Stock in</span>
                                    </td>
                                    <td>{{$stock_record->particulars}}</td>
                                    
                                </tr>
                                <?php $counter = $counter + $stock_record->quantity  ?>
                            @endforeach
                        </tbody>

                        <thead>
                           <th>Total</th> <th></th> <th></th>  <th>{{$counter}} left</th> <th>{{number_format($total_amount)}}</th> <th></th> <th></th>
                        </thead>
                    </table>
                </div>
                                     
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
