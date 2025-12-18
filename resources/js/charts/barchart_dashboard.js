const conditionScoreCtx = document.getElementById('conditionScoreChart').getContext('2d');
const conditionScoreChart = new Chart(conditionScoreCtx, {
    type: 'bar', // <-- ubah line jadi bar
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Body Condition Score',
            data: [], // kosongkan data, biar dinamis dari backend
            backgroundColor: '#4318FF', // warna batang
            borderRadius: 6, // biar rounded
            maxBarThickness: 30
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
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

fetch('/bcs-chart-data')
    .then(res => res.json())
    .then(data => {
        const monthlyScores = data.monthly_scores;

        conditionScoreChart.data.datasets[0].data = monthlyScores;
        conditionScoreChart.update();
    });