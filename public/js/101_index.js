var ctx = document.getElementById("myChart").getContext('2d');
var num1=100;
var num2=100;
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["当月消費", "予算残"],
        datasets: [{
            label: '今月の変動費',
            data: [num1,num2 ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
      title:{
        display:true,
        text:'今月の変動費'
      },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});


$(function(){
    myChart.data.datasets[0].data[0]=999;
    myChart.data.datasets[0].data[1]=250;
    myChart.update();
})
