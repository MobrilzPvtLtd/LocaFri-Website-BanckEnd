@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Cars
@endsection
@section('content')
    <div class="container ">
        <div class="py-5 text-center">

            <h2 style="margin-top: 150px">Checkout form</h2>
            {{-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> --}}
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Vehicle name</h6>
                            <small class="text-muted">{{ $data['name'] }}</small>
                        </div>
                        {{-- <span class="text-muted">$12</span> --}}
                    </li>
                    @if ($data['targetDate'] == 'day')
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Day</h6>
                                <small class="text-muted">{{ $data['targetDate'] }}</small>
                            </div>
                            <span class="text-muted">$ {{ $data['Dprice'] }}</span>
                        </li>
                    @endif

                    @if ($data['targetDate'] == 'week')
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Week</h6>
                                <small class="text-muted">{{ $data['targetDate'] }}</small>
                            </div>
                            <span class="text-muted">$ {{ $data['wprice'] }}</span>
                        </li>
                    @endif

                    @if ($data['targetDate'] == 'month')
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Month</h6>
                                <small class="text-muted">{{ $data['targetDate'] }}</small>
                            </div>
                            <span class="text-muted">$ {{ $data['mprice'] }}</span>
                        </li>
                    @endif
                    @if ($data['additional_driver'])
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Additional driver</h6>
                                <small class="text-muted">(20.-/per month)</small>
                            </div>
                            <span class="text-muted">${{ $data['additional_driver'] }}</span>
                        </li>
                    @endif
                    @if ($data['booster_seat'])
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Child booster seat</h6>
                                <small class="text-muted">(20.-/month)</small>
                            </div>
                            <span class="text-muted">${{ $data['booster_seat'] }}</span>
                        </li>
                    @endif
                    @if ($data['child_seat'])
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Child seat</h6>
                                <small class="text-muted">(30.-/month)</small>
                            </div>
                            <span class="text-muted">${{ $data['child_seat'] }}</span>
                        </li>
                    @endif
                    @if ($data['exit_permit'])
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Exit permit</h6>
                                <small class="text-muted">(149.-/month)</small>
                            </div>
                            <span class="text-muted">${{ $data['exit_permit'] }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{ $data['total_price'] }}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{route('booking-checkout')}}" method="post" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $data['name'] }}" name="name">
                    <input type="hidden" value="{{ $data['Dprice'] ?? $data['wprice'] ?? $data['mprice'] }}" name="price">
                    <input type="hidden" value="{{ $data['additional_driver'] }}" name="additional_driver">
                    <input type="hidden" value="{{ $data['booster_seat'] }}" name="booster_seat">
                    <input type="hidden" value="{{ $data['child_seat'] }}" name="child_seat">
                    <input type="hidden" value="{{ $data['exit_permit'] }}" name="exit_permit">
                    <input type="hidden" value="{{ $data['total_price'] }}" name="total_price">
                    <input type="hidden" value="{{ $data['targetDate'] }}" name="targetDate">
                    <input type="hidden" value="{{ $data['day_count'] }}" name="day_count">
                    <input type="hidden" value="{{ $data['week_count'] }}" name="week_count">
                    <input type="hidden" value="{{ $data['month_count'] }}" name="month_count">
                    <input type="hidden" value="{{ $data['pickUpLocation'] }}" name="pickUpLocation">
                    <input type="hidden" value="{{ $data['dropOffLocation'] }}" name="dropOffLocation">
                    <input type="hidden" value="{{ $data['pickUpDate'] }}" name="pickUpDate">
                    <input type="hidden" value="{{ $data['pickUpTime'] }}" name="pickUpTime">
                    <input type="hidden" value="{{ $data['collectionDate'] }}" name="collectionDate">
                    <input type="hidden" value="{{ $data['collectionTime'] }}" name="collectionTime">
                    <input type="hidden" value="{{ $data['message'] }}" name="message">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input type="text" name="address_first" class="form-control" id="address"
                            placeholder="1234 Main St">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted"></span></label>
                        <input type="text" name="address_last" class="form-control" id="address2"
                            placeholder="Apartment or suite">
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
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">

                    <p>10% of the total amount will have to be paid</p>

                    <h4 class="mb-3">Payment Methods</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="payment_method" type="radio" class="custom-control-input" value="stripe" checked required>
                            <label class="custom-control-label" for="credit">Stripe</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="payment_method" type="radio" class="custom-control-input" value="twint" required>
                            <label class="custom-control-label" for="debit">Twint</label>
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
                            Continue to checkout
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
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum at eros.</p>

                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel
                                            scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non
                                            metus auctor fringilla.</p>

                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum at eros.</p>

                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel
                                            scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non
                                            metus auctor fringilla.</p>

                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum at eros.</p>

                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel
                                            scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non
                                            metus auctor fringilla.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-main" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn-main">Understood</button>
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
