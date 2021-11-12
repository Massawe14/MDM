<?php

  include('authentication.php');
  include('config/dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Map | View</title>
	<style>
		#map{
			height: 400px;
			width: 100%;
		}
	</style>
</head>
<body>
    <div id="map"></div>
    <?php
      if (isset($_POST['displayMap'])) {
        $display_map = $_POST['display_map'];

        $query = "SELECT location_lat, location_lng FROM devices WHERE device_id='$display_map'";
        $result = mysqli_query($conn, $query);

        foreach ($result as $row) {

        	$positions = (object)[
              'lat' =>   (float)$row['location_lat'],
              'lng' =>   (float)$row['location_lng']
            ];
        }
        $positions = json_encode($positions);
      }
      else {
        echo "No data to display";
      } 
    ?>

    <!-- <script>
      var positions = <?php echo json_encode($positions) ?>;
    </script> -->

    <!-- <script>
      function initMap() {
      	var positions = JSON.parse(`<?php echo ($positions); ?>`);
    	console.log(positions);

        mark = 'assets/dist/img/ip-address.png';
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {
          	'lat' : positions.lat,
          	'lng' : positions.lng
          }
        });

        positions.forEach(function(position){
          var marker = new google.maps.Marker({
            position: {
              'lat' : position.lat,
              'lng' : position.lng
            },
            map: map,
            icon: mark,
            title: position.title
          });
        });
      }
    </script> -->

    <script>

    	var positions = JSON.parse(`<?php echo ($positions); ?>`);
    	console.log(positions);
    	console.log("lat", positions.lat);
    	console.log("lng", positions.lng);

        function initMap(){
          // Map options
          var mapOptions = {
            zoom: 8,
            center: {
            	lat: positions.lat,
            	lng: positions.lng
            }
          }
          
          // new map
          var map = new google.maps.Map(document.getElementById('map'), mapOptions);

          // Add Marker
          var marker = new google.maps.Marker({
            position: {
            	lat: positions.lat,
            	lng: positions.lng
            },
            map: map,
            icon: 'assets/dist/img/ip-address.png'
          });

          var infoWindow = new google.maps.InfoWindow({
            content: '<h1>Imperial Distributor</h1>'
          });

          marker.addListener('click', function(){
            infoWindow.open(map, marker);
          });

          google.maps.event.addListener(popup, "closeclick", function() {
            infoWindow.close(map, marker);
          })
        }
    </script>

    <script async defer 
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLra3FKhGBOPGhB1BcgTKlQV35j9Z1szk&callback=initMap">
    </script>

</body>
</html>