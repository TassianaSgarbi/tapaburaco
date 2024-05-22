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
            title: {
                    text: 'Dia'
                }
        },
        yaxis: {
            title: {
                text: 'Quantidade'
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

function grafico_percentual(totalDemandas,demandasAbertas,demandasVistoriadas,demandasExecutadas) { 
    
    var total = totalDemandas;
    var abertas = demandasAbertas;
    var vistoriadas = demandasVistoriadas;
    var executadas = demandasExecutadas;

    var percentuais = [
        (abertas / total) * 100,
        (vistoriadas / total) * 100,
        (executadas / total) * 100
    ];
    console.log(percentuais)
    var options = {
        series: percentuais,
        chart: {
            type: 'donut',
        },
        theme: {
            palette: 'palette2' // upto palette10
          },
        labels: ['Demandas Abertas', 'Demandas Vistoriadas', 'Demandas Executadas'],
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


function execucao_anual() {
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
    var chart = new ApexCharts(document.querySelector("#execucao_anual"), options);
    chart.render();
}

// Inicialize os gráficos quando o documento estiver carregado
document.addEventListener('DOMContentLoaded', function () {
    atualizargrafico30();
    grafico_percentual();
    execucao_anual();
});
