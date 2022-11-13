const ctx = document.getElementById('graphicbars').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Gustavo', 'Leonardo', 'Luiz', 'Vinícius', 'Pedro'],
        datasets: [{
            label: 'Funcionários com o maior número de Não conformidades',
            data: [12, 19, 3, 5, 2],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options:
    {
        scales:
        {

            yAxes:
                [{
                    ticks:
                    {
                        fontSize: 32,
                        fontColor: "#df6161"
                    }
                }],

            y:
            {
                beginAtZero: true
            }
        }
    }
});

const ctx3 = document.getElementById('graphicconform').getContext('2d');
const myChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ['Conformidades', 'Não Conformidades'],
        datasets: [{
            label: 'Conformidade / Não Conformidade',
            data: [15, 5],
            backgroundColor: [
                'rgba(99, 255, 120, 0.2)',
                'rgba(235, 54, 99, 0.2)'
            ],
            borderColor: [
                'rgba(99, 255, 120, 1)',
                'rgba(235, 54, 99, 1)'
            ],
            borderWidth: 1
        }]
    },
    options:
    {
        scales:
        {

            yAxes:
                [{
                    ticks:
                    {
                        fontSize: 32,
                        fontColor: "#df6161"
                    }
                }],

            y:
            {
                beginAtZero: true
            }
        }
    }
});





const ctx2 = document.getElementById('graphicpie');
const myChart2 = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Conformidades', 'Não Conformidades'],
        datasets: [{
            label: 'Funcionários com maior numero de Não conformidades',
            data: [15, 5],
            backgroundColor: [
                'rgba(99, 255, 120, 0.2)',
                'rgba(235, 54, 99, 0.2)'
            ],
            borderColor: [
                'rgba(99, 255, 120, 1)',
                'rgba(235, 54, 99, 1)'
            ],
            borderWidth: 1
        }]
    },
});