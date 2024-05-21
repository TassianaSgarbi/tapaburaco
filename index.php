<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviço Tapa Buraco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
    <h1>Serviço Tapa Buraco</h1>

    <div class="row">
        <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
            <button onclick="getUserData('Santos')" id="Santos">Santos</button>
        </div>
        <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
            <button onclick="getUnitData('Zona da Orla e intermediária')" id="ZonaOrla">Zona da Orla e intermediária</button>
        </div>
        <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
            <button onclick="getUnitData('Região Central Histórica')" id="RegiaoCentral">Região Central Histórica</button>
        </div>
        <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
            <button onclick="getUnitData('Zona dos Morros')" id="ZonaMorros">Zona dos Morros</button>
        </div>
        <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
            <button onclick="getUnitData('Zona Noroeste')" id="ZonaNoroeste">Zona Noroeste</button>
        </div>
        <div class="col-lg-2 shadow p-3 mb-5 bg-body-tertiary rounded">
            <button onclick="getUnitData('Área Continental')" id="AreaContinental">Área Continental</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
            <span id="totalDemandas" class="total">586</span>
            <h3>Total de Demandas</h3>
        </div>
        <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
            <span id="demandasAbertas" class="total">300</span>
            <h3>Demandas Abertas</h3>
        </div>
        <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
            <span id="demandasVistoriadas" class="total">250</span>
            <h3>Demandas Vistoriadas</h3>
        </div>
        <div class="col-lg-3 shadow p-3 mb-5 bg-body-tertiary rounded">
            <span id="demandasExecutadas" class="total">100</span>
            <h3>Demandas Executadas</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9" id="executadas_ultimos_30_dias">
            <h3>Executadas nos últimos 30 dias</h3>
        </div>
        <div class="col-lg-3" id="grafico_percentual"></div>
    </div>

    <div class="row">
        <div class="col-lg-9" id="execução_anual">
            <h3>Executadas no Ano</h3>
        </div>

        <div class="col-lg-3">
            <?php include 'top3.php'; ?>
        </div>
    </div>

    <footer>
        <div class="footer-text">
            <p class="footer-text__source">Desenvolvido pelos alunos 5º Ciclo ADS-Noturno 1ºSem/2024.</p>
        </div>
    </footer>

    <script>
        async function getUserData(nomeCidade) {
            const response = await fetch('get_data.php?cidade=' + nomeCidade);
            const data = await response.json();

            document.getElementById('totalDemandas').textContent = data.TotalDemandas;
            document.getElementById('demandasAbertas').textContent = data.DemandasAbertas;
            document.getElementById('demandasVistoriadas').textContent = data.DemandasVistoriadas;
            document.getElementById('demandasExecutadas').textContent = data.DemandasExecutadas;
        }

        async function getUnitData(nomeUnidade) {
            const response = await fetch('get_unit_data.php?unidade=' + nomeUnidade);
            const data = await response.json();

            document.getElementById('totalDemandas').textContent = data.TotalDemandas;
            document.getElementById('demandasAbertas').textContent = data.DemandasAbertas;
            document.getElementById('demandasVistoriadas').textContent = data.DemandasVistoriadas;
            document.getElementById('demandasExecutadas').textContent = data.DemandasExecutadas;
        }

        // Funções para inicializar os gráficos
        function atualizargrafico30() {
    var options = {
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
                        '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
                        '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#executadas_ultimos_30_dias"), options);
    chart.render();
  }
        function grafico_percentual() {
            var options = {
                series: [44, 55, 41, 17, 15],
                chart: {
                    type: 'donut',
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            var chart = new ApexCharts(document.querySelector("#grafico_percentual"), options);
            chart.render();
        }

        function execução_anual() {
            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 80, 33]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#execução_anual"), options);
            chart.render();
        }

        // Inicialize os gráficos quando o documento estiver carregado
        document.addEventListener('DOMContentLoaded', function() {
            atualizargrafico30();
            grafico_percentual();
            execução_anual();
        });
    </script>
</body>

</html>
