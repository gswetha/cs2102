jQuery().ready(function (){ 
	initMarkers();
	loadMarkers();
	$('#faclisttab tbody tr').mouseover(function() {
		id = $(this).attr('id');
		highLight(id.replace(/fac/,''));
     }).mouseout(function() {
    	 id = $(this).attr('id');
 		unHighLight(id.replace(/fac/,''));
     });
});

var bounds = new google.maps.LatLngBounds();
var statesList;
var addressValue="";
var countyList;
var geocoder;
var locmap;
var infowindow=[]; 
var marker=[];
var latlng;
var map=0;
var markercount=0;
var netData=[];
var markerZ= 0;
var markerIcon = "";

function loadMarkers() {
	$.post("/app/app_admin/getMarkers",  function(markers){
		if(markers.length >0) {
			//alert(markers.length);
			netData = markers;
			for (var i=0; i< markers.length; i++) {
				addMarker(markers[i]);
			}
			map.fitBounds(bounds);
		}
	},"json");
}

function initMarkers() {
	
		latlng = new google.maps.LatLng(40, -90);
		var myOptions = {
				zoom: 4,
			 center: latlng,
			 mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map=new google.maps.Map(document.getElementById('map_canvas'), 
			myOptions);
}


function addMarker(marker) {
	var latlng= new google.maps.LatLng(marker.lat, marker.lon);
	infowindow[markercount] = new google.maps.InfoWindow({
		content: '<div class="markerText">'+marker.name+" "+marker.states+ '</div><button onclick="loadContent('+markercount+')">Apply</button>'
});
	netData[markercount].marker = new google.maps.Marker({
      position: latlng, 
	      map: map,
	      title: "Facility"
	  }); 
	google.maps.event.addListener(netData[markercount].marker,'click', function() {
		showInfo(this);
	});
    bounds.extend(latlng);
	markercount++;
}

function loadContent(m) {
	window.location = "/app/"+netData[m].next+"/"+netData[m].step+"/"+netData[m].id+"/application";
}

function showInfo( mark ) {
	  var m=0;
	  for (m = 0; m < netData.length; ++m )
    {
      if ( netData[m].marker === mark ) 
      {
      	infowindow[m].open(map,netData[m].marker);
           return;
      }
    }
	  
}

function highLight(id) {
	 var m=0;
	  for (m = 0; m < netData.length; ++m )
   {
     if ( netData[m].id === id ) 
     {
    	 markerZ = netData[m].marker.getZIndex();
    	 markerIcon = netData[m].marker.getIcon();
    	 netData[m].marker.setZIndex(1000);
    	 netData[m].marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
    //	 infowindow[m].open(map,netData[m].marker);
          return;
     }
   }
}

function unHighLight(id) {
	 var m=0;
	  for (m = 0; m < netData.length; ++m )
  {
    if ( netData[m].id === id ) 
    {
    	netData[m].marker.setZIndex(markerZ);
    	netData[m].marker.setIcon(markerIcon);
   	// infowindow[m].close(map,netData[m].marker);
         return;
    }
  }
}

