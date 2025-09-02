<?php

namespace App\Http\Controllers\Export;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportXlsx()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }
}
