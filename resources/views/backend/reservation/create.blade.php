@extends ('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('reservation.index') }}">vehiclestatus</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">

                        <form method="POST" action="{{ route('reservation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Customer Name</label>
                                    <input type="text" class="form-control" name="name"  value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Vehicle Details</label>
                                    <input type="text" class="form-control" name="details"  value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Rental Dates Start</label>
                                    <input type="Date"class="form-control" name="start" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Rental Dates End</label>
                                    <input type="Date"class="form-control" name="end" placeholder="">

                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="method">Contact Method</label>
                                    <select class="form-control" name="method">
                                        <option value="email">Email</option>
                                        <option value="phone">Phone</option>
                                    </select>
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
