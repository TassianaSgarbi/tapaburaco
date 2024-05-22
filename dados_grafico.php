<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TapaBuraco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Seleciona o número de demandas executadas por dia nos últimos 30 dias
$sql = "
SELECT DAY(Data) as Dia, COUNT(*) as Quantidade
FROM Solicitacao_de_Demandas
WHERE Status_Demanda = 'Demandas Executadas' AND Data >= CURDATE() - INTERVAL 30 DAY
GROUP BY Dia
ORDER BY Dia";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
