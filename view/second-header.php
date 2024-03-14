
    <div class="full-width-white-header-flex align-verticaly relative">
        <div>
            
            <form id="penthouseForm" action="" method="post">
                <a href="#" onclick="document.getElementById('penthouseForm').submit();" class="align-verticaly gap-5px flex-column">
                    <img src="../src/penthouse.png" alt="">
                    Penthouse
                </a>
                <input type="hidden" name="typappart" value="penthouse">
            </form>

        </div>
        <div >
            <form id="duplexForm" action="" method="post">
                    <a href="#" onclick="document.getElementById('duplexForm').submit();" class="align-verticaly gap-5px flex-column">
                    <img src="../src/duplex.png" alt="">
                        Duplex
                    </a>
                    <input type="hidden" name="typappart" value="duplex">
            </form>
        </div>
        <div >
            <form id="studioForm" action="" method="post">
                    <a href="#" onclick="document.getElementById('studioForm').submit();" class="align-verticaly gap-5px flex-column">
                    <img src="../src/studio.png" alt="">
                    Studio
                    </a>
                    <input type="hidden" name="typappart" value="studio">
  
            </form>
                </div>
        <div>
        <form id="hotelForm" action="" method="post">
            <a href="#" onclick="document.getElementById('hotelForm').submit();" class="align-verticaly gap-5px flex-column">
            <img src="../src/hotel.png" alt="">
            Hotel
            </a>
            <input type="hidden" name="typappart" value="hotel">
        </form>
        </div>
        <div>
            <form id="bateauForm" action="" method="post">
                <a href="#" onclick="document.getElementById('bateauForm').submit();" class="align-verticaly gap-5px flex-column">
                <img src="../src/bateau.png" alt="">
                Bateau
                </a>
                <input type="hidden" name="typappart" value="bateau">
            </form>
        </div>
        <div>
            <form id="appartementForm" action="" method="post">
                <a href="#" onclick="document.getElementById('appartementForm').submit();"  class="align-verticaly gap-5px flex-column">
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

        <div class="show-on-decktop width-100 "> 
            <span class="align-verticaly relative">
                <input type="search" class="width-100" name="search-request" id="search-annonce" placeholder="Rechercher par arrondissement, rue, type...">
                <ion-icon class="search-icon" name="search-outline" style="position:absolute; right: 10px;"></ion-icon>
            </span>
        </div>
    </div>
    <div class="full-width-white-header-flex align-verticaly show-on-mobile">
    <div class="show-on-mobile"> 
            <span class="align-verticaly relative ">
                <input type="search" name="search-request" id="search-annonce" placeholder="Rechercher par arrondissement, rue, type...">
                <ion-icon class="search-icon" name="search-outline" style="position:absolute; right: 10px;" ></ion-icon>

            </span>
        </div>
    </div>