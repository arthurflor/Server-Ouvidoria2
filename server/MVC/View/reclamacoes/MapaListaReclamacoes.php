<?php
	class MapaListaReclamacoes{
	
		public function gerar_mapa(array $latitudes, array $longitudes){
			echo '
				<script>
				      function initMap() {
				        var map = new google.maps.Map(document.getElementById("map"), {
				          zoom: 13,
				          center: {lat: -8.2799693, lng: -35.9718477}
				        });

				        setMarkers(map);
				      }

				      var lugares = [';
			
			for ($i=0; $i < count($latitudes); $i++) { 
				if($i<count($latitudes)-1){
					echo '["Lugar", '.$latitudes[$i].','.$longitudes[$i].', '.$i.'],';
				} else {
					echo '["Lugar", '.$latitudes[$i].','.$longitudes[$i].', '.$i.']';
				}
			}

			echo '
				      ];

				      function setMarkers(map) {
				        
				        //definindo uma imagem pro marcador
				        var image = {
				          url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
				          size: new google.maps.Size(20, 32),
				          origin: new google.maps.Point(0, 0),
				          anchor: new google.maps.Point(0, 32)
				        };
				        
				        var shape = {
				          coords: [1, 1, 1, 20, 18, 20, 18, 1],
				          type: "poly"
				        };
				        for (var i = 0; i < lugares.length; i++) {
				          var lugar = lugares[i];

				          var marker = new google.maps.Marker({
				            position: {lat: lugar[1], lng: lugar[2]},
				            map: map,
				            shape: shape,
				            title: lugar[0],
				            zIndex: lugar[3]
				          });
				        }
				      }
				    </script>
				    <script async defer
				    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ_auNFsYhr2c9Ua8GyGwnzuTNgxHZN0w&callback=initMap">
				    </script>
				
			';
		}
	}
?>