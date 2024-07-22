@extends('email.layout')

@section('content')
 <body>
    <section class="contact-main-div">
        <div class="contact-us-content">
            <h2 style="text-align: center;font-weight: 400;">A New Request from {{ ucfirst($data['name']) }}</h2>
            <table class="contact-table">
                <tbody>
                    <tr>
                        <td>
                          User Name
                        </td>
                        <td>
                            {{ $data['name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            User Email
                        </td>
                        <td>
                            {{ $data['email'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Address First
                        </td>
                        <td>
                            {{ $data['address_first'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Address Last
                        </td>
                        <td>
                            {{ $data['address_last'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Vehicle Name
                        </td>
                        <td>
                            {{ $data['vehicle_name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            PickUp Location
                        </td>
                        <td>
                            {{ $data['pickUpLocation'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Drop Off Location
                        </td>
                        <td>
                            {{ $data['dropOffLocation'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            PickUp Date
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($data['pickUpDate'])->format('d-M-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            PickUp Time
                        </td>
                        <td>
                            {{ $data['pickUpTime'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Collection Time
                        </td>
                        <td>
                            {{ $data['collectionTime'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Collection Date
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($data['collectionDate'])->format('d-M-Y') }}
                        </td>
                    </tr>
                    @if($data['day_price'])
                        <tr>
                            <td>
                                Day Price
                            </td>
                            <td>
                                ${{ $data['day_price'] }}
                            </td>
                        </tr>
                    @elseif($data['week_price'])
                        <tr>
                            <td>
                                Week Price
                            </td>
                            <td>
                                ${{ $data['week_price'] }}
                            </td>
                        </tr>
                    @elseif($data['month_price'])
                        <tr>
                            <td>
                                Month Price
                            </td>
                            <td>
                                ${{ $data['month_price'] }}
                            </td>
                        </tr>
                    @endif
                    @if($data['additional_driver'])
                        <tr>
                            <td>
                                Additional Driver
                            </td>
                            <td>
                                ${{ $data['additional_driver'] }}
                            </td>
                        </tr>
                    @endif
                    @if($data['booster_seat'])
                        <tr>
                            <td>
                                Booster Seat
                            </td>
                            <td>
                                ${{ $data['booster_seat'] }}
                            </td>
                        </tr>
                    @endif
                    @if($data['child_seat'])
                        <tr>
                            <td>
                                Child Seat
                            </td>
                            <td>
                                ${{ $data['child_seat'] }}
                            </td>
                        </tr>
                    @endif
                    @if($data['exit_permit'])
                        <tr>
                            <td>
                                Exit Permit
                            </td>
                            <td>
                                ${{ $data['exit_permit'] }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            Total Price
                        </td>
                        <td>
                            ${{ $data['total_price'] }}
                        </td>
                    </tr>
                    @if($data['status'] == "Parcel Paid")
                    <tr>
                        <td>
                            Remaining Amount
                        </td>
                        <td>
                            ${{ $data['remaining_amount'] }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td>
                            Status
                        </td>
                        <td>
                            {{ $data['status'] }}
                        </td>
                    </tr>
                    {{-- <tr>
                        <td>
                            Order Status
                        </td>
                        <td>
                            {{ $data['order_status'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Payment Method
                        </td>
                        <td>
                            {{ $data['payment_method'] }}
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </section>
</body>
@endsection
