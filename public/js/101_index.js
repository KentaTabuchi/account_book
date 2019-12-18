var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["当月消費", "予算残"],
        datasets: [{
            label: '今月の変動費',
            data: [0,0 ],
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
    asyncFunc();
})
/**
 *  ajaxでjsonから変動費の合計を取得して円グラフの値に代入する
 */
async function asyncFunc () {
    const res1 = await axios.get('json_total_cost');
    console.log(res1.data.total_cost);
    const cost = res1.data.total_cost;
    myChart.data.datasets[0].data[0]= cost; //変動費
    myChart.data.datasets[0].data[1]= 20000 - cost;
    myChart.update();
    return res1.data.total_cost;
  }