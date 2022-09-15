<?php
require("database/connectMysqlPDO.php");
require("header/header.php");
require("header/footer.php");
require("liste_Service.php");
?>
<!-- Forms -->
<form method="Post">
    <div class="container">
        <div class="row">
            <div class="col">
                <select class="form-select" aria-label="Default select example" name="validated">
                    <option selected>Choisir un service</option>
                    <!-- la boucle qui appel tout les metiers de la table SERVICE ecrit dans le fichier liste_metiers.php -->
                    <?php foreach ($listeService as $service) : ?>
                        <option value="<?= $service["nom"]; ?>"><?= $service["nom"]; ?></option>
                    <?php endforeach; ?>
                    <!-- Fin de boucle -->
                </select>
            </div>
            <div class="col">
                <!-- Boutons de recherche -->
                <button type="submit" class="btn btn-outline-info" name="validate">Rechercher</button>
            </div>

        </div>
    </div>
</form>
<!-- end form -->

<!-- Récupération de la requête pour afficher les employers -->

<?php
// Je récupère la données de recherche
if (isset($_POST['validated'])) {
    $listes = $_POST['validated'];

    // j'effectue la requête pour afficher liste des employées selon leurs métiers avec leur disponibilité
    $ObjResult = $Bdd->query("SELECT employe.id, employe.prenom, employe.nom, metier.nom as metier, exerce.temps 
    FROM employe, exerce, service, metier 
    WHERE employe.id = exerce.id_employe 
    AND exerce.id_service = service.id 
    AND exerce.id_metier = metier.id 
    AND service.nom = '$listes';");
    $demande = $ObjResult->fetchAll();
?>
    <!-- Titre -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="px-4 py-5 my-5 text-center">
                    <h1 class="display-5 fw-bold">
                        <!-- Le nom de chaque liste -->
                        <?php
                        echo $listes
                        ?>
                    </h1>
                </div>
                <div class="b-example-divider"></div>
            </div>
        </div>
    </div>
    <!-- end titre -->

    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Nom</th>
                            <th>Métiers</th>
                            <th>temps</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <!-- La boucle foreach pour appelé les employées selon leur métier -->
                    <?php foreach ($demande as $list) : ?>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">
                                                <!-- Appel du nom et prénom des employer de la boucle foreach -->
                                                <?= $list["nom"]; ?>
                                                <?= $list["prenom"]; ?>
                                            </p>
                                            <p class="text-muted mb-0">
                                                <!-- Création de leur adresse E-mail -->
                                                <?= $list["nom"] . ".", $list["prenom"] . "@gmail.com" ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">
                                        <!-- Appel de metier -->
                                        <?= $list["metier"]; ?>
                                </td>
                                <td>
                                    <span class="badge-warning rounded-pill d-inline">
                                        <!-- Appel de leurs disponibilité de travail -->
                                        <?= " Travail à " . "<strong>" . $list["temps"] . "</strong>" ?>
                                    </span>
                                </td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                    <!-- Fin de boucle -->
                </table>
            </div>
        </div>
    </div>
<?php
}
?>