<div class="view">
    <span class="list"> <a class='maplist'  href="?page=home"><i class="fa fa-list" aria-hidden="true"></i>Lista</a></span>
    <span class="map"><a class='maplist' href="?page=maps"><i class="fa fa-map-marker" aria-hidden="true"></i>Mapa</a></span>

    <div id="map" style="height: 800px; width: 1200px; margin: 0 auto;"> </div>

</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCog52PfzSHjZDsFJmtkmQY1fRYyyXwjAE&libraries=places&callback=init" async defer></script>
<script>
    function init() {

        $.ajax({
            url: 'index.php?page=posts&action=get_all',
            dataType: 'json',
            error: function () {
                console.log(arguments);
            },
            success: function (response) {

               console.log(response);

                if (response && response instanceof Array) {

                    var belgrade = {lat: 44.78656, lng: 20.44892};

                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: belgrade,
                        //scrollwheel: false,
                        zoom: 10,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    response.forEach(function (response) {
                        var marker = new google.maps.Marker({
                            map: map,
//                           icon: 'images/post/' + response.image,
                            title: response.title,
                            id : response.id,
                            position: {lat: parseFloat(response.lat), lng: parseFloat(response.lng)}
                        });

                        var html = '<a href="http://localhost/openserbia1/index.php?page=readmore&post_id='+response.id+' "target="_blank" ><div><img width="64" src="images/post/'+response.image+'"><p>'+response.title+'</p></div></a>';

                        var infoWindow = new google.maps.InfoWindow({
                            content: html
                        });

                        marker.addListener('click', function () {
                            infoWindow.open(map, marker);
                        });

                        marker.setMap(map);
                    });
                }
            }
        });
    }


</script>

