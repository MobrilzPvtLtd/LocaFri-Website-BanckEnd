@extends('frontend.layouts.loca')

@section('title')
    {{ config('app.name') }} - Terms and Conditions
@endsection
<a href="https://wa.me/15551234567" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
</a>

@section('content')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- Subheader Section -->
        <section id="subheader" class="jarallax text-light">
            <img src="{{ asset('images/background/subheader.jpg') }}" class="jarallax-img" alt="Subheader Image">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Terms and Conditions</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Section -->
        <section aria-label="section">
            <div class="container mt-5">
                <h2>General Conditions</h2>
                <div class="regulations-section">
                    <!-- Terms Content -->
                    <p>
                        <strong>1. Hirer's Responsibilities</strong><br>
                        The hirer is responsible for the rented vehicle (including all accessories) from the start of the
                        rental period. The vehicle must be returned in its original condition (washed, vacuumed, and in
                        working order). If the insurance company refuses to cover any damages, these must be borne by the
                        hirer. An insurance excess of CHF 1,000.00 is always payable unless excess insurance of CHF 300.00
                        is taken. Any damage due to negligence will also be fully borne by the hirer. LocaFri Sàrl reserves
                        the right to request activation of the customer's private liability insurance in cases of
                        negligence. Additional kilometers are charged at CHF 0.50 per kilometer.
                    </p>

                    <p>
                        <strong>2. Returning the Vehicle</strong><br>
                        The vehicle and accessories must be returned in perfect condition at the time and place specified in
                        the rental agreement. Late returns will incur additional charges, including costs for refueling or
                        professional cleaning if necessary.
                    </p>

                    <p>
                        <strong>3. Other Commitments of the Hirer</strong><br>
                        The hirer agrees to:<br>
                        - Comply with all insurance conditions.<br>
                        - Take proper care of the rented vehicle.<br>
                        - Never abandon the vehicle in the event of a breakdown or accident until the lessor or a mechanic
                        intervenes.<br>
                        - Only allow registered drivers in the rental agreement to operate the vehicle.
                    </p>

                    <p>
                        <strong>4. Authorized Drivers</strong><br>
                        The vehicle may only be driven by individuals listed in the rental contract as authorized drivers.
                    </p>

                    <p>
                        <strong>5. Compensation</strong><br>
                        At the end of the rental period, if the vehicle is not returned in the same condition as at the
                        start, the hirer must immediately compensate the lessor for any damages.
                    </p>

                    <p>
                        <strong>6. Fines</strong><br>
                        The hirer is responsible for paying any fines incurred during the rental period. An administrative
                        fee of CHF 20.00 will be charged for processing.
                    </p>

                    <p>
                        <strong>7. Procedure in the Event of an Accident or Theft</strong><br>
                        In the event of an accident, theft, or damage, the hirer must notify the police immediately and
                        inform the lessor as soon as possible. An accident report must be completed and submitted to the
                        lessor and the insurance company.
                    </p>

                    <p>
                        <strong>8. Prohibited Uses and Territorial Restrictions</strong><br>
                        The vehicle may only be used within Swiss territory. Any unauthorized usage is strictly prohibited.
                    </p>

                    <p>
                        <strong>9. Fuel Policy</strong><br>
                        The vehicle must be returned with the same level of fuel as at the start of the rental. Otherwise, a
                        surcharge of CHF 20.00 plus the cost of fuel will apply.
                    </p>

                    <!-- Shareable Link Section -->
                    <div class="mt-4">
                        <strong>Share this link:</strong>
                        <input type="text" class="form-control text-center form-border" readonly
                            value="{{ $link ?? 'No link provided' }}">
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
