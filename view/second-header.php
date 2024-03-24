
<div class="full-width-white-header-flex align-verticaly relative">
    <div>

        <form id="penthouseForm" action="" method="post">
            <a
                href="#"
                onclick="document.getElementById('penthouseForm').submit();"
                class="align-verticaly gap-5px flex-column">
                <img src="../src/penthouse.png" alt="">
                Penthouse
            </a>
            <input type="hidden" name="typappart" value="penthouse">
        </form>

    </div>
    <div >
        <form id="duplexForm" action="" method="post">
            <a
                href="#"
                onclick="document.getElementById('duplexForm').submit();"
                class="align-verticaly gap-5px flex-column">
                <img src="../src/duplex.png" alt="">
                Duplex
            </a>
            <input type="hidden" name="typappart" value="duplex">
        </form>
    </div>
    <div >
        <form id="studioForm" action="" method="post">
            <a
                href="#"
                onclick="document.getElementById('studioForm').submit();"
                class="align-verticaly gap-5px flex-column">
                <img src="../src/studio.png" alt="">
                Studio
            </a>
            <input type="hidden" name="typappart" value="studio">

        </form>
    </div>
    <div>
        <form id="hotelForm" action="" method="post">
            <a
                href="#"
                onclick="document.getElementById('hotelForm').submit();"
                class="align-verticaly gap-5px flex-column">
                <img src="../src/hotel.png" alt="">
                Hotel
            </a>
            <input type="hidden" name="typappart" value="hotel">
        </form>
    </div>
    <div>
        <form id="bateauForm" action="" method="post">
            <a
                href="#"
                onclick="document.getElementById('bateauForm').submit();"
                class="align-verticaly gap-5px flex-column">
                <img src="../src/bateau.png" alt="">
                Bateau
            </a>
            <input type="hidden" name="typappart" value="bateau">
        </form>
    </div>
    <div>
        <form id="appartementForm" action="" method="post">
            <a
                href="#"
                onclick="document.getElementById('appartementForm').submit();"
                class="align-verticaly gap-5px flex-column">
                <img src="../src/appartement.png" alt="">
                Appartement
            </a>
            <input type="hidden" name="typappart" value="appartement">
        </form>
    </div>
    <div >

        <a href="v_accueil.php" class="align-verticaly gap-5px flex-column">
            <img src="../src/three-dots-ellipsis.png" alt="">
            Tout afficher
        </a>
    </div>


</div>

<div class="search-appartement-wraper">
    <div class="search-appartement align-verticaly align-horizontaly ">
        <div class="width-100">
        <form action="" method="post">
                <div class="search-appartement-param">
                    <select name="arrondisment" id="arrondisment">
                        <option value="0">Arrondisment</option>
                        <?php for ($i = 1; $i <= 20; $i++) : ?>
                        <option value="<?php echo $i; ?>"><?php echo $i . ($i == 1 ? 'er' : 'ème'); ?></option>
                        <?php endfor; ?>
                    </select>

                    <input type="number" name="prix_max" min="0" id="prix_max" placeholder="Prix max">

                    <input type="number" name="prix_min" min="0" id="prix_min" placeholder="Prix min">

                    <input type="hidden" name="search-appartement">
                    <button type="submit">Chercher</button>
                </div>
            </form>
        </div>
    </div>
</div>