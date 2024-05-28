<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviço Tapa Buraco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="loading" id="loading">
    <div class="loading-inner">
        <div class="loading-spinner"></div>
        <p>Carregando...</p>
    </div>
</div>

<h1>Serviço Tapa Buraco</h1>
<span id="alert"></span>

<div class="row">
    <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <button onclick="fetchData('Santos');">Santos</button>
    </div>
    <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <button onclick="fetchData('Zona da Orla e intermediária')">Zona da Orla e intermediária</button>
    </div>
    <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <button onclick="fetchData('Região Central Histórica')">Região Central Histórica</button>
    </div>
    <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <button onclick="fetchData('Zona dos Morros')">Zona dos Morros</button>
    </div>
    <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <button onclick="fetchData('Zona Noroeste')">Zona Noroeste</button>
    </div>
    <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
        <button onclick="fetchData('Área Continental')">Área Continental</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
        <span id="totalDemandas" class="total">0</span>
        <h3>Total de Demandas</h3>
    </div>
    <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
        <span id="demandasAbertas" class="total">0</span>
        <h3>Demandas Abertas</h3>
    </div>
    <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
        <span id="demandasVistoriadas" class="total">0</span>
        <h3>Demandas Vistoriadas</h3>
    </div>
    <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
        <span id="demandasExecutadas" class="total">0</span>
        <h3>Demandas Executadas</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <h3>Executadas nos últimos 30 dias</h3>
        <div id="executadas_ultimos_30_dias"></div>
    </div>

    <div class="col-lg-3">
        <h3>Gráfico Percentual</h3>
        <div id="grafico_percentual"></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-9">
        <h3>Executadas no Ano</h3>
        <div id="execucao_anual"></div>
    </div>

    <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
    <?php include 'top3.php'; ?>  
    </div>
</div>

<footer>
    <div class="footer-text">
        <p class="footer-text__source">Desenvolvido pelos alunos 5º Ciclo ADS-Noturno 1ºSem/2024 - BY Tassiana Sgarbi</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="graficos.js"></script>



</body>

</html>