<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GeneaLabs\LaravelMaps\Facades\Map;
Use App\Repositories\Weathers;
use App\Weatherstation;
use App\Repositories\CityWeather;
use DB;
use GuzzleHttp\Client;

class FrontController extends Controller
{
   
   protected $weathers;

   public function _construct(Weathers $weathers){

    $this->weathers = $weathers;

   }


    public function getIndex()
    {

      $client = new Client();

      
      $ws =  weatherstation::all();

      $config = array();
      $config['map_height'] = '708px';
      
      $config['zoom'] = '7';
      $config['draggableCursor'] = 'default';
      $config['center'] = '-1.614444,-78.998333';
      $config['map_type'] = 'HYBRID';
      
      


       foreach ($ws as $map) {

      $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?lat='.$map->lat.'&lon='.$map->lon.'&appid=e6adfa272ccef59b2e4c9848be8aad08');

      $weathers = json_decode($response->getbody()->getContents());
      
      $tempC = $weathers->main->temp-273.15;

      $marker = array();
     // $marker['label'] = $map->name;
      $marker['position'] = $map->lat. ','. $map->lon;
      $marker['infowindow_content'] ='ESTACION METEREOLOGICA<br>' .$map->name.'<br>Código: '.$map->code.'<br>Latitud: '.$map->lat.'<br>Longitud: '.$map->lon.'<br>Temperatura: '.$tempC.' °C<br>Presión: '.$weathers->main->pressure.'hPa<img src="/front/assets/images/gauge64.png" alt="" width="25"><br>Humedad: '.$weathers->main->humidity.' %<img src="/front/assets/images/humidity64.png" alt="" width="25"><br>Viento: '.$weathers->wind->speed.'km/h<img src="/front/assets/images/wind64.png" alt="" width="25">';

     
      $marker['icon'] = 'front/assets/img/icon/'.$weathers->weather[0]->icon.'.png';
     
      Map::add_marker($marker);


    }

      Map::initialize($config);
      $map = Map::create_map();
        
       //$data['maps'] = $map;
       //dd($data);

      return view('home')->with('map', $map);
      //  return view('home')->with($data);

    }

   public function getSigleWeather(){
     $client = new Client();

     //$wsid =  weatherstation::find($id);

      $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=quito&appid=e6adfa272ccef59b2e4c9848be8aad08');

      $wid = json_decode($response->getbody()->getContents());
     //dd($wid);
      $cW = new CityWeather($wid);
     //$country = $cW->getCountry();
     //dd($country);

      $dat['country'] = $cW->getCountry();

        //dd($data);
      return view('layouts.partials.modalforecast',$dat);

   }

    public function getWeatherToday(){

      $client = new Client();

      $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=quito&appid=e6adfa272ccef59b2e4c9848be8aad08');

      $weathers = json_decode($response->getbody()->getContents());

     

      return view('home',compact('weathers'));

    }
}
