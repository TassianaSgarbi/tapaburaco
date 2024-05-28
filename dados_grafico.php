<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TapaBuraco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$dataType = $_GET['dataType'];
$zone = $_GET['zone'];

if ($dataType == '30days') {
    if ($zone == 'Santos') {
        $sql = "SELECT COUNT(*) AS qtde, DATE_FORMAT(DATA, '%d/%m/%Y') AS data FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY data;";
    } else {
        $sql = "SELECT COUNT(*) AS qtde, DATE_FORMAT(DATA, '%d/%m/%Y') AS data FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND ZONAS = '" . $conn->real_escape_string($zone) . "' GROUP BY data;";
    }
} else if ($dataType == 'annual') {
    if ($zone == 'Santos') {
        $sql = "SELECT COUNT(*) AS qtde, MONTH(DATA) AS mes FROM `solicitacao_de_demandas` WHERE YEAR(DATA) = YEAR(CURDATE()) GROUP BY mes;";
    } else {
        $sql = "SELECT COUNT(*) AS qtde, MONTH(DATA) AS mes FROM `solicitacao_de_demandas` WHERE YEAR(DATA) = YEAR(CURDATE()) AND ZONAS = '" . $conn->real_escape_string($zone) . "' GROUP BY mes;";
    }
} else if ($dataType == 'top3') {
    if ($zone == 'Santos') {
        $sql = "
            SELECT RUA, COUNT(*) AS qtde 
            FROM `solicitacao_de_demandas` 
            GROUP BY RUA 
            ORDER BY qtde DESC 
            LIMIT 3;
        ";
    } else {
        $sql = "
            SELECT RUA, COUNT(*) AS qtde 
            FROM `solicitacao_de_demandas` 
            WHERE ZONAS = '" . $conn->real_escape_string($zone) . "' 
            GROUP BY RUA 
            ORDER BY qtde DESC 
            LIMIT 3;
        ";
    }
}

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
