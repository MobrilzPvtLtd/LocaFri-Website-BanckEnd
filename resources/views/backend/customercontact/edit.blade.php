@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customercontact.index') }}" enctype="multipart/form-data">
                    Back</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">
                        <form method="post" action="{{ route('customercontact.update', $customer->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Customer Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $customer->name }}"
                                        placeholder="">
                                </div>

                                <div class="form-group mb-2 col-4">
                                    <label for="city">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $customer->email }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Phone</label>
                                    <input type="text"class="form-control" name="phone" value="{{ $customer->phone }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" value="" placeholder="">{{ $customer->address }}</textarea>
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="massage">Massage</label>
                                    <textarea class="form-control" name="massage" placeholder="">{{ $customer->massage }}</textarea>
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
