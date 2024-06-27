@extends ('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('vehiclestatus.index') }}">vehiclestatus</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">

                        <form method="POST" action="{{ route('vehiclestatus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Customer Name</label>
                                    <input type="number" class="form-control" name="kilometer"  value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Vehicle Details</label>
                                    <input type="Number" class="form-control" name="fule"  value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Rental Dates</label>
                                    <input type="Date"class="form-control" name="damage" placeholder="">

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Contact Method</label>
                                    <input type="Number" class="form-control" name="fule"  value="" placeholder="">
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <div class="float-left">

                    </div>
                </div>
                <div class="col-5">
                    <div class="float-end">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
