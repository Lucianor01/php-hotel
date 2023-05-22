<!-- 
Descrizione
Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.
Iniziate in modo graduale.
Prima stampate in pagina i dati, senza preoccuparvi dello stile.
Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.
Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel.
-->

<!-- PHP -->
<?php

$hotels = [

  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],

];

$hotelsFilter = $hotels;

if (isset($_GET['parking']) && $_GET['parking'] === 'available') {

  $hotelsWithParking = [];

  foreach ($hotels as $elem) {
    if ($elem['parking']) {
      $hotelsWithParking[] = $elem;
    }
  }

  $hotelsFilter = $hotelsWithParking;
}

if (isset($_GET['voteInput']) && $_GET['voteInput'] !== '') {

  $hotelsWithVote = [];

  foreach ($hotelsFilter as $elem) {
    if ($elem['vote'] >= $_GET['voteInput']) {
      $hotelsWithVote[] = $elem;
    }
  }

  $hotelsFilter = $hotelsWithVote;
}

// var_dump($hotelsFilter);

?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

  <div class="container mt-3">
    <!-- FILTRO  -->
    <form action="index.php" method="GET">
      <div class="row mb-3">
        <div class="col-md-4">
          <label for="parking" class="form-label">Filter by Parking:</label>
          <select class="form-select" name="parking" id="parking">
            <option value="allHotels">All Hotels</option>
            <option value="available">Hotels with Parking</option>
          </select>
        </div>
        <div class="col-md-4 align-self-end">
          <input type="number" min="1" max="5" name="voteInput" class="form-control">
        </div>
        <div class="col-md-4 align-self-end">
          <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </div>
    </form>

    <!-- TABELLA -->
    <table class="table table-info  table-hover table-bordered  border-primary text-center mt-4">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Parking</th>
          <th>Vote</th>
          <th>Distance to Center</th>
        </tr>
      </thead>
      <tbody class="table-group-divider border-primary">
        <?php
        //? CICLO PER STAMPARE I DATI NELLA TABELLA
        foreach ($hotelsFilter as $elem) {

          echo "<tr>";
          echo    "<td>" . $elem['name'] . "</td>";
          echo    "<td>" . $elem['description'] . "</td>";
          echo    "<td>" . "Parking: " . ($elem['parking'] ? 'Available' : 'Not available') . "</td>";
          echo    "<td>" . "Vote: " . $elem['vote'] . "</td>";
          echo    "<td>" . "Distance to center: " . $elem['distance_to_center'] . ' km' . "</td>";
          echo "</tr>";
        }

        ?>
      </tbody>
    </table>

  </div>

  <!-- BOOTSTRAP -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>