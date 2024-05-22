<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TapaBuraco";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo dados do formulário
$data = $_POST['data'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$zonas = $_POST['zonas'];
$status_demanda = $_POST['status_demanda'];

// Inserindo os dados na tabela
$sql = "INSERT INTO Solicitacao_de_Demandas (Data, CEP, Rua, Numero, Complemento, Zonas, Status_Demanda)
        VALUES ('$data', '$cep', '$rua', '$numero', '$complemento', '$zonas', '$status_demanda')";

if ($conn->query($sql) === TRUE) {
    echo "Nova solicitação de demanda cadastrada com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
