@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('alert.index') }}" enctype="multipart/form-data">
                    Back</a>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container mt-5">
                        <form method="post" action="{{ route('alert.update', $alert->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Service</label>
                                    <input type="text" class="form-control" name="service" value="{{ $alert->service }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Plates Change</label>
                                    <input type="text" class="form-control" name="plates" value="{{ $alert->plates }}" placeholder="">
                                </div>
                                <div class="form-group mb-2 col-4">
                                    <label for="city">Brakes Check</label>
                                    <input type="text" class="form-control" name="brakes" value="{{ $alert->brakes }}" placeholder="">
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
