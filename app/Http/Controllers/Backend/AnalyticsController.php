<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnalyticsReport;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        // 1. Get all vehicles
        $vehicles = Vehicle::all();

        // 2. Get filter dates from the request and assign empty values as required
        $startDateFilter = $request->input('start_date') ?? '';
        $endDateFilter = $request->input('end_date') ?? '';
        $vehicleFilter = array_filter($request->input('vehicle_id') ?? []); // Changed to array for multiple select and remove empty values
        $specialDateFilter = $request->input('special_date_filter') ?? '';

        // 3. Determine default and filter date ranges
        $currentDate = $request->has('date')
            ? Carbon::parse($request->input('date'))
            : Carbon::now();

        // **Key Change: Set Default Start and End Dates to Current Month**
        $defaultStartDate = $currentDate->copy()->startOfMonth();
        $defaultEndDate = $currentDate->copy()->endOfMonth();

        // Use filter dates, or default if filter is not applied
        $startDate = $defaultStartDate;
        $endDate = $defaultEndDate;

        if ($startDateFilter && $endDateFilter && empty($specialDateFilter)) {
            try {
                $startDate = Carbon::parse($startDateFilter);
                $endDate = Carbon::parse($endDateFilter);
            } catch (\Exception $e) {
                // Invalid date format, handle error here
                $startDateFilter = null;
                $endDateFilter = null;
                $startDate = $defaultStartDate;
                $endDate = $defaultEndDate;
            }
        }

        // 4. Generate the date labels within the *selected* range
        $dateLabels = [];
        if ($specialDateFilter === 'start_date' || $specialDateFilter === 'end_date') {
            $dateLabels = [Carbon::today()->format('Y-m-d'), Carbon::tomorrow()->format('Y-m-d')];
        } else {
            $current = $startDate->copy();
            while ($current->lte($endDate)) {
                $dateLabels[] = $current->format('Y-m-d');
                $current->addDay();
            }
        }

        // 5. Prepare the data for the matrix chart
        $matrixData = [];

        // Determine which vehicles to display on the Y-axis
        $displayVehicles = $vehicles;
        if (!empty($vehicleFilter) && empty($specialDateFilter)) {
            $displayVehicles = Vehicle::whereIn('id', $vehicleFilter)->get();
        }

        // Ensure $displayVehicles is always a Collection
        if ($displayVehicles instanceof \Illuminate\Database\Eloquent\Collection) {
            $displayVehicles = collect($displayVehicles->all());
        } elseif (!($displayVehicles instanceof Collection)) {
            $displayVehicles = collect($displayVehicles);
        }

        $vehicleNames = $displayVehicles->pluck('name')->toArray();

        // Prepare data for the matrix chart
        foreach ($displayVehicles as $vehicle) {
            foreach ($dateLabels as $dateLabel) {
                $isBooked = false; // Initialize to false

                //Start adding condition is_reject so all result will now reject if is_rejected =1 in booking database
                 $bookingQuery = Booking::join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
                       ->where('vehicles.id', $vehicle->id)
                       ->where('bookings.is_rejected', 0) // AND condition for is_reject=0
                        ->whereDate('bookings.pickUpDate', '<=', $dateLabel)
                        ->whereDate('bookings.collectionDate', '>=', $dateLabel);

               if (!empty($vehicleFilter)  && empty($specialDateFilter)) {
                  $bookingQuery->whereIn('vehicles.id', $vehicleFilter);
               }

                if ($specialDateFilter === 'start_date') {
                     $isBooked = Booking::where('vehicle_id', $vehicle->id)
                        ->whereDate('bookings.pickUpDate', $dateLabel)
                         ->where('is_rejected', 0)  // Also exclude rejected
                         ->exists();
                } elseif ($specialDateFilter === 'end_date') {
                  $isBooked = Booking::where('vehicle_id', $vehicle->id)
                        ->whereDate('bookings.collectionDate', $dateLabel)
                       ->where('is_rejected', 0)  // Also exclude rejected
                        ->exists();
                } else {
                    $isBooked = $bookingQuery->exists();
                }

                $matrixData[] = [
                    'vehicle' => $vehicle->name,
                    'date' => $dateLabel,
                    'booked' => $isBooked,
                ];
            }
        }
        $totalBookings = count($matrixData);
        $totalRevenue = collect($matrixData)->where('booked', true)->count();

        $noDataMessage = empty($matrixData) ? 'No data available for the selected filters.' : null;

        return view('backend.analytics.index', compact('vehicles', 'dateLabels', 'matrixData', 'currentDate', 'startDateFilter', 'endDateFilter', 'vehicleFilter', 'specialDateFilter', 'vehicleNames', 'noDataMessage', 'totalBookings', 'totalRevenue'));
    }

    public function exportData(Request $request)
    {
        $matrixData = json_decode($request->input('matrix_data'), true); // Important: Decode JSON data
        $filename = 'vehicle_bookings.csv';  // Fixed filename
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($matrixData) {
            $output = fopen('php://output', 'w');

            // Add a UTF-8 BOM (Byte Order Mark) to correctly handle UTF-8 characters in Excel
            fputs($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // CSV Header Row
            fputcsv($output, ['Vehicle', 'Date', 'Booked']);

            // CSV Data Rows
            foreach ($matrixData as $row) {
                fputcsv($output, [
                    $row['vehicle'],
                    $row['date'],
                    $row['booked'] ? 'Booked' : 'Available',
                ]);
            }

            fclose($output);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

  public function sendEmail(Request $request)
   {
       try {
            $matrixData = json_decode($request->input('matrix_data'), true);
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AnalyticsReport($matrixData));
              return response()->json(['message' => 'Email sent successfully!']);

        } catch (\Exception $e) {
            \Log::error("Error sending email: " . $e->getMessage());
            return response()->json(['message' => 'Error sending email.'], 500);
      }
   }
}
