<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <p class="text text-center">
                <?= htmlspecialchars(
                    $nbRapports == 1
                        ? 'Un seul rapport de visite trouvé'
                        : 'Liste des ' . $nbRapports . ' rapports de visites trouvés'
                ) ?>
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <form action="index.php?uc=rapport&action=saisitRapport" method="post" class="formulaire-recherche d-block col-12 m-0 p-3 overflow-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                                Numéro de rapport
                            </th>
                            <th scope="col">
                                Numéro du praticien
                            </th>
                            <th scope="col">
                                Nom du praticien
                            </th>
                            <th scope="col">
                                Prenom du praticien
                            </th>
                            <th scope="col">
                                Motif de visite
                            </th>
                            <th scope="col">
                                Date de visite
                            </th>
                            <th scope="col">
                                Dépot du premier médicament
                            </th>
                            <th scope="col">
                                Nom du premier médicament
                            </th>
                            <th scope="col">
                                Dépot du deuxieme médicament
                            </th>
                            <th scope="col">
                                Nom du deuxieme médicament
                            </th>
                            <th scope="col">
                                Etat du rapport
                            </th>
                            <th scope="col">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rapports as $rapport) {
                        ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($rapport['RAP_NUM']) ?>
                                </td>
                                <?php
                                if (!empty($rapport['PRA_NUM'])) {
                                ?>
                                    <td>
                                        <?= htmlspecialchars($rapport['PRA_NUM']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($rapport['PRA_NOM']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($rapport['PRA_PRENOM']) ?>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td>Non définie</td>
                                    <td>-</td>
                                    <td>-</td>
                                <?php
                                }
                                ?>
                                <td>
                                    <?= htmlspecialchars(
                                        !empty($rapport['MOTIF'])
                                            ? $rapport['MOTIF']
                                            : 'Non définie'
                                    ) ?>
                                </td>
                                <td class="text-nowrap">
                                    <?= htmlspecialchars(
                                        !empty($rapport['RAP_DATE_VISITE'])
                                            ? date('Y-m-d', strtotime($rapport['RAP_DATE_VISITE']))
                                            : 'Non définie'
                                    ) ?>
                                </td>
                                <td>
                                    <?php if (!empty($rapport['MED1'])) {
                                        echo htmlspecialchars($rapport['MED1']);
                                    } ?>
                                </td>
                                <td>
                                    <?php if (!empty($rapport['MED1_NAME'])) {
                                        echo htmlspecialchars($rapport['MED1_NAME']);
                                    } ?>
                                </td>
                                <td>
                                    <?php if (!empty($rapport['MED2'])) {
                                        echo htmlspecialchars($rapport['MED2']);
                                    } ?>
                                </td>
                                <td>
                                    <?php if (!empty($rapport['MED2_NAME'])) {
                                        echo htmlspecialchars($rapport['MED2_NAME']);
                                    } ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($rapport['ETAT_LIB']) ?>
                                </td>
                                <td>
                                    <?php
                                    if ($rapport['ETAT_ID'] == 'C') {
                                    ?>
                                        <a class="btn btn-info text-light" role="button" 
                                            href="index.php?uc=rapport&action=saisirRapport&rapNum=<?= htmlspecialchars($rapport['RAP_NUM']) ?>"
                                            >
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a class="btn btn-secondary" role="button"
                                            href="index.php?uc=rapport&action=regarderRapport&rapNum=<?= htmlspecialchars($rapport['RAP_NUM']) ?>"
                                            >
                                            <i class="bi bi-card-text"></i>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>

    </div>
</section>