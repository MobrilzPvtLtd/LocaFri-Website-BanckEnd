@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Register
@endsection

@section('content')
    <style>
        .form-border input {
            padding: 8px;
            margin-bottom: 10px;
            border: solid 2px #eeeeee;
            background: rgba(0, 0, 0, .025);
            border-radius: 6px;
            height: auto;
            box-shadow: none;
            color: #333;
        }
    </style>

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <section id="subheader" class="jarallax text-light">
            <img src="{{ asset('images/background/subheader.jpg') }}" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center p-4">
                            <h1>{!! __('messages.register_title') !!}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h3>{!! __('messages.register_prompt') !!}</h3>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="register_form" class="form-border" method="POST" action="{{ route('register.submit') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <label>{!! __('messages.name') !!}</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label>{!! __('messages.username') !!}</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label>{!! __('messages.email_address') !!}</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label>{!! __('messages.phone') !!}</label>
                                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}"
                                        required>
                                    @error('mobile')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label>{!! __('messages.password') !!}</label>
                                    <input type="password" name="password" class="form-control" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label>{!! __('messages.re_password') !!}</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-main color-2">{!! __('messages.register_now') !!}</button>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('login') }}">{!! __('messages.no_account') !!}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
