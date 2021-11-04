<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Map</title>
	<style>
		#map{
			height: 400px;
			width: 100%;
		}
	</style>
</head>
<body>
	<h1>Google Map</h1>
	<div id="map"></div>
	<script>
		function initMap(){
			// Map options
			var options = {
				zoom:8,
				center:{
					lat:-6.787500,
					lng:39.274300
				}
			}
            
            // new map
			var map = new google.maps.Map(document.getElementById('map'), options);

			// Listen for click on map
			// google.maps.Map.event.addListener(map, 'click', 
			// 	function(event){
			// 		// Add marker
			// 		addMarker({coords: event.latlng});
			// });

			// Add Marker
			var marker = new google.maps.Marker({
				position: {
					lat:-6.787500,
					lng:39.274300
				},
				map: map,
				icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
			});

			var infoWindow = new google.maps.InfoWindow({
				content: '<h1>Imperial Distributor</h1>'
			});

			marker.addListener('click', function(){
				infoWindow.open(map, marker);
			});

			// Array of markers
			// var markers = [
			//     {
			// 	    coords: {lat:-6.212470, lng:35.810307},
			// 	    iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
			// 	    content: '<h1>Lynn MA</h1>'
		 //       },
		 //       // {
		 //       // 	coords: {lat: 42.8584, lng: -71.0773},
		 //       // 	content: '<h1>Amesbury MA</h1>'
		 //       // }
			// ];

			// Loop through markers
			// for (var i = 0; i < markers.lengths; i++) {
			// 	// Add marker
			// 	addMarker(markers[i]);
			// }

			/*
			addMarker({
				coords: {lat:42.4668, lang:-70.9495},
				iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
				content: '<h1>Lynn MA</h1>'
		    });
		    */

			// Add Marker Function
			// function addMarker(props) {
			// 	var marker = new google.maps.Marker({
			// 	    position: props.coords,
			// 	    map: map,
			// 	    // icon: props.iconImage
			//     });

   //              // Check for custom icon
			//     if (props.iconImage) {
			//     	// Set icon image
			//     	marker.setIcon(props.iconImage);
			//     }

			//     // Check content
			//     if (props.content) {
			//     	var infoWindow = new google.maps.InfoWindow({
			// 	        content: props.content
			//         });

			//         marker.addListener('click', function(){
			// 	        infoWindow.open(map, marker);
			//         });
			//     }
			// }
		}
	</script>
	<script async defer 
	  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaGmjoEOWkGZT9HUU4e8pjN8aapRWfWOc&callback=initMap">
	</script>
</body>
</html>