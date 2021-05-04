<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function getPreferredPrograms()
    {
        return $this->dashboardService->getPreferredPrograms();
    }

    public function getApplicantsPassingRate()
    {
        return $this->dashboardService->getApplicantsPassingRate();
    }

    public function getExamDates()
    {
        return $this->dashboardService->getExamDates();
    }
}
