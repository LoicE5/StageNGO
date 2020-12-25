<?php
    include '../connect.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres | StageNGo</title>
    <link rel="stylesheet" href="assets/styles.css">
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">
   <!-- Lien Google Fonts de substitution en cas de dysfonctionnement des polices -->
</head>

<body>
    <div class="conteneur">
        <main class="couverture">
        <nav class="nav1" style="left: -1.3vw; top: 2.5%;">
            <a href="../index.php"></a>
            <a href="../mmi/mmi.html"></a>
            <a href="../offre/offre.php"></a>
        </nav>
        <nav class="nav2">
            <a href="../conseil/conseil.php"></a>
            <a href="../entreprise/entreprise.php"></a>
            <a href="../nous/nous.php"></a>
        </nav>
        
            <div class="fond">
            <aside class="offre-liste-container">
        <?php
            # On vérifie que la connexion fonctionne, ou on affiche un message d'erreur
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            # On crée la requête pour les caractéristiques des offres
            $offre = mysqli_query($conn, "SELECT *, offre.id AS offre_id,entreprise.id AS entreprise_id FROM offre,entreprise WHERE offre.id_entreprise = entreprise.id");

            if (mysqli_num_rows($offre) > 0) {
                while($row = mysqli_fetch_assoc($offre)) {
                    
                    echo '<div class="offre-liste-element" id="ole'.$row["offre_id"].'" onclick="corresp(this.id)">';
                    echo '<div class="nom-offre-liste">'.$row["intitule"].'</div>';
                    echo '<div class="company-name-small">'.$row["nom"].'<span class="liste-lieu">&nbsp;|&nbspParis<span></span></span></div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
        ?>
        </aside>
            <div class="vertical-line"></div>
            <aside class="offre-display-container">
            <div id="mymap" class="maps"></div>
            <script>
                var osm_mapnik = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    maxZoom: 19,
                    attribution: `&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors`
                });

                var lonlat0 = [57, -0.09];
                var mymap = L.map("mymap").setView(lonlat0, 13);
                var osm_mapnik = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: `&copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors`
                });
                osm_mapnik.addTo(mymap);
            </script>
            <?php
                $offre2 = mysqli_query($conn, "SELECT *, offre.id AS offre_id,entreprise.id AS entreprise_id FROM offre,entreprise WHERE offre.id_entreprise = entreprise.id");
                
                $mapCount = 1;
                if (mysqli_num_rows($offre2) > 0) {
                    while($row = mysqli_fetch_assoc($offre2)) {
                        
                        echo '<div class="offre-display-element" id="ode'.$row["offre_id"].'">';
                        echo '<h1>'.$row["intitule"].'</h1>';
                        echo '<h2>'.$row["nom"].'</h2>';
                        echo '<p>'.$row["description"].'</p>';
                        echo '<p><span class="label">Type de poste:&nbsp;</span>'.$row["type_de_poste"].'</p>';
                        echo '<p><span class="label">Rémunération:&nbsp;</span>'.$row["remuneration"].'&nbsp;€</p>';
                        echo '<p><span class="label">Durée du poste:&nbsp;</span>'.$row["duree"].'</p>';
                        echo '<a href="mailto:'.$row["mail"].'" class="contact">Contacter l\'entreprise</a>';
                        echo '</div>';
                        #map
                        /* echo '<div id="map'.$mapCount.'" class="maps"></div>';
                        echo '<script>
                        const lonlat'.$mapCount.' = ['.$row["longitude"].', '.$row["latitude"].'];
                        var mymap'.$mapCount.' = L.map("map'.$mapCount.'").setView(lonlat'.$mapCount.', 13);
                        osm_mapnik.addTo(mymap'.$mapCount.');
                        var marker'.$mapCount.' = L.marker(lonlat'.$mapCount.').addTo(mymap'.$mapCount.');
                        marker'.$mapCount.'.bindPopup("<h3>'.$row["nom"].'</h3>");
                        </script>'; */
                        echo '<script>
                        var lonlat'.$mapCount.' = ['.$row["longitude"].','.$row["latitude"].'];
                        var marker'.$mapCount.' = L.marker(lonlat'.$mapCount.').addTo(mymap);
                        marker'.$mapCount.'.bindPopup("<h3>'.$row["nom"].'</h3>");
                        </script>';

                        $mapCount++;
                    }
                } else {
                    echo "0 results";
                }
            ?>
            <h1>Le contenu des offres<br>s'affiche ici</h1>
        </aside>
            </div>
        </main>
    </div>
    <!-- <div style="position: fixed; z-index: 999; width: 80vw; height: 80vh;" id="map9"></div> -->
    <script src="assets/app.js"></script>
    <!-- <script>
        const lonlat9 = [51.505, -0.09];
        var mymap9 = L.map("map9").setView(lonlat9, 13);
        var osm_mapnik = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
	    maxZoom: 19,
	    attribution: `&copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors`
        });
        osm_mapnik.addTo(mymap9);

        var marker9 = L.marker(lonlat9).addTo(mymap9);
        marker9.bindPopup("<h3>Moulaga</h3>");

    </script> -->
</body>
<?php mysqli_close($conn); ?>
</html>