<?php

namespace App\Http\Requests\Pictures;

use App\Highlight;
use App\Picture;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class StoreRequest extends FormRequest {

  protected $model;

  public function __construct(Request $request) {
    $this->request = $request;
  }

  public function authorize() {
    return auth()->check();
  }

  public function rules() {
    return [
      'picture.*' => 'required|mimes:jpeg,gif,png',
      'lat' => 'nullable|numeric',
      'lon' => 'nullable|numeric',
      'datetime_taken' => 'nullable|date_format:Y-m-d\\TH:i',
    ];
  }

  public function model() {
    return $this->model;
  }

  public function store(Highlight $highlight) {
    foreach($this->file('picture') as $image) {
      $this->model = new Picture($this->getInput($highlight, $image));
      $highlight->pictures()->save($this->model);
    }
  }

  protected function getGeoPoints(Highlight $highlight, Image $image) {
    $coords = ['lat' => $highlight->lat, 'lon' => $highlight->lon];
    try {
      $exif = $image->exif();
      if (isset($exif['GPSLatitude'])) {
        $coords['lat'] = $this->getGPS($exif['GPSLatitude'], $exif['GPSLatitudeRef']);
      }
      if (isset($exif['GPSLatitude'])) {
        $coords['lon'] = $this->getGPS($exif['GPSLongitude'], $exif['GPSLongitudeRef']);
      }
    } catch (Exception $e) {
    }
    return $coords;
  }

  protected function getDateTimeTaken(Highlight $highlight, Image $image) {
    $date = $highlight->start_date;
    try {
      $exif = $image->exif();
      if (isset($exif['DateTimeOriginal'])) {
        $date = new \DateTime($exif['DateTimeOriginal']);
      }
    } catch (Exception $e) {
      dd($e);
    }
    return $date;
  }

  protected function getInput(Highlight $highlight, $image) {
    $input = Request::input();
    $img = \Image::make($image->path());
    if (empty($input['lat']) || empty($input['lon'])) {
      $coords = $this->getGeoPoints($highlight, $img);
      $input['lat'] = $coords['lat'];
      $input['lon'] = $coords['lon'];
    }
    if (empty($input['datetime_taken'])) {
      $input['datetime_taken'] = $this->getDateTimeTaken($highlight, $img);
    } else {
      $input['datetime_taken'] = Carbon::createFromFormat("Y-m-d\\TH:i", $input['datetime_taken']);
    }
    $img->orientate();
    $uploadPath = 'pictures/' . $highlight->trip_id . '/' . $highlight->id . '/' . $image->hashName();
    Storage::cloud()->put($uploadPath, (string)$img->stream());
    $input['url'] = $uploadPath;
    return $input;
  }

  // https://stackoverflow.com/a/16437888
  private function getGPS(array $coordinate, string $hemisphere) {
    if (is_string($coordinate)) {
      $coordinate = array_map("trim", explode(",", $coordinate));
    }
    for ($i = 0; $i < 3; $i++) {
      $part = explode('/', $coordinate[$i]);
      if (count($part) == 1) {
        $coordinate[$i] = $part[0];
      } else if (count($part) == 2) {
        $coordinate[$i] = floatval($part[0])/floatval($part[1]);
      } else {
        $coordinate[$i] = 0;
      }
    }
    list($degrees, $minutes, $seconds) = $coordinate;
    $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
    return $sign * ($degrees + $minutes/60 + $seconds/3600);
  }
}
