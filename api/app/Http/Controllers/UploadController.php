<?php

namespace App\Http\Controllers;

use App\Imports\UploadsImport;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    private UploadService $service;

    public function __construct(UploadService $service)
    {
        $this->service = $service;
    }

    public function upload(Request $request)
    {
        Excel::import(new UploadsImport, $request->file('arquivo'));
        //(new UploadsImport)->queue($request->file('arquivo'));
        //$this->service->dispach($request);
    }

    private function mount($importData, $header)
    {
        $i = 0;
        $value = '';
        foreach ($importData as $data) {
            $value = $data;
        }

        return array_combine($header, $value);
    }
}
