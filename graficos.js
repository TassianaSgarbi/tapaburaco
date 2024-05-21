// Chamada da função para atualizar o gráfico dos últimos 30 dias
atualizargrafico30();

// Definição das opções do gráfico de donut
var optionsDonut = {
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

// Renderização do gráfico de donut
var chartDonut = new ApexCharts(document.querySelector("#grafico_percentual"), optionsDonut);
chartDonut.render();

// Definição das opções do gráfico de barras
var optionsBar = {
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

// Renderização do gráfico de barras
var chartBar = new ApexCharts(document.querySelector("#execução_anual"), optionsBar);
chartBar.render();
