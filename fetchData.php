<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TapaBuraco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$zone = isset($_GET['zone']) ? $_GET['zone'] : '';

if ($zone == 'Santos') {
    $sql = "SELECT `Status_Demanda`, COUNT(*) as count FROM `Solicitacao_de_Demandas` GROUP BY `Status_Demanda`";
} else {
    $sql = "SELECT `Status_Demanda`, COUNT(*) as count FROM `Solicitacao_de_Demandas` WHERE `Zonas` = ? GROUP BY `Status_Demanda`";
}

$stmt = $conn->prepare($sql);

if ($zone != 'Santos') {
    $stmt->bind_param("s", $zone);
}

$stmt->execute();
$result = $stmt->get_result();

$data = [
    "totalDemandas" => 0,
    "demandasAbertas" => 0,
    "demandasVistoriadas" => 0,
    "demandasExecutadas" => 0,
];

while ($row = $result->fetch_assoc()) {
    $status = $row['Status_Demanda'];
    $count = $row['count'];
    
    $data["totalDemandas"] += $count;

    if ($status == "Demandas Abertas") {
        $data["demandasAbertas"] = $count;
    } elseif ($status == "Demandas Vistoriadas") {
        $data["demandasVistoriadas"] = $count;
    } elseif ($status == "Demandas Executadas") {
        $data["demandasExecutadas"] = $count;
    }
}

$stmt->close();
$conn->close();

echo json_encode($data);
?>
