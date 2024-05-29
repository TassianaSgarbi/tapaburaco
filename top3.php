<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TapaBuraco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT Rua, Zonas, COUNT(*) AS Total_Demandas_Executadas
FROM Solicitacao_de_Demandas
WHERE Status_Demanda = 'Demandas Executadas'
GROUP BY Rua, Zonas
ORDER BY Total_Demandas_Executadas DESC
LIMIT 3";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<div class="row justify-content-center align-items-center">';
        echo '<div class="col-lg-12 shadow p-3 mb-5 bg-body-tertiary rounded">';
        if ($i == 1) {
            echo '<span class="primeirolugar">' . $i . 'º Lugar</span>';
        } elseif ($i == 2) {
            echo '<span class="segundolugar">' . $i . 'º Lugar</span>';
        } elseif ($i == 3) {
            echo '<span class="terceirolugar">' . $i . 'º Lugar</span>';
        }
        echo '<h6>' . $row["Rua"] . '</h6>';
        echo '<p>Zona: ' . $row["Zonas"] . '</p>';
        echo '<p>Total de Demandas Executadas: ' . $row["Total_Demandas_Executadas"] . '</p>';
        echo '</div>';
        echo '</div>';
        $i++;
    }
} else {
    echo "Nenhuma rua encontrada.";
}

$conn->close();
?>
