<!-- Leafleat js Component -->
<script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
<script src="https://unpkg.com/geojson-vt@3.2.0/geojson-vt.js"></script>
<script src="/leaflet/leaflet-geojson-vt.js"></script>
<script src="/leaflet/leaflet.ajax.min.js"></script>
<script src="/leaflet/leaflet.ajax.js"></script>
<script src="/leaflet/L.Control.MousePosition.js"></script>
<script src="//unpkg.com/leaflet-gesture-handling"></script>

<!-- Leafleat Setting js-->
<!-- initialize the map on the "map" div with a given center and zoom -->
<script>
    // Base map
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiNjg2MzUzMyIsImEiOiJjbDh4NDExZW0wMXZsM3ZwODR1eDB0ajY0In0.6jHWxwN6YfLftuCFHaa1zw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    });

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiNjg2MzUzMyIsImEiOiJjbDh4NDExZW0wMXZsM3ZwODR1eDB0ajY0In0.6jHWxwN6YfLftuCFHaa1zw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
    });

    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiNjg2MzUzMyIsImEiOiJjbDh4NDExZW0wMXZsM3ZwODR1eDB0ajY0In0.6jHWxwN6YfLftuCFHaa1zw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/dark-v10'
    });

    // set frame view

    <?php foreach ($tampilData as $D) : ?>
        var map = L.map('map', {
            center: [<?= $D->coordinat_wilayah; ?>],
            zoom: <?= $D->zoom_view; ?>,
            layers: [peta1],
            gestureHandling: true,
        })
    <?php endforeach ?>

    // Geojson to Leaflet
    <?php foreach ($tampilGeojson as $G) : ?>
        var myStyle<?= $G->id; ?> = {
            "color": "<?= $G->warna; ?>",
            "weight": 5,
            "opacity": 0.5,
        };

        function popUp(f, l) {
            var out = [];
            if (f.properties) {
                for (key in f.properties) {
                    out.push(key + ": " + f.properties[key]);
                }
                // l.bindPopup(out.join("<br />"));
            }
        }

        var jsonTest = new L.GeoJSON.AJAX(["<?= base_url(); ?>/geojson/<?= $G->geojson; ?>", "counties.geojson"], {
            onEachFeature: popUp,
            style: myStyle<?= $G->id; ?>,
        }).addTo(map);
    <?php endforeach ?>


    // controller
    var baseLayers = {
        "Map": peta1,
        "Satellite": peta2,
        "OSM": peta3,
    };

    L.control.layers(baseLayers).addTo(map);

    L.control.mousePosition().addTo(map);
    L.control.scale().addTo(map);



    // set marker place



    // Map clik coordinate show
    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(map);
    }

    map.on('click', onMapClick);
</script>