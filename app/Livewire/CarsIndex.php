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

        if(session('startDate') || session('endDate')){
            $startDate = Carbon::parse(session('startDate'))->format('Y-m-d');
            $endDate = Carbon::parse(session('endDate'))->format('Y-m-d');
            $bookedVehicleIds = Booking::whereIn('vehicle_id', $dataArray)
                ->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('pickUpDate', [$startDate, $endDate])
                    ->orWhereBetween('collectionDate', [$startDate, $endDate])
                    ->orWhere(function ($q2) use ($startDate, $endDate) {
                        $q2->where('pickUpDate', '<=', $endDate)
                            ->where('collectionDate', '>=', $startDate);
                    });
                })
                ->pluck('vehicle_id')
                ->toArray();
            $query->whereNotIn('id', $bookedVehicleIds)->where('status', '!=', 0);
        }

        if ($this->price) {
            $query->where(function ($subQuery) {
                $subQuery->where('Dprice', '<=', $this->price)
                        ->orWhere('wprice', '<=', $this->price)
                        ->orWhere('mprice', '<=', $this->price);
            });
        }

        $vehicleTypes = [
            'Car' => $this->car, 'Van' => $this->van,
            'Minibus' => $this->minibus, 'Prestige' => $this->prestige
        ];

        $filteredTypes = array_keys(array_filter($vehicleTypes));
        if (!empty($filteredTypes)) {
            $query->whereIn('type', $filteredTypes);
        }

        $bodyTypes = [
            'Convertible' => $this->convertible, 'Coupe' => $this->coupe,
            'Exoticcars' => $this->exoticcars, 'Hatchback' => $this->hatchback,
            'Minivan' => $this->minivan, 'Pickuptruck' => $this->pickuptruck,
            'Sedan' => $this->sedan, 'Sportscar' => $this->sportscar,
            'Stationwagon' => $this->stationwagon, 'Suv' => $this->suv,
        ];

        $filteredBodies = array_keys(array_filter($bodyTypes));
        if (!empty($filteredBodies)) {
            $query->whereIn('body', $filteredBodies);
        }

        if (!empty($this->selectedSeats)) {
            $query->whereIn('seat', $this->selectedSeats);
        }

        $transmissions = [];
        if ($this->trans1) $transmissions[] = 'Automatic';
        if ($this->trans2) $transmissions[] = 'Manual';

        if (!empty($transmissions)) {
            $query->whereIn('trans', $transmissions);
        }
        $vehicles = $query->paginate(6);

        return view('livewire.cars-index', [
            'vehicles' => $vehicles,
            'availableSeats' => $availableSeats,
        ]);
    }

}

