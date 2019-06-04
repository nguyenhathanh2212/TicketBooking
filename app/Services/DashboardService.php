<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\User;
use App\Models\Station;
use App\Models\Provincial;

class DashboardService extends BaseService
{
    protected $company;
    protected $station;
    protected $provincial;
    protected $user;

    /**
     * CompanyService constructor.
     * @param Image $image
     */
    public function __construct(
        Company $company,
        User $user,
        Station $station,
        Provincial $provincial
    ) {
        $this->model = null;
        $this->company = $company;
        $this->station = $station;
        $this->provincial = $provincial;
        $this->user = $user;
    }

    public function getStatistic()
    {
        return [
            'companyCount' => $this->company->count(),
            'stationCount' => $this->station->count(),
            'userCount' => $this->user->count(),
            'provincialCount' => $this->provincial->count(),
        ];
    }
}
