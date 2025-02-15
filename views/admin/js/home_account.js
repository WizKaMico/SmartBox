function updateChartData() {
    fetch('../graph/graphapi.php')
        .then(response => response.json())
        .then(data => {
            const weekLabels = [];
            const usageData = [];
            
            data.forEach(item => {
                let labelDate = new Date(item.date);
                const date = labelDate.getDate();
                const month = labelDate.toLocaleString('en-US', { month: 'short' });
                weekLabels.push(`${month} ${date}`);
                usageData.push(item.usage_count);  
            });

            usageChart.data.labels = weekLabels;
            usageChart.data.datasets[0].data = usageData;
            usageChart.update(); 
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}


var ctx = document.getElementById('usageChart').getContext('2d');
var usageChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [], 
        datasets: [{
            data: [], 
            borderColor: '#343a40',
            fill: false,
            borderWidth: 2.5,
            pointBackgroundColor: 'white'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: false
                }
            }
        }
    }
});


updateChartData();


setInterval(updateChartData, 30000);