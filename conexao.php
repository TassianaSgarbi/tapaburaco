<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TapaBuraco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT zonas, COUNT(*) as total FROM SolicitacaoDemandas GROUP BY zonas";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
