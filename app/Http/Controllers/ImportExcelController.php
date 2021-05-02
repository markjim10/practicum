<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Imports\ApplicantsImport;
use App\Imports\AppResultsImport;
use App\Imports\ExamResultsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function import_users()
    {
        Excel::import(new UsersImport, request()->file('file'));
        return back();
    }

    public function import_applicants()
    {
        Excel::import(new ApplicantsImport, request()->file('file'));
        return back();
    }

    public function import_results()
    {
        Excel::import(new AppResultsImport, request()->file('file'));
        return back();
    }
}
