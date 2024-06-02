<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Imagick;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        return view('image.create');
    }

    public function store(Request $request)
    {

        $imagick = new Imagick();
        $imagick->readImage($request->file('image_file'));

        $exif_date = $imagick->getImageProperties("exif:*");
        $data = [
            'date'         => Carbon::parse($exif_date['exif:DateTimeOriginal'] ?? 0000000000)?->format('Y年m月d日 h時i分s秒') ?? null,
            'model'        => $exif_date['exif:Model'] ?? null,
            'latitude'     => $exif_date['exif:GPSLatitude'] ?? null,
            'latitude_ref'  => $exif_date['exif:GPSLatitudeRef'] ?? null,
            'longitude'    => $exif_date['exif:GPSLongitude'] ?? null,
            'longitude_ref' => $exif_date['exif:GPSLongitudeRef'] ?? null,
        ];

        if(is_null($data['latitude']) && is_null($data['latitude_ref']) && is_null($data['longitude']) && is_null($data['longitude'])){
            return json_encode([
                'result' => 'none'
            ]);
        }else{
            header('Location:' . $this->convertGpsToDecimal($data));
            exit();
        }   
    }

    public function show(Request $request)
    {
        
    }

    public function edit(Request $request)
    {

    }

    private function convertGpsToDecimal($data)
    {
        $latitube_data = explode(',', $data['latitude']);
        $longitude_data = explode(',', $data['longitude']);
        
        $latitube = array_map(function($latitube_data) {
            $values = explode('/', $latitube_data);
            return [intval($values[0])/intval($values[1])];
        }, $latitube_data);

        $longitude = array_map(function($longitude_data) {
            $values = explode('/', $longitude_data);
            return [intval($values[0])/intval($values[1])];
        }, $longitude_data);

        $latitube_decimal = $latitube[0][0] + ($latitube[1][0] / 60) + ($latitube[2][0] / 3600);
        $longitube_decimal = $longitude[0][0] + ($longitude[1][0] / 60) + ($longitude[2][0] / 3600);

        if ($data['latitude_ref'] == 'S') {
            $latitube_decimal *= -1;
        }

        if ($data['longitude_ref'] == 'W') {
            $longitube_decimal *= -1;
        }

        $response = [
            $latitube_decimal,
            $longitube_decimal
        ];

        return ('https://www.google.co.jp/maps/place/'. $latitube_decimal . ',' . $longitube_decimal);
    }
}
