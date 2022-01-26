<?php

namespace App\Services;

class UploadService
{
    public function dispach()
    {
        $typeUpload = $this->getTypeUpload();
        dispatch();
    }

    public function getTypeUpload(string $name)
    {
        switch($name) {
            case: ''
        }
    }
    public function upload($request)
    {
        $fileUpload = $request->file('arquivo');
        $fileRequest = $request->file('arquivo')->store('uploads');
        // $path = $fileRequest->getRealPath();

        // $filename = $fileRequest->getClientOriginalName();
        $location = 'uploads';
        $filepath = storage_path('app/' . $fileRequest);

        $file = fopen($filepath, 'r');
        $data = array();

        $header = fgetcsv($file);

        $i = 0;
        while (($fileData = fgetcsv($file))) {
            $num = count($fileData);

            if ($fileData[0] == "") {
                continue;
            }


            for ($c = 0; $c < $num; $c++) {
                $data[$i][] = $fileData[$c];
            }
            $i++;
            $arr = $this->mount($data, $header);
        }
        fclose($file);
        dd($arr);
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
