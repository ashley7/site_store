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

                    <form action="{{route('reports.store')}}" method="POST">
                        @csrf 

                        <label for="item_id">Select items</label> <br>
                        <select name="items[]" multiple id="item_id" class="form-control col-md-4">
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <br>

                        <label for="from">From</label>
                        <input type="date" name="from_date" id="from_date" class="form-control col-md-6">
                         

                        <label for="to">To</label>
                        <input type="date" name="to_date" id="to_date" class="form-control col-md-6">
                        
                        <hr>
                        <button type="submit">Generate</button>


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

        $("#item_id").chosen({
            width:"50%"
        })

     })
</script>

@endpush