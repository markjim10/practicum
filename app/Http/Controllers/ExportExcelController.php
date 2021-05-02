<?php

namespace App\Http\Controllers;

use App\Exports\ApplicantsExport;
use App\Exports\AppResultsExport;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportApplicants()
    {
        return Excel::download(new ApplicantsExport, 'applicants.xlsx');
    }

    public function exportAppResults()
    {
        return Excel::download(new AppResultsExport, 'appResults.xlsx');
    }
}
