<html>
<head>
  <title>A Leaflet map!</title>
  <link rel="stylesheet" href="./leaflet.css"/>
  <link rel="stylesheet" href="./MarkerCluster.css">
  
  <script src="./leaflet.js"></script>
   <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script> 
   <script src="./MarkerCluster.js"></script>
   <script src="./leaflet-heat.js"></script>

  <style>
    #map{ height: 100% }
  </style>
</head>
<body>

  <div id="map">

  <script>

  // initialize the map
  var map = L.map('map').setView([42.35, -71.08], 13);

  // load a tile layer
  L.tileLayer('http://tiles.mapc.org/basemap/{z}/{x}/{y}.png',
    {
      attribution: 'Tiles by <a href="http://mapc.org">MAPC</a>, Data by <a href="http://mass.gov/mgis">MassGIS</a>',
      maxZoom: 17,
      minZoom: 9
    }).addTo(map);
	
	
	
	
	$.getJSON("https://maptimeboston.github.io/leaflet-intro/neighborhoods.geojson",function(hoodData){
	    L.geoJson( hoodData, {
      style: function(feature){
        var fillColor,
            density = feature.properties.density;
        if ( density > 80 ) fillColor = "#006837";
        else if ( density > 40 ) fillColor = "#31a354";
        else if ( density > 20 ) fillColor = "#78c679";
        else if ( density > 10 ) fillColor = "#c2e699";
        else if ( density > 0 ) fillColor = "#ffffcc";
        else fillColor = "#f7f7f7";  // no data
        return { color: "#999", weight: 1, fillColor: fillColor, fillOpacity: .6 };
      },
      onEachFeature: function( feature, layer ){
        layer.bindPopup( "<strong>" + feature.properties.Name + "</strong><br/>" + feature.properties.density + " rats per square mile" )
      }
    }).addTo(map);
  });
 
  $.getJSON("rodents.geoson",function(data){
    
    var ratIcon = L.icon({
      iconUrl: 'http://andywoodruff.com/maptime-leaflet/rat.png',
      iconSize: [60,50]
    });
    var rodents = L.geoJson(data,{
      pointToLayer: function(feature,latlng){
        var marker = L.marker(latlng,{icon: ratIcon});
        marker.bindPopup(feature.properties.Location + '<br/>' + feature.properties.OPEN_DT);
        return marker;
      }

    });
    var clusters = L.markerClusterGroup();
    clusters.addLayer(rodents);
    map.addLayer(clusters);

  });
	
/*
$.getJSON("https://maptimeboston.github.io/leaflet-intro/neighborhoods.geojson",function(hoodData){
  L.geoJson( hoodData  , {
    style: function(feature){
      var fillColor,
          density = feature.properties.density;
      if ( density > 80 ) fillColor = "#006837";
      else if ( density > 40 ) fillColor = "#31a354";
      else if ( density > 20 ) fillColor = "#78c679";
      else if ( density > 10 ) fillColor = "#c2e699";
      else if ( density > 0 ) fillColor = "#ffffcc";
      else fillColor = "#f7f7f7";  // no data
      return { color: "#999", weight: 1, fillColor: fillColor, fillOpacity: .6 };
    },
    onEachFeature: function( feature, layer ){
      layer.bindPopup( "<strong>" + feature.properties.Name + "</strong><br/>" + feature.properties.density + " rats per square mile" )
    }
  }  ).addTo(map);
});

 $.getJSON("rodents.geoson",function(data){
    var ratIcon = L.icon({
      iconUrl: 'http://andywoodruff.com/maptime-leaflet/rat.png',
      iconSize: [60,50]
    });
    var rodents = L.geoJson(data,{
      pointToLayer: function(feature,latlng){
        var marker = L.marker(latlng,{icon: ratIcon});
        marker.bindPopup(feature.properties.Location + '<br/>' + feature.properties.OPEN_DT);
        return marker;
      }
    });
    var clusters = L.markerClusterGroup();
    clusters.addLayer(rodents);
    map.addLayer(clusters);
  });

$.getJSON("rodents.geoson",function(data){
    var ratIcon = L.icon({
    iconUrl: 'rat.gif',
    iconSize: [50,40]
  }); 
  L.geoJson(data  ,{
    pointToLayer: function(feature,latlng){
    var marker = L.marker(latlng,{icon: ratIcon});
  marker.bindPopup(feature.properties.Location + '<br/>' + feature.properties.OPEN_DT);
  return marker; 
}
  }  ).addTo(map);
});


 var rodents =   L.geoJson(data,{
  pointToLayer: function(feature,latlng){
    var marker = L.marker(latlng,{icon: ratIcon});
    marker.bindPopup(feature.properties.Location + '<br/>' + feature.properties.OPEN_DT);
    return marker;
  }
});
var clusters = L.markerClusterGroup();
clusters.addLayer(rodents);
map.addLayer(clusters); 

//HEAT MAP
$.getJSON("rodents.geoson",function(data){
   var locations = data.features.map(function(rat) {
    var location = rat.geometry.coordinates.reverse();
    location.push(0.5);
    return location;
  });

  var heat = L.heatLayer(locations, { radius: 35 });
  map.addLayer(heat); 
});

*/

  </script>
  
  
  </div>
  
  <div id = "MenuBar">
  
  
  </div>
</body>
</html>
