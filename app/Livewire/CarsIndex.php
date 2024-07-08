<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\WithPagination;
use App\Models\Vehicle;
use Modules\Car\Models\Car;

class CarsIndex extends Component
{

    public $car = '';
    public $van = '';
    public $minibus = '';
    public $prestige = '';
    public $convertible = '';
    public $coupe = '';
    public $exoticcars = '';
    public $hatchback = '';
    public $minivan = '';
    public $pickuptruck = '';
    public $sedan = '';
    public $sportscar = '';
    public $stationwagon = '';
    public $suv = '';

    public $seats2 = '';
    public $seats4 = '';
    public $seats6 = '';
    public $seats6plus = '';

    public $price = '';

    protected $paginationTheme = 'bootstrap';

    public function updateSearchPrice($val)
    {
        $this->price = intval($val);
        // dd($this->price);
    }

    public function render()
    {
        $vehicles = Vehicle::orderBy('id', 'desc');

        $vehicles->when($this->price, function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->where('Dprice', '<=', $this->price)
                         ->orWhere('wprice', '<=', $this->price)
                         ->orWhere('mprice', '<=', $this->price);
            });
        });

        //car type
        $hasTypeFilter = $this->car || $this->van || $this->minibus || $this->prestige;
        $vehicles->when($hasTypeFilter, function ($query) {
            return $query->where(function ($subQuery) {
                if ($this->car) {
                    $subQuery->orWhere('type', 'Car');
                }
                if ($this->van) {
                    $subQuery->orWhere('type', 'Van');
                }
                if ($this->minibus) {
                    $subQuery->orWhere('type', 'Minibus');
                }
                if ($this->prestige) {
                    $subQuery->orWhere('type', 'Prestige');
                }
            });
        });
        //car body type
        $hasTypeFilter = $this->convertible || $this->coupe || $this->exoticcars || $this->hatchback || $this->minivan || $this->pickuptruck || $this->sedan || $this->sportscar || $this->stationwagon || $this->suv;
        $vehicles->when($hasTypeFilter, function ($query) {
            return $query->where(function ($subQuery) {
                if ($this->convertible) {
                    $subQuery->orWhere('body', 'Convertible');
                }
                if ($this->coupe) {
                    $subQuery->orWhere('body', 'Coupe');
                }
                if ($this->exoticcars) {
                    $subQuery->orWhere('body', 'Exoticcars');
                }
                if ($this->hatchback) {
                    $subQuery->orWhere('body', 'Hatchback');
                }
                if ($this->minivan) {
                    $subQuery->orWhere('body', 'Minivan');
                }
                if ($this->pickuptruck) {
                    $subQuery->orWhere('body', 'Pickuptruck');
                }
                if ($this->sedan) {
                    $subQuery->orWhere('body', 'Sedan');
                }
                if ($this->sportscar) {
                    $subQuery->orWhere('body', 'Sportscar');
                }
                if ($this->stationwagon) {
                    $subQuery->orWhere('body', 'Stationwagon');
                }
                if ($this->suv) {
                    $subQuery->orWhere('body', 'Suv');
                }
            });
        });
        // cars seates
        $hasTypeFilter = $this->seats2 || $this->seats4 || $this->seats6 || $this->seats6plus;
        $vehicles->when($hasTypeFilter, function ($query) {
            return $query->where(function ($subQuery) {
                if ($this->seats2) {
                    $subQuery->orWhere('seat', '2 seats');
                }
                if ($this->seats4) {
                    $subQuery->orWhere('seat', '4 seats');
                }
                if ($this->seats6) {
                    $subQuery->orWhere('seat', '6 seats');
                }
                if ($this->seats6plus) {
                    $subQuery->orWhere('seat', '6+ seats');
                }
            });
        });

        $vehicles = $vehicles->paginate(6);
        // dd($vehicles);
        return view('livewire.cars-index', compact('vehicles'));
    }
}
