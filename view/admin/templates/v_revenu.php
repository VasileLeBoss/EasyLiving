<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="fit-content " style="margin-top:0;">
    <a href="?view=revenue" class="text-color-black">
        <span class="aligne-icon gap-10px">
        <ion-icon name="cash-outline"></ion-icon>Revenu</a>
    </span>
</h1>

<div class="admin-revenu">
    <div class="box">
        <div class="display-flex align-verticaly space-between">
            <h2>Rapport sur le revenu</h2>
            <h3><?php echo date("d/m/Y");?></h3>
        </div>
        <div class="display-grid grid-template-columns-2 gap-10px">

            <div>
                <h4 class="small grey no-mar-pad">Transactions Total</h4>
                <h1 class="no-mar-pad font-size-72px second-color"><?php echo $revenuTotal ." €"; ?></h1>
            </div>
            <div>
                <h4 class="small grey no-mar-pad">Profit</h4>
                <h1 class="no-mar-pad font-size-72px second-color"><?php echo $revenuPotentiel ." €"; ?></h1>
            </div>
        </div>
        <div>
            <h2 class="grey small " >Nombre transaction</h2>
            <h1 class="no-mar-pad font-size-72px second-color"><?php echo count($AllLocataire); ?></h1>

        </div>
        

        
    </div>
    <div id="pie-chart-container">
        <canvas id="pie-chart"></canvas>
    </div>
    <div class="box " id="bar-chart-container">
        <canvas id="bar-chart"></canvas>
    </div>
    <div class="box">
        <div class="display-flex flex-column ">
            <div>
                <h2 class="relative"><span class="absolute" style="left:-25px;"><ion-icon name="caret-forward-outline"></ion-icon></span>Vue d'ensemble</h2>
                <p>
                Une tendance de croissance stable. <br><br> une rentabilité accrue à travers une analyse de la rentabilité par service et une projection des opportunités de croissance future.
                </p>
            </div>
            <div>
                <h2 class="relative"><span class="absolute" style="left:-25px;"><ion-icon name="caret-forward-outline"></ion-icon></span>Prédiction</h2>
                <p>
                    Croissance continue de nos revenus. <br><br>De nouvelles opportunités de diversification et d'expansion, ce qui devrait contribuer à une augmentation significative de nos revenus à moyen et long terme.
                </p>
            </div>
        
        </div>
    </div>
</div>


<script>
    // Supposons que vous ayez récupéré les données dans un format adapté à Chart.js
const datapie = {
    labels: ['Total', 'Profit'],
    datasets: [{
        data: [ <?php echo $revenuTotal ?>,<?php echo $revenuPotentiel ?>], // Utilisez les données récupérées de la base de données ici
        backgroundColor: ['#1F7A8C', '#3ac0db'],
        borderColor: ['#1F7A8C', '#3ac0db'] // Changer les couleurs des bordures ici

    }],
};

// Dessinez le diagramme circulaire
const ctxpie = document.getElementById('pie-chart').getContext('2d');
const myPieChart = new Chart(ctxpie, {
    type: 'pie',
    data: datapie,
    option: {
        responsive: true,
    }

});

</script> 
<script>
    // Données du graphique
    const revenusProprietaires = <?php echo json_encode($donnees); ?>;
    const revenusEntreprise = <?php echo json_encode($donneesEntreprise); ?>;


    const data = {
        // labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        datasets: [{
        label: "Revenus des propriétaires" ,
        data: revenusProprietaires, 
        backgroundColor: '#1F7A8C',
        },
        {
        label: "Revenus de l\'entreprise" ,
        data: revenusEntreprise, 
        backgroundColor: '#3ac0db',
        }
      ],
    };

    // Configuration du graphique
    const config = {
      type: 'bar',
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true // Démarre l'axe y à zéro
          }
        }
      }
    };
    // Création du graphique
    const ctx = document.getElementById('bar-chart').getContext('2d');
    new Chart(ctx, config);
  </script>