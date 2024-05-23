// Funções para inicializar os gráficos
async function atualizargrafico30(zona) {
    try { 
        const response = await fetch('dados_grafico.php?zone='+ zona);
        const data = await response.json();

        // Inicializa as categorias de dias e a quantidade inicial como zero
        const dias = Array();
        // const quantidades = Array(31).fill(0);
        const qtde = Array();

        // Preenche os dados de quantidade com base na resposta do PHP
        data.forEach(item => {
            // quantidades[item.qtde - 1] = item.Quantidade;
            qtde.push(item.qtde);
            dias.push(item.DATA);
        });

        var options = {
            series: [{
                name: 'Demandas Executadas',
                data: qtde
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
                enabled: true,
                formatter: function(val) {
                    return val.toFixed(0); // Mostra o valor como inteiro
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: dias,
                title: {
                    text: 'Dia'
                }
            },
            yaxis: {
                title: {
                    text: 'Quantidade'
                },
                tickAmount: "dataPoints"
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " demandas";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#executadas_ultimos_30_dias"), options);
        chart.render();
    } catch (error) {
        console.error('Erro ao obter os dados do gráfico:', error);
    }
}


function grafico_percentual(totalDemandas, demandasAbertas, demandasVistoriadas, demandasExecutadas) {
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
            name: '',
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
            enabled: true,
            formatter: function(val) {
                return val.toFixed(0); // Mostra o valor como inteiro
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            title: {
                text: 'Mês'
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
                formatter: function(val) {
                    return "" + val + "  demandas";
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#execucao_anual"), options);
    chart.render();
}


// Inicialize os gráficos quando o documento estiver carregado
document.addEventListener('DOMContentLoaded', function () {
    // atualizargrafico30();
    execucao_anual();
});
