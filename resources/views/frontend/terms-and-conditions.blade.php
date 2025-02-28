@extends('frontend.layouts.loca')

@section('title')
    {{ config('app.name') }} - Terms and Conditions
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- WhatsApp Button -->
        <a href="https://wa.me/41793876020" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        </a>

        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

        <!-- Subheader Section -->
        <section id="subheader" class="jarallax text-light">
            <img src="{{ asset('images/background/subheader.jpg') }}" class="jarallax-img" alt="Subheader Image">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>{{ __('messages.terms_and_conditions') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Section -->
        <section aria-label="section">
            <div class="container mt-5">
                <h2>{{ __('messages.general_conditions') }}</h2>
                <div class="regulations-section">
                    <!-- Terms Content -->
                    <p>
                        <strong>1. {{ __('messages.hirer_responsibilities') }}</strong><br>
                        {{ __('messages.hirer_text') }}
                    </p>

                    <p>
                        <strong>2. {{ __('messages.returning_vehicle') }}</strong><br>
                        {{ __('messages.return_vehicle') }}
                    </p>

                    <p>
                        <strong>3.  {{ __('messages.other_commitments_hirer') }}</strong><br>
                        {{ __('messages.hirer_agreements') }}

                    </p>

                    <p>
                        <strong>4. {{ __('messages.authorized_drivers') }}</strong><br>
                        {{ __('messages.authorized_drivers_text') }}
                        {{-- The vehicle may only be driven by individuals listed in the rental contract as authorized drivers. --}}
                    </p>

                    <p>
                        <strong>5. {{ __('messages.compensation') }}</strong><br>
                        {{ __('messages.compensation_text') }}
                    </p>

                    <p>
                        <strong>6. {{ __('messages.fines') }}</strong><br>
                        {{ __('messages.fines_text') }}
                    </p>

                    <p>
                        <strong>7. {{ __('messages.accident_procedure') }}</strong><br>
                        {{ __('messages.accident_procedure_text') }}
                    </p>

                    <p>
                        <strong>8. {{ __('messages.prohibited_uses') }}</strong><br>
                        {{ __('messages.prohibited_uses_text') }}
                    </p>

                    <p>
                        <strong>9. {{ __('messages.fuel_policy') }}</strong><br>
                        {{ __('messages.fuel_policy_text') }}
                    </p>

                    <!-- Shareable Link Section -->
                    {{-- <div class="mt-4">
                        <strong>{{ __('messages.share') }}</strong>
                        <input type="text" class="form-control text-center form-border" readonly
                            value="{{ $link ?? 'No link provided' }}">
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection
