const conditionScoreCtx = document.getElementById('conditionScoreChart').getContext('2d');
const conditionScoreChart = new Chart(conditionScoreCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Body Condition Score',
            data: [1, 1, 2, 2, 4, 5, 4, 5, 4, 4, 3, 3],
            borderColor: '#4318FF',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.3,
            fill: true,
            pointBackgroundColor: '#4318FF',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            // symbols
            legend: {
                display: false
            },

            // onhover effect
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return ' BCS ' + context.parsed.y.toLocaleString();
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                min: 0,
                max: 5,
                ticks: {
                    stepSize: 1,
                    precision: 0,
                    callback: function (value) {
                        return ' BCS ' + value.toLocaleString();
                    }
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});