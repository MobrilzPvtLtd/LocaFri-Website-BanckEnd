<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vehicle;

class CarsIndex extends Component
{
    use WithPagination;

    public $car, $van, $minibus, $prestige;
    public $convertible, $coupe, $exoticcars, $hatchback, $minivan;
    public $pickuptruck, $sedan, $sportscar, $stationwagon, $suv;
    public $selectedSeats = []; // Dynamic Seat Filter
    public $trans1, $trans2;
    public $price;

    protected $paginationTheme = 'bootstrap';

    public function updateSearchPrice($val)
    {
        $this->price = intval($val);
    }

    public function render()
    {
        // Fetch unique seat counts dynamically from the Vehicle table
        $availableSeats = Vehicle::where('status', 1)
            ->select('seat')
            ->distinct()
            ->pluck('seat')
            ->sort();

        // Initialize query
        $query = Vehicle::query()->where('status', 1)->orderBy('id', 'desc');

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

        // Paginate Results
        $vehicles = $query->paginate(6);

        return view('livewire.cars-index', [
            'vehicles' => $vehicles,
            'availableSeats' => $availableSeats,
        ]);

        // Paginate Results
        $vehicles = $query->paginate(6);

        return view('livewire.cars-index', ['vehicles' => $vehicles]);

    }
}

