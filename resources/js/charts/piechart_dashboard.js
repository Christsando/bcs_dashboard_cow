const dataValuesDummy = [9, 23, 10, 15, 8];

const classificationCtx = document.getElementById('classificationPieChart').getContext('2d');
const classificationPieChart = new Chart(classificationCtx, {
    type: 'doughnut',
    data: {
        labels: ['BCS 1', 'BCS 2', 'BCS 3', 'BCS 4', 'BCS 5'],
        datasets: [{
            data: dataValuesDummy,
            backgroundColor: [
                '#E4DEFF',
                '#8F7FD5',
                '#4B30C0',
                '#1C0094',
                '#10034B',
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    usePointStyle: true,
                    font: {
                        size: 11
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.label + ': ' + context.parsed + '%';
                    }
                }
            }
        }
    }
});