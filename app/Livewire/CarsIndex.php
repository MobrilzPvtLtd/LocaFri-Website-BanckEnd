<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vehicle;
use App\Models\Booking;
use Carbon\Carbon;

class CarsIndex extends Component
{
    use WithPagination;

    public $car, $van, $minibus, $prestige;
    public $convertible, $coupe, $exoticcars, $hatchback, $minivan;
    public $pickuptruck, $sedan, $sportscar, $stationwagon, $suv;
    public $selectedSeats = [];
    public $trans1, $trans2;
    public $price;

    protected $paginationTheme = 'bootstrap';

    public function updateSearchPrice($val)
    {
        $this->price = intval($val);
    }

    public function render()
    {
        $availableSeats = Vehicle::where('status', 1)
            ->select('seat')
            ->distinct()
            ->pluck('seat')
            ->sort();

        $query = Vehicle::where('status', 1)->orderBy('id', 'desc');
        $dataArray = $query->pluck('id')->toArray();
        $startDate = Carbon::parse(session('startDate'))->format('Y-m-d');
         $endDate = Carbon::parse(session('endDate'))->format('Y-m-d');
         $bookedVehicleIds = Booking::whereIn('vehicle_id', $dataArray)
             ->where(function ($q) use ($startDate, $endDate) {
                 $q->whereDate('pickUpDate', '>=', $startDate)
                   ->whereDate('collectionDate', '<=', $endDate);
             })
             ->pluck('vehicle_id')
             ->toArray();

             // Filter by Price
        $query->when($this->price, function ($q) {
            $q->where(function ($subQuery) {
                $subQuery->where('Dprice', '<=', $this->price)
                    ->orWhere('wprice', '<=', $this->price)
                    ->orWhere('mprice', '<=', $this->price);
            });
        });

        // Filter by Vehicle Type
        $vehicleTypes = [
            'Car' => $this->car, 'Van' => $this->van,
            'Minibus' => $this->minibus, 'Prestige' => $this->prestige
        ];
        $query->when(array_filter($vehicleTypes), function ($q) use ($vehicleTypes) {
            $q->whereIn('type', array_keys(array_filter($vehicleTypes)));
        });

        // Filter by Body Type
        $bodyTypes = [
            'Convertible' => $this->convertible, 'Coupe' => $this->coupe,
            'Exoticcars' => $this->exoticcars, 'Hatchback' => $this->hatchback,
            'Minivan' => $this->minivan, 'Pickuptruck' => $this->pickuptruck,
            'Sedan' => $this->sedan, 'Sportscar' => $this->sportscar,
            'Stationwagon' => $this->stationwagon, 'Suv' => $this->suv,
        ];
        $query->when(array_filter($bodyTypes), function ($q) use ($bodyTypes) {
            $q->whereIn('body', array_keys(array_filter($bodyTypes)));
        });

        // Filter by Seats
        $query->when(!empty($this->selectedSeats), function ($q) {
            $q->whereIn('seat', $this->selectedSeats);
        });

        // Filter by Transmission
        $transmissions = [];
        if ($this->trans1) $transmissions[] = 'Automatic';
        if ($this->trans2) $transmissions[] = 'Manual';

        $query->when(!empty($transmissions), function ($q) use ($transmissions) {
            $q->whereIn('trans', $transmissions);
        });
        $vehicles = Vehicle::whereNotIn('id', $bookedVehicleIds)
        ->where('status', '!=', 0)
        ->paginate(6);
        return view('livewire.cars-index', [
            'vehicles' => $vehicles,
            'availableSeats' => $availableSeats,
        ]);

    }
}

