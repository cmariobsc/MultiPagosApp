<script type="text/javascript">

    function initMap() {
        var myLatLng = {lat: -2.188673, lng: -79.896771};

        var map = new google.maps.Map(document.getElementById('CONTACTO_mapa'), {
            zoom: 16,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: '<?= strtoupper(E_DOMINIO) ?>'
        });
    }

//    var elemSelCorreo = document.querySelector('#selCorreo');
//    var instance = M.FormSelect.init(elemSelCorreo);

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG-0Iktd8YvwKW_IPMy6KkP8jyy-qTbxU&callback=initMap" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

