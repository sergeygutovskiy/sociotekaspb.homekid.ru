<?php

namespace App\Http\Services\Client\File;

use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class CompanyFileService
{
    public static function download(Company $company)
    {
        $pdf = Pdf::loadView('pdf.company.index', [ 'company' => $company ]);
        return $pdf->download(Str::slug($company->name) . '.pdf');
    }
}
