<?php
    require("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<title>	FOOD SAVING PROJECT</title>
    <body>
    
        <h1>Today Route, <?php echo date("Y-m-d"); ?></h1>
          
        <?php
     
            $query = "SELECT * FROM user INNER JOIN request ON user.u_id=request.u_id where request.r_date = (CURDATE())";
            mysqli_query($conn, $query) or die('Error querying database.');
            
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            $location=array();
            $j=0;
            
            while ($row = mysqli_fetch_array($result)) {
                $location[$j][0] = $row['name'];
                $location[$j][1] = $row['lat'];
                $location[$j][2] = $row['lng'];
                $j=$j+1;              
            }
            //print_r($location);
      
        ?>
        <p id="demo"></p>
        
        <div id="map" style="width:100%;height:600px;">
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNqwqKoRsL1nxEwDoYzfo_tlZRZEBR-kU&callback=initMap" type="text/javascript"></script>
                
                <script>
                    function initMap() {
                        
                        var locations=JSON.parse('<?php echo json_encode($location)?>');
                        //document.getElementById("demo").innerHTML = result;
						
                        var map = new google.maps.Map(document.getElementById('map'), {
							zoom: 17,
							center: new google.maps.LatLng(6.958085,80.051213),
							mapTypeId: google.maps.MapTypeId.HYBRID
						  });
					  
						  var infowindow = new google.maps.InfoWindow();
					  
						  var marker, i;
					  
						  for (i = 0; i < locations.length; i++) {  
							marker = new google.maps.Marker({
							  position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							  icon: 'https://goo.gl/iV6xwQ',
							  map: map
							});
					  
							google.maps.event.addListener(marker, 'click', (function(marker, i) {
							  return function() {
								infowindow.setContent(locations[i][0]);
								infowindow.open(map, marker);
								};
								}
								)
								(marker, i));
						  }

                    }
                        
                  google.maps.event.addDomListener(window, 'load', initMap);
                </script>
        	
        </div>
       
    </body>
</html>


<!--<html lang="en">
    <head>

    </head>
       
    <body>

        <iframe src="https://www.google.com/maps/d/embed?mid=1p1UPtc4-kntG95Lqnve2ZC-UYqU" width="640" height="480"></iframe>
        
        
      
    </body>
</html>-->

<!--
//                        var myCenter = new google.maps.LatLng(6.958085,80.051213);
//                        var mapCanvas = document.getElementById("map");
//                        var mapOptions = {center: myCenter, zoom: 20, mapTypeId: google.maps.MapTypeId.HYBRID};
//                        var map = new google.maps.Map(mapCanvas, mapOptions);
//						
//                        var marker = new google.maps.Marker({position:myCenter});
//                        marker.setMap(map);
//						
//						var markerArray = [];
//						
//                        var name,lat,lng;
//                        var i;
//						var infowindow;
//						var text;
//                        
//                        for(i=0;i<result.length;i++){
//                            
//                            name=result[i][0];
//                            lat=result[i][1];
//                            lng=result[i][2];
//							
//                            text+=result[i]+ "<br>";
//							
//                            marker = new google.maps.Marker({position:{lat:lat, lng:lng}});
//							markerArray.append(marker);
//                            
//                            infowindow = new google.maps.InfoWindow({
//                                content: name
//                            });
//                            infowindow.open(map,marker);
//                        }
//						for(i=0;i<result.length;i++){
//							markerArray[i].setMap(map);
//						}
//						
//						document.getElementById("demo").innerHTML = text;
//                        -->