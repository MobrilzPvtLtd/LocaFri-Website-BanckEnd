@extends ('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('customercontact.index') }}">vehiclestatus</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">
                        <form method="POST" action="{{ route('customercontact.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Customer Name</label>
                                    <input type="text" class="form-control" name="name"  value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Email</label>
                                    <input type="email" class="form-control" name="email"  value="" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Phone</label>
                                    <input type="text"class="form-control" name="phone" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" type="text" name="address" placeholder=""></textarea>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="massage">Massage</label>
                                    <textarea class="form-control" type="text" name="massage" placeholder=""></textarea>
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
