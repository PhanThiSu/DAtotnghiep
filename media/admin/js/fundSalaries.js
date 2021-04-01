window.onload = function() {
    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
            labels: dataPointsSalaryLabel,
            datasets: [
                {
                label: "Population (millions)",
                backgroundColor: ["Red","Orange","Green","Gold","Pink","Violet","Pink","Purple","Blue","Yellow","Chocolate","Tomato"],

                data: dataPointsSalary
                }
            ]
        },
        options: {
            
            legend: { display: false },
            title: {
                display: true,
                text: 'Chart Salaries (millions)'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" (vnd)";
                    }
                }
            },
            scales: {
                yAxes: [
                    {
                        ticks: {
                            callback: function(label, index, labels) {
                                return label/1000000+'millions';
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: '1m = 1000000(vnd)'
                        }
                    }
                ]
            }
            
        }
    });
}