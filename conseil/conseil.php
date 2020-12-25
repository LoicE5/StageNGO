<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conseils | StageNGo</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="conteneur">
        <main class="couverture">
        <nav class="nav1">
            <a href="../index.php"></a>
            <a href="../mmi/mmi.html"></a>
            <a href="../offre/offre.php"></a>
            <a href="../conseil/conseil.php"></a>
        </nav>

        <nav class="nav2">
            <a href="../entreprise/entreprise.php"></a>
            <a href="../nous/nous.php"></a>
        </nav>
        
            <div class="fond">

            <div class="scroll">

                <h1>Témoignages</h1>
                <p class="presentation">Ici vous pouvez retrouvez des témoignages d'anciens étudiants qui vous donnent tout leurs tips
                    pour
                    réussir votre stage.</p>

                
                    <div class="column">

                        <?php
                        include("connexion_base.php");
                        //Creation de la requête SQL : selectionner toutes les lignes de "conseil"
                        $req_sql = 'SELECT *,DATE_FORMAT(date_de_creation, "Message du : %d/%m/%Y")AS date_creation FROM conseil';

                        //execution de la requête SQL : je fais une requete $req_sql avec query dans la base de donnée $conn et le résultat est stocké dans $result
                        $reponse=$conn->query($req_sql);

                        // affiche les data de chaque ligne
                        while($row = $reponse->fetch()) {
                            echo 
                            '<section>'.
                            '<div class=pre_nom_etu>'.
                            '<p class="prenom">'. $row['prenom_etudiant'].'</p>'.
                            '<p class="nom">'. $row['nom_etudiant'].'</p>'.
                            '<p class="etude">'. $row['etude_etudiant'].'</p>'.
                            '</div>'.

                            '<p class="texte">'. $row['texte'].'</p>'.
                            '<p class="date">'. $row['date_creation'].'</p>'.
                            '</section>' ;
                        }
         
                        $conn = null; 
                        ?>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>