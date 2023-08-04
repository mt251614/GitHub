<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;

class LocationController extends Controller
{
    public function index()
    {
        return view('location.index');
    }

    public function store(Request $request)
    {
        $location = new Location;
        $location->customer_name = $request->input('customer_name');
        $location->driver_name = $request->input('driver_name');
        $location->latitude = $request->input('latitude');
        $location->longitude = $request->input('longitude');
        $location->save();

        return redirect()->back()->with('success', 'Location saved successfully.');
    }

    public function exportCSV(Request $request)
    {
        $driver = $request->input('driver'); // 取得篩選的司機名稱

        $locations = Location::where('driver_name', $driver)->get();

        $csvExporter = Writer::createFromFileObject(new \SplTempFileObject());
        $csvExporter->setOutputBOM(Writer::BOM_UTF8);

        // 寫入 CSV 標題列
        $csvExporter->insertOne(['客戶姓名', '司機姓名', '緯度', '經度']);

        // 寫入資料列
        foreach ($locations as $location) {
            $csvExporter->insertOne([$location->customer_name, $location->driver_name, $location->latitude, $location->longitude]);
        }

        // 設定檔案回應的標頭
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="locations.csv"',
        ];

        // 回傳 CSV 檔案作為回應
        return Response::make($csvExporter->toString(), 200, $headers)
            ->header('Content-Type', 'text/csv; charset=UTF-8'); // 指定回應的編碼為 UTF-8
    }
}
