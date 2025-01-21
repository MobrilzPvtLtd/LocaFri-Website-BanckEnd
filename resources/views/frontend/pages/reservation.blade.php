@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Cars
@endsection
<a href="https://wa.me/41793876020" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
</a>

@section('content')
    <div class="container ">
        <div class="py-5 text-center">
            <h2 style="margin-top: 150px">{{ __('messages.checkout_form') }}</h2>
            {{-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> --}}
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">{{ __('messages.your_cart') }}</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ __('messages.vehicle_name') }}</h6>
                            <small class="text-muted">{{ $data['name'] }}</small>
                        </div>
                        {{-- <span class="text-muted">$12</span> --}}
                    </li>
                    @if ($data['day_count'] > 0)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ __('messages.day') }}</h6>
                                {{-- <small class="text-muted">{{ $data['targetDate'] }}</small> --}}
                            </div>
                            <span class="text-muted">CHF {{ $data['Dprice'] * $data['day_count'] }}</span>
                        </li>
                    @endif

                    @if ($data['week_count'] > 0)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ __('messages.week') }}</h6>
                                {{-- <small class="text-muted">{{ $data['targetDate'] }}</small> --}}
                            </div>
                            <span class="text-muted">CHF {{ $data['wprice'] * $data['week_count'] }}</span>
                        </li>
                    @endif

                    @if ($data['month_count'] > 0)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ __('messages.month') }}</h6>
                                {{-- <small class="text-muted">{{ $data['targetDate'] }}</small> --}}
                            </div>
                            <span class="text-muted">CHF {{ $data['mprice'] * $data['month_count'] }}</span>
                        </li>
                    @endif
                    @if (isset($data['additional_driver']))
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ __('messages.additional_driver') }}</h6>
                                <small class="text-muted">(20 CHF /{{ __('messages.month') }})</small>
                            </div>
                            <span class="text-muted">CHF{{ $data['additional_driver'] }}</span>
                        </li>
                    @endif
                    @if (isset($data['booster_seat']))
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ __('messages.booster_seat')}}</h6>
                                <small class="text-muted">(20 CHF /{{ __('messages.month') }})</small>
                            </div>
                            <span class="text-muted">CHF{{ $data['booster_seat'] }}</span>
                        </li>
                    @endif
                    @if (isset($data['child_seat']))
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ __('messages.child_seat') }}</h6>
                                <small class="text-muted">(30 CHF/{{ __('messages.month') }})</small>
                            </div>
                            <span class="text-muted">CHF{{ $data['child_seat'] }}</span>
                        </li>
                    @endif
                    @if (isset($data['exit_permit']))
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ __('messages.exit_permit') }}</h6>
                                <small class="text-muted">(149 CHF/{{ __('messages.month') }})</small>
                            </div>
                            <span class="text-muted">CHF{{ $data['exit_permit'] }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (CHF)</span>
                        <strong>CHF{{ $data['total_price'] }}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">{{ __('messages.billing_address') }}</h4>
                <form class="needs-validation" action="{{ route('booking-checkout') }}" method="post" novalidate>
                    @csrf
                    {{-- <input type="hidden" value="{{ $data['targetDate'] }}" name="targetDate"> --}}
                    <input type="hidden" value="{{ $data['name'] }}" name="name">
                    <input type="hidden" value="{{ $data['Dprice'] }}" name="Dprice">
                    <input type="hidden" value="{{ $data['wprice'] }}" name="wprice">
                    <input type="hidden" value="{{ $data['mprice'] }}" name="mprice">

                    <input type="hidden" value="{{ $data['day_count'] }}" name="day_count">
                    <input type="hidden" value="{{ $data['week_count'] }}" name="week_count">
                    <input type="hidden" value="{{ $data['month_count'] }}" name="month_count">

                    @if (isset($data['additional_driver']))
                        <input type="hidden" value="{{ $data['additional_driver'] }}" name="additional_driver">
                    @endif
                    @if (isset($data['booster_seat']))
                        <input type="hidden" value="{{ $data['booster_seat'] }}" name="booster_seat">
                    @endif
                    @if (isset($data['child_seat']))
                        <input type="hidden" value="{{ $data['child_seat'] }}" name="child_seat">
                    @endif
                    @if (isset($data['exit_permit']))
                        <input type="hidden" value="{{ $data['exit_permit'] }}" name="exit_permit">
                    @endif
                    <input type="hidden" value="{{ $data['total_price'] }}" name="total_price">

                    <input type="hidden" value="{{ $data['pickUpLocation'] }}" name="pickUpLocation">
                    <input type="hidden" value="{{ $data['dropOffLocation'] }}" name="dropOffLocation">
                    <input type="hidden" value="{{ $data['startDate'] }}" name="startDate">
                    <input type="hidden" value="{{ $data['startTime'] }}" name="startTime">
                    <input type="hidden" value="{{ $data['endDate'] }}" name="endDate">
                    <input type="hidden" value="{{ $data['endTime'] }}" name="endTime">
                    <input type="hidden" value="{{ $data['message'] }}" name="message">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">{{ __('messages.first_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" id="firstName" placeholder=""
                                value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" id="lastName" placeholder=""
                                value="{{ old('last_name') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address">{{ __('messages.adresse_1') }}<span class="text-danger">*</span></label>
                        <input type="text" name="address_first" class="form-control" id="address" placeholder="1234 Main St"
                            value="{{ old('address_first') }}">
                        @error('address_first')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address2">{{ __('messages.adresse_1') }}<span class="text-muted"></span></label>
                        <input type="text" name="address_last" class="form-control" id="address2" placeholder="Apartment or suite"
                            value="{{ old('address_last') }}">
                    </div>

                    <div class="mb-3">
                        <label for="zipcode">{{ __('messages.zip_code') }}<span class="text-danger">*</span></label>
                        <input type="text" name="zipcode" class="form-control" id="zipcode" required placeholder="Zip Code"
                            value="{{ old('zipcode') }}">
                        @error('zipcode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                        <input type="text" name="city" class="form-control" id="city" required placeholder="{{ __('messages.city') }}"
                            value="{{ old('city') }}">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- <div class="row">
                        <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" required>
                            <option value="">Choose...</option>
                            <option>United States</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                        </div>
                        <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" required>
                            <option value="">Choose...</option>
                            <option>California</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                        </div>
                    </div> --}}
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info" name="next_time">
                        <label class="custom-control-label" for="save-info">{{ __('messages.save_this_information_for_next_time')}}</label>
                        @error('next_time')
                           <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr class="mb-4">
                    <label class="custom-control-label mb-8" for="same-address">{{ __('messages.choose_payment_type')}}</label>

                    @php
                        $remaining_amount = $data['total_price'] * 0.1;
                    @endphp

                    <select class="form-select" style="width: 50%;" name="payment_type" id="payment_type"
                        {{-- onchange="updatePayment()" --}}>
                        <option value="payment_partial">{{ __('messages.pay_partially_10')}}(10% of the CHF {{ $remaining_amount }})
                            <span id="payment_10_percent"></span>
                        </option>
                        <option value="payment_full">{{ __('messages.pay_full_amount')}}(CHF {{ $data['total_price'] }})<span
                                id="payment_full"></span></option>
                    </select>

                    {{-- <script>
                        // Assuming $data['total_price'] is already available in JavaScript
                        const totalPrice = {{ $data['total_price'] }};

                        function updatePayment() {
                            const paymentType = document.getElementById('payment_type').value;

                            // Calculate the 10% payment
                            const payment10Percent = (totalPrice * 0.1).toFixed(2);

                            // Update the text based on the selected option
                            if (paymentType == "0") {
                                // For 10% Payment (Partial Payment)
                                document.getElementById('payment_10_percent').innerText = payment10Percent;
                                document.getElementById('payment_full').innerText = totalPrice.toFixed(2);
                            } else if (paymentType == "1") {
                                // For Full Payment
                                document.getElementById('payment_full').innerText = totalPrice.toFixed(2);
                                document.getElementById('payment_10_percent').innerText = payment10Percent;
                            }
                        }

                        // Call the function initially to set the default values
                        updatePayment();
                    </script> --}}

                    <h4 class="mt-3">{{ __('messages.payment_methods')}}</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="payment_method" type="radio" class="custom-control-input"
                                value="stripe" checked required>
                            <label class="custom-control-label" for="credit">{{ __('messages.visa')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="credit" name="payment_method" type="radio" class="custom-control-input"
                            value="stripe" checked required>
                        <label class="custom-control-label" for="credit">{{ __('messages.twint')}}</label>
                            {{-- <input id="debit" name="payment_method" type="radio" class="custom-control-input"
                                value="twint" required>
                            <label class="custom-control-label" for="debit">{{ __('messages.twint')}}</label> --}}
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                        </div>
                        </div> --}}
                    {{-- <div class="row">
                            <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                            </div>
                            <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                            </div>
                        </div> --}}
                    <hr class="mb-4">
                    <div class="col-md-4 mb60">
                        <div class="spacer10"></div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn-main" data-bs-toggle="modal"
                            data-bs-target="#scrollingLongContent">
                            {{ __('messages.continue_to_checkout')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="scrollingLongContent" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="scrollingLongContentLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="scrollingLongContentLabel">Read the Contract</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>{{ __('messages.responsibilities_title') }}</h4>
                                       <p>{{ __('messages.responsibilities_details') }}</p>

                                    <ul>
                                      <li>{{ __('messages.insurance') }}</li>
                                      <li>{{ __('messages.late_return') }}</li>
                                      <li>{{ __('messages.fuel_policy') }}</li>
                                      <li>{{ __('messages.contraventions') }}</li>
                                      <li>{{ __('messages.contraventions_fees') }}</li>
                                      <li>{{ __('messages.accidents_procedure') }}</li>
                                      <li>{{ __('messages.usage_restrictions') }}</li>
                                      <li>{{ __('messages.fuel_return') }}</li>
                                      <li>{{ __('messages.fuel_penalty') }}</li>
                                    </ul>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-main" data-bs-dismiss="modal">{{ __('messages.close')}}</button>
                                        <button type="submit" class="btn-main">{{ __('messages.understood')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
