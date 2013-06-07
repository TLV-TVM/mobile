// handling document ready and phonegap deviceready
window.addEventListener('load', function () {
    document.addEventListener('deviceready', onDeviceReady, false);
}, false);

// Phonegap is loaded and can be used
function onDeviceReady(){
	getPosition();
}

// get current position and show map
function getPosition(){	
	var geoOptions = { enableHighAccuracy: true, timeout: 10000 };
	navigator.geolocation.getCurrentPosition(function(position){ // geoSuccess
	
		alert("geoloc OK");
	
		var geolocation = $('#geolocation');
		geolocation.html('<table></table>');
		
		var table = geolocation.find('table');
		if(position.coords.latitude)
			table.append('<tr><th>Latitude</th><td>' + position.coords.latitude + '</td></tr>');
		if(position.coords.longitude)
			table.append('<tr><th>Longitude</th><td>' + position.coords.longitude + '</td></tr>');
		if(position.coords.altitude)
			table.append('<tr><th>Altitude</th><td>' + position.coords.altitude + '</td></tr>');
		if(position.coords.accuracy)
			table.append('<tr><th>Accuracy</th><td>' + position.coords.accuracy + '</td></tr>');
		if(position.coords.altitudeAccuracy)
			table.append('<tr><th>Altitude Accuracy</th><td>' + position.coords.altitudeAccuracy + '</td></tr>');
		if(position.coords.heading)
			table.append('<tr><th>Heading</th><td>' + position.coords.heading + '</td></tr>');
		if(position.coords.speed)
			table.append('<tr><th>Speed</th><td>' + position.coords.speed + '</td></tr>');
		if(position.coords.timestamp)
			table.append('<tr><th>Timestamp</th><td>' + new Date(position.timestamp) + '</td></tr>');
			
		/* show position on map */
		var map_canvas = $('#map_canvas'); 
		map_canvas.gmap(
			{'center' : position.coords.latitude + ',' + position.coords.longitude,
			'zoom' : 12,
			'disableDefaultUI':true,
			'callback':function(){
				var self = this;
				var marker = self.addMarker({ 'position' : this.get('map').getCenter() });
				marker.click(function(){
					self.openInfoWindow({ 'content' : 'This is your current location' }, this);
				});
			}	
		});
		
	}, function(error){ // geoError
		navigator.notification.alert('error: ' + error.message + '\n' + 'code: ' + error.code);
	}, geoOptions);
}