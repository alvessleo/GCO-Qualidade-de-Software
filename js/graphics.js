const ctx = document.getElementById('graphicbars').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Gustavo', 'Leonardo', 'Luiz', 'Vinícius', 'Pedro'],
        datasets: [{
            label: 'Funcionários com o maior número de Não conformidades',
            data: [12, 19, 3, 5, 2],
            backgroundColor: [
                'rgba(47, 48, 97, 0.2)',
                'rgba(35, 100, 170, 0.2)',
                'rgba(249, 166, 32, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(96, 165, 97, 0.2)'
            ],
            borderColor: [
                'rgba(47, 48, 97, 1)',
                'rgba(35, 100, 170, 1)',
                'rgba(249, 166, 32, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(96, 165, 97, 1)'
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
                'rgba(27, 65, 121, 0.34)',
                'rgba(79, 109, 122, 0.31)'
            ],
            borderColor: [
                'rgba(27, 65, 121, 1)',
                'rgba(79, 109, 122, 1)'
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