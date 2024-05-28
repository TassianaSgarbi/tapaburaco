// Variáveis para armazenar as instâncias dos gráficos
let chartUltimos30Dias = null;
let chartPercentual = null;
let chartExecucaoAnual = null;

// Funções para inicializar os gráficos
async function atualizargrafico30(zona) {
    try { 
        const response = await fetch('dados_grafico.php?zone=' + zona + '&dataType=30days');
        const data = await response.json();

        const dias = [];
        const qtde = [];

        data.forEach(item => {
            qtde.push(item.qtde);
            dias.push(item.data);
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
                    text: ""
                }
            },
            yaxis: {
                title: {
                    text: 'Demandas'
                },
                tickAmount: "dataPoints"
            },
            fill: {
                opacity: 4
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " demandas";
                    }
                }
            }
        };

        if (chartUltimos30Dias) {
            chartUltimos30Dias.destroy();
        }
        chartUltimos30Dias = new ApexCharts(document.querySelector("#executadas_ultimos_30_dias"), options);
        chartUltimos30Dias.render();
    } catch (error) {
        console.error('Erro ao obter os dados do gráfico:', error);
    }
}

function grafico_percentual(totalDemandas, demandasAbertas, demandasVistoriadas, demandasExecutadas) {
    var percentuais = [
        (demandasAbertas / totalDemandas) * 100,
        (demandasVistoriadas / totalDemandas) * 100,
        (demandasExecutadas / totalDemandas) * 100
    ];

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

    if (chartPercentual) {
        chartPercentual.destroy();
    }
    chartPercentual = new ApexCharts(document.querySelector("#grafico_percentual"), options);
    chartPercentual.render();
}

async function execucao_anual(zona) {
    try { 
        const response = await fetch('dados_grafico.php?zone=' + zona + '&dataType=annual');
        const data = await response.json();

        const qtde = Array(12).fill(0);

        data.forEach(item => {
            qtde[item.mes - 1] = item.qtde;
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
                categories: ['Jan', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                title: {
                    text: ''
                }
            },
            yaxis: {
                title: {
                    text: 'Demandas'
                }
            },
            fill: {
                opacity: 4
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " demandas";
                    }
                }
            }
        };

        if (chartExecucaoAnual) {
            chartExecucaoAnual.destroy();
        }
        chartExecucaoAnual = new ApexCharts(document.querySelector("#execucao_anual"), options);
        chartExecucaoAnual.render();
    } catch (error) {
        console.error('Erro ao obter os dados do gráfico:', error);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    fetchData('Santos');
});

function fetchData(zone) {
    document.getElementById('loading').style.display = 'block'; // Mostrar loading

    fetch('fetchData.php?zone=' + encodeURIComponent(zone))
        .then(response => response.json())
        .then(data => {
            setTimeout(() => {
                document.getElementById('loading').style.display = 'none'; // Ocultar loading
            }, 2000);
            
            document.getElementById('totalDemandas').innerText = data.totalDemandas;
            document.getElementById('demandasAbertas').innerText = data.demandasAbertas;
            document.getElementById('demandasVistoriadas').innerText = data.demandasVistoriadas;
            document.getElementById('demandasExecutadas').innerText = data.demandasExecutadas;
            document.getElementById('alert').innerHTML = zone;

            atualizargrafico30(zone);
            grafico_percentual(data.totalDemandas, data.demandasAbertas, data.demandasVistoriadas, data.demandasExecutadas);
            execucao_anual(zone);
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            console.error('Error:', error);
        });
}
