<?php global $smof_data; ?>

<script type="text/javascript">
jQuery(document).ready(function() {
function initialize() {
    var latlng = new google.maps.LatLng(<?php echo esc_html( ot_get_option( 'minime_latitude' ) ) ?>, <?php echo esc_html( ot_get_option( 'minime_longitude' ) ) ?>);
    var myOptions = {
        zoom: <?php echo esc_html( ot_get_option( 'minime_map_zoom' ) ) ?>,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map-google"),
            myOptions);
}
google.maps.event.addDomListener(window, "load", initialize);
});
</script>