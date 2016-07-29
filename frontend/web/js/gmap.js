// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.

function initialize() {
  var image = 'images/hal.png';
  
  var NHUEG = new google.maps.LatLng(47.919151,106.924547);
  var mapOptions = {
    zoom: 17,
    center: NHUEG
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">НХҮЕГ</h1>'+
      '<div id="bodyContent">'+
      '<img src="images/building.jpg" width="100" height="100" align="left"><b>Хаяг : </b>, УБ хот, Сүхбаатар дүүрэг, 8 хороо, <br>Бага тойруу 44А <br>Төрийн өмчийн <b>XI</b> байр' +
      '</div>'+
      '</div>';


  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });


  var NHUEG = new google.maps.Marker({
      position: NHUEG,
      map: map,
      title: 'НХҮЕГ',
      icon: image
  });
  google.maps.event.addListener(NHUEG, 'click', function() {
    infowindow.open(map,NHUEG);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);