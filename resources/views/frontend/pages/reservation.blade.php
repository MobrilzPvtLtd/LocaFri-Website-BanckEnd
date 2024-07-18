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
                            <small class="text-muted">{{ $name }}</small>
                        </div>
                        {{-- <span class="text-muted">$12</span> --}}
                    </li>
                    @if (request()->targetDate == 'day')
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Day</h6>
                                <small class="text-muted">{{ $targetDate }}</small>
                            </div>
                            <span class="text-muted">$ {{ $Dprice }}</span>
                        </li>
                    @endif

                    @if (request()->targetDate == 'week')
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Week</h6>
                                <small class="text-muted">{{ $targetDate }}</small>
                            </div>
                            <span class="text-muted">$ {{ $wprice }}</span>
                        </li>
                    @endif

                    @if (request()->targetDate == 'month')
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Month</h6>
                                <small class="text-muted">{{ $targetDate }}</small>
                            </div>
                            <span class="text-muted">$ {{ $mprice }}</span>
                        </li>
                    @endif
                    @if (request()->additional_driver)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Additional driver</h6>
                                <small class="text-muted">(20.-/per month)</small>
                            </div>
                            <span class="text-muted">${{ $additional_driver }}</span>
                        </li>
                    @endif
                    @if (request()->booster_seat)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Child booster seat</h6>
                                <small class="text-muted">(20.-/month)</small>
                            </div>
                            <span class="text-muted">${{ $booster_seat }}</span>
                        </li>
                    @endif
                    @if (request()->booster_seat)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Child seat</h6>
                                <small class="text-muted">(30.-/month)</small>
                            </div>
                            <span class="text-muted">${{ $child_seat }}</span>
                        </li>
                    @endif
                    @if (request()->exit_permit)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Exit permit</h6>
                                <small class="text-muted">(149.-/month)</small>
                            </div>
                            <span class="text-muted">${{ $exit_permit }}</span>
                        </li>
                    @endif
                    {{-- <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">-$5</span>
                    </li> --}}
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{ $total_price }}</strong>
                    </li>
                </ul>

                    {{-- <form class="card p-2">
                     <div class="input-group">
                   <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
            </div>
            </form> --}}
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{route('booking-checkout')}}" method="post" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $name }}" name="name">
                    @if($Dprice)
                        <input type="hidden" value="{{ $Dprice }}" name="price">
                    @elseif($wprice)
                        <input type="hidden" value="{{ $wprice }}" name="price">
                    @elseif($mprice)
                        <input type="hidden" value="{{ $mprice }}" name="price">
                    @endif
                    <input type="hidden" value="{{ $additional_driver }}" name="additional_driver">
                    <input type="hidden" value="{{ $booster_seat }}" name="booster_seat">
                    <input type="hidden" value="{{ $child_seat }}" name="child_seat">
                    <input type="hidden" value="{{ $exit_permit }}" name="exit_permit">
                    <input type="hidden" value="{{ $total_price }}" name="total_price">
                    <input type="hidden" value="{{ $targetDate }}" name="targetDate">
                    <input type="hidden" value="{{ $day_count }}" name="day_count">
                    <input type="hidden" value="{{ $week_count }}" name="week_count">
                    <input type="hidden" value="{{ $month_count }}" name="month_count">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="first_name" id="firstName" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="last_name" id="lastName" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control" id="username" placeholder="Username" required>
              <div class="invalid-feedback" style="width: 100%;">
                Your username is required.
              </div>
            </div>
          </div> --}}

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address_first" class="form-control" id="address"
                            placeholder="1234 Main St">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
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
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                            address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment Methods</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input"
                                checked required>
                            <label class="custom-control-label" for="credit">Stripe</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input"
                                required>
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
