
<style>
	
#gmap0-map-canvas {
  width:100% !important;
}
</style>

<?php 

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

$model = \app\models\GeneralInfo::findOne(1);
if(sizeof($model)!=0){
$string = $model->google_gps;
if(strlen($string)>1){
$location = explode(",",$string);

$image = 'images/hal.png';
$welfare_branch = new LatLng(['lat' => $location[0], 'lng' => $location[1]]);
$map = new Map([
    'center' => $welfare_branch,
    'zoom' => 17,
]);


$marker = new Marker([
    'position' => $welfare_branch,
    'title' => $model->title,
     'icon' => $image
]);

$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<h1 id="firstHeading" class="firstHeading">НХҮХ</h1><div id="bodyContent"> <b>Хаяг : </b>, '.$model->address.''

    ])
);

$map->addOverlay($marker);

echo $map->display();}}?>