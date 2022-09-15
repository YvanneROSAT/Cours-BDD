<?php
require("header/header.php");
require("header/footer.php");
?>
<?php
$ObjResult = $Bdd->query("SELECT * FROM employe");
$liste = $ObjResult->fetchAll();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Nom</th>
                        <th>Age</th>
                        <th>Ancienneté</th>
                        <th>Date d'arrivé</th>
                        <th>Âge à l'arrivé</th>
                        <th></th>
                    </tr>
                </thead>
                <!-- titre -->
                <div class="container ti-align-center">
                    <div class="row">
                        <div class="col-8">
                            <h1>Liste de tous les employées</h1>
                            <br>
                        </div>
                    </div>
                </div>
                <!-- end titre -->

                <!-- Début de la boucle foreach -->
                <?php foreach ($liste as $list) : ?>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
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
                                <!-- Leur age -->
                                <?php
                                $dateNaissance = $list["date_naissance"];
                                $aujourdhui = date("Y-m-d");
                                $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
                                echo $diff->format('%y') . " " . "ans";
                                ?>
                            </td>
                            <td>
                                <!-- leur ancienneté -->
                                <p>
                                    <?php
                                    $dateArrivee = $list["date_arrivee"];
                                    $aujourdhui = date("Y-m-d");
                                    $diff = date_diff(date_create($dateArrivee), date_create($aujourdhui));
                                    echo $diff->format('%y') . " " . "ans";
                                    ?>
                                </p>
                            </td>
                            <td>
                                <span class="badge-success rounded-pill d-inline">
                                    <!-- Appel de leur date d'arrivé -->
                                    <?= $list["date_arrivee"]; ?>
                                </span>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">Je suis arrivé à :</p>
                                <p class="text-muted mb-0">
                                    <!-- Appel de leur age à l'arrivé dans l'entreprise -->
                                    <?php
                                    $ageArrivee = $list["date_arrivee"];
                                    $dateNaissance = $list["date_naissance"];
                                    $diff = date_diff(date_create($ageArrivee), date_create($dateNaissance));
                                    echo $diff->format('%y') . " " . "ans";
                                    ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
                <!-- Fin de la boucle foreach -->
            </table>
        </div>
    </div>
</div>