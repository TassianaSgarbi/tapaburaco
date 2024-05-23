<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TapaBuraco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_GET['zone'] == 'Santos') {
    $sql = "SELECT COUNT(*) AS qtde, DATA FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY DATA;";

} else if ($_GET['zone'] == 'Zona da Orla e intermediária'){
    $sql = "SELECT COUNT(*) AS qtde, DATA FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY ) AND ZONAS = 'Zona da Orla e intermediária' GROUP BY DATA;";

} else if ($_GET['zone'] == 'Região Central Histórica'){
    $sql = "SELECT COUNT(*) AS qtde, DATA FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY ) AND ZONAS = 'Região Central Histórica' GROUP BY DATA;";

}  else if ($_GET['zone'] == 'Zona dos Morros'){
    $sql = "SELECT COUNT(*) AS qtde, DATA FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY ) AND ZONAS = 'Zona dos Morros' GROUP BY DATA;";
} 

else if ($_GET['zone'] == 'Zona Noroeste'){
    $sql = "SELECT COUNT(*) AS qtde, DATA FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY ) AND ZONAS = 'Zona Noroeste' GROUP BY DATA;";

} else if ($_GET['zone'] == 'Área Continental'){
    $sql = "SELECT COUNT(*) AS qtde, DATA FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY ) AND ZONAS = 'Área Continental' GROUP BY DATA;";
}

// Seleciona o número de demandas executadas por dia nos últimos 30 dias
// $sql = "SELECT COUNT(*) AS qtde, DATA FROM `solicitacao_de_demandas` WHERE DATA > DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY DATA;";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
