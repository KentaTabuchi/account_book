var dataLabelPlugin = {
    afterDatasetsDraw: function(chart) {
        var ctx = chart.ctx;
        chart.data.datasets.forEach(function(dataset, 系列) {
            var meta = chart.getDatasetMeta(系列);
            if (!meta.hidden) {
                meta.data.forEach(function(element, 要素) {
                                                   // ステップ１　数値を文字列に変換
                    var dataString = dataset.data[要素].toString()+'円';
                                                   // ステップ２　文字列の書体
                    ctx.fillStyle = "green";            // 色　'rgb(0, 0, 0)', 'rgba(192, 80, 77, 0.7)'
                    var fontSize = 24;                  // サイズ
                    var fontStyle = "bold";           // 書体 "bold", "italic"
                    var fontFamily = "imes New Roman";           // フォントの種類 "sans-serif", "ＭＳ 明朝"
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
                                                   // ステップ３　文字列の位置の基準点
                    ctx.textAlign = 'center';           // 文字列　start, end, left, right, center
                    ctx.textBaseline = 'middle';        // 文字高　middle, top, bottom
                                                   // ステップ４　文字列のグラフでの位置
                    var padding = 5;                   // 点と文字列の距離
                    var position = element.tooltipPosition();
                                                       //文字列の表示　 fillText(文字列, Ｘ位置, Ｙ位置)
                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                });
            }
        });
    }
}


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
    },
    plugins:[dataLabelPlugin]
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