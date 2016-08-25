

<form method="POST" action="" enctype="multipart/form-data">
    <?php if($_SESSION['admin'] == 1) { ?>
    <h3>Dodaj novu kategoriju:</h3><br>

        <input type="text" name="category_name" placeholder="Ime kategorije" class="input">
        <button type="submit" name="new_category" class="filter">Dodaj</button>

        <h3>Dodaj novu lokaciju:</h3>

        <input type="text" name="name" placeholder="Ime lokacije" class="input" >
        <button type="submit" name="location" class="filter">Dodaj</button>
        <?php
    }
    ?>
    <br>
    <h2>Dodaj novu turisticku destinaciju:</h2>

    <input id="pac-input" class="controls" name="address" type="text" placeholder="Unesi Adresu">

    <div id="map" style="height: 300px; width: 600px; margin: 0 ;"> </div>

    <select name="category_id" class="select">
        <option value="-1">Izaberi kategoriju:</option>

        <?php

        foreach ($category as $cat)
        {
            ?>
            <option value="<?php echo $cat['category_id'] ?>">
                <?php

                echo $cat['category_name'] . "<br>";
                ?>
            </option>
            <?php

        }
        ?>

    </select>

    <input type="hidden" name="address" id="address" value="">

    <select name="id" class="select locations">
        <option value="-1">Izaberi lokaciju:</option>

        <?php

        foreach ($location as $loc)
        {
            ?>
            <option value="<?php echo $loc['id'] ?>">
                <?php

                echo $loc['name'] . "<br>";
                ?>
            </option>
            <?php

        }
        ?>

    </select>


    <input type="hidden" id="lat" name="lat" value="-1" />
    <input type="hidden" id="lon" name="lon" value="-1" />

    <br><br>
    <input type="text" name="title" placeholder="Unesite naslov..." class="title <?php echo (empty($errorArray['title']) ? '' : 'error');?>">
    <?php if (!empty($errorArray['title'])) { ?>
        <span ><?php echo $errorArray['title']; ?></span>
    <?php } ?>

    <br><br>
    <textarea cols="100" rows="5" name="descript" placeholder="Unesite kraci opis..." class="descript <?php echo (empty($errorArray['descript']) ? '' : 'error');?>">
    </textarea>
    <?php if (!empty($errorArray['descript'])) { ?>
        <span ><?php echo $errorArray['descript']; ?></span>
    <?php } ?>

    <textarea cols="150" rows="20" name="content" class="content <?php echo (empty($errorArray['content']) ? '' : 'error');?>">

    </textarea>
    <?php if (!empty($errorArray['descript'])) { ?>
        <span ><?php echo $errorArray['descript']; ?></span>
    <?php } ?>

    
    <br><br>
    <div class="form">

        <input type="file" name="file[]"  multiple="multiple"><br>
    </div>
    <input type="submit" name="send" value="Send" class="filter">
</form>

<script type="text/javascript">

    var apiUrl = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCog52PfzSHjZDsFJmtkmQY1fRYyyXwjAE&address=';

    $(document).ready(function () {
        var ENTER_KEY_ID = 13;

        $('input#pac-input').on('keypress', function (event) {
            if (event.which === ENTER_KEY_ID) {
                event.preventDefault();
            }
        });

        var eachLoop = function (index, option) {
            if (0 === index) {
                return;
            }

            var $option = $(option);

            var town = $option.text().trim();

            var url = encodeURI(apiUrl + town + ', Serbia');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response && response.status && response.status === 'OK') {
                        $option.data('location', response.results[0].geometry.location);
                    }
                }
            });
        };

        $('select.locations option').each(eachLoop);
    });
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCog52PfzSHjZDsFJmtkmQY1fRYyyXwjAE&libraries=places&callback=initAutocomplete" async defer></script>
<script>
    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 44.78656, lng: 20.44892},
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            var x =searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();


            console.log(places);

//var address = places[0].address_components[0].long_name;

//            var city = places[0].address_components[1].long_name;

            var lat = places[0].geometry.location.lat();

            var lng = places[0].geometry.location.lng();

//console.log(city);

            $.ajax({
                url: encodeURI('http://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ',' + lng + '&sensor=false'),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                }
            });



            if (places.length == 0) {
                return;
            }
            $('#address').val( places[0].address_components[0].long_name);

            $('#lat').val(places[0].geometry.location.lat);

            $('#lon').val(places[0].geometry.location.lng);

            

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();

            places.forEach(function(place) {

                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location


                }));
                //console.log(markers);


                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });

            map.fitBounds(bounds);


        });
    }

</script>