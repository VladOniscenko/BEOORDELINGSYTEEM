let ctx = document.getElementById("myChart");
let mijndata = document.getElementById('mijnData').value;
let totaalPR = document.getElementById('totaal').value;

let beoordeling = JSON.parse(mijndata);

    // setup 
    const data = {
        labels: ['Huiswerk gemaakt', 'Maaltijd opgegeten', 'Speelgoed opgeruimd', 'Goed gedragen', 'Iets anders positief', 'Huiswerk niet gemaakt', 'Maaltijd niet opgegeten', 'Speelgoed niet opgeruimd', 'Niet goed gedragen', 'Iets anders negatief'],
      datasets: [{
        label: 'Aantal beoordelingen',
        data: [beoordeling[0], beoordeling[1], beoordeling[2], beoordeling[3], beoordeling[4], beoordeling[5], beoordeling[6], beoordeling[7], beoordeling[8], beoordeling[9]],
        backgroundColor: [
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(153, 230, 30, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
          'rgb(230, 46, 46, 0.5)',
        ],
        borderColor: [
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(153, 230, 30)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
            'rgb(230, 46, 46)',
        ],
        borderWidth: 1,
        cutout: '90%',
        borderRadius: 0,
        offset: 0
      }]
    };

    const customDatalabels = {
        id: 'customDatalabels',
        afterDatasetsDraw(chart, args, pluginOptions){
            const{ ctx, data, chartArea: {top, bottom, left, right, width, height}} = chart;

            ctx.save();
            const halfwidth = width / 2 + left;
            const halfheight = height / 2 + top;

            data.datasets[0].data.forEach((datapoint, index) =>{
                const {x, y} = chart.getDatasetMeta(0).data[index].tooltipPosition();
                ctx.font = 'bold 12px sans-serif';
                ctx.fillStyle = data.datasets[0].borderColor[index];
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';

                if(datapoint >=1){
                
                    ctx.fillText(datapoint, x, y);     
                    const xLine = x >= halfwidth ? x + 15 : x -15;
                    const yLine = y >= halfheight ? y + 25 : y -25;
                    const extraLine = x >= halfwidth ? 15 : -15;

                    const textWidth = ctx.measureText(data.labels[index]).width;
                    const textWidthPosition = x >= halfwidth ? 'left' : 'right';
                    const plusPX = x >= halfwidth ? 10 : -10;

                    ctx.textAlign = textWidthPosition;

                    ctx.strokeStyle = data.datasets[0].borderColor[index];
                    ctx.beginPath();
                    ctx.moveTo(x, y);
                    ctx.lineTo(xLine, yLine);
                    ctx.lineTo(xLine + extraLine, yLine);
                    ctx.stroke();
                    ctx.fillText(' ' + data.labels[index] + ' ', xLine + extraLine + plusPX, yLine);
                }
               
                    
            });
        }
    }

    const procentenInCirkel = {
        id: 'procentenInCirkel',
        afterDatasetsDraw(chart, args, pluginOptions){
            
            const{ ctx, data, chartArea: {top, bottom, left, right, width, height}} = chart;
            ctx.save();
            
            let fontTotaal = "";

            if(totaalPR >= 50){
                fontTotaal = "rgb(153, 230, 30)";
            }
            else{
                fontTotaal = "rgb(230, 46, 46)";
            }

            ctx.font = 'bold 60px sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            
            const totaal = `  ${totaalPR}%`;
            const textWidth = ctx.measureText(totaal).width;
            ctx.fillStyle = fontTotaal;
            ctx.fillText(totaal, (width / 2)+10, top + (height /2));
            ctx.restore();

        }
    }

    // config 
    const config = {
        type: 'doughnut',
        data,
        options: {
            layout:{
                padding: 30
            },
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                }
            }
        },
        plugins: [customDatalabels,procentenInCirkel]
    };

    

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );