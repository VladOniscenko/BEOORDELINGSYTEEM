let mijndata = document.getElementById("mijnData").value;
let beoordeling = JSON.parse(mijndata);

let fontkleur = "rgb(153, 230, 30)";

let data0 = beoordeling[0];
let data1 = beoordeling[1];
let data2 = beoordeling[2];
let data3 = beoordeling[3];
let data4 = beoordeling[4];
let data5 = beoordeling[5];
let data6 = beoordeling[6];
let data7 = beoordeling[7];
let data8 = beoordeling[8];
let data9 = beoordeling[9];

let totaleAantal = data0 + data1 + data2 + data3 + data4 + data5 + data6 + data7 + data8 + data9;
let positieveAantal = data0 + data1 + data2 + data3 + data4;
let negatieveAantal = data5 + data6 + data7 + data8 + data9;

let iets = 100 / totaleAantal;
let totaalPR;

if(totaleAantal <= 0){
    totaalPR = "Geen beoordeligen gevonden";
}
else{
    if(positieveAantal > negatieveAantal){
        fontkleur = "153, 230, 30";
        totaalPR = `${Math.round(positieveAantal * iets)}%`;
    }
    else if(negatieveAantal > positieveAantal){
        fontkleur = "230, 46, 46";
        totaalPR = `${Math.round(negatieveAantal * iets)}%`;
    }
    else{
        fontkleur = "250, 86, 53";
        totaalPR = `50%`;
    }
}




let ctx = document.getElementById("myChart");
const data = {
        labels: ["Huiswerk gemaakt", "Maaltijd opgegeten", "Speelgoed opgeruimd", "Goed gedragen", "Iets anders positief", "Huiswerk niet gemaakt", "Maaltijd niet opgegeten", "Speelgoed niet opgeruimd", "Niet goed gedragen", "Iets anders negatief"],
        datasets: [{
            label: "Aantal beoordelingen",
            data: [beoordeling[0], beoordeling[1], beoordeling[2], beoordeling[3], beoordeling[4], beoordeling[5], beoordeling[6], beoordeling[7], beoordeling[8], beoordeling[9]],
            backgroundColor: ["rgb(153, 230, 30, 0.5)", "rgb(153, 230, 30, 0.5)", "rgb(153, 230, 30, 0.5)", "rgb(153, 230, 30, 0.5)", "rgb(153, 230, 30, 0.5)", "rgb(230, 46, 46, 0.5)", "rgb(230, 46, 46, 0.5)", "rgb(230, 46, 46, 0.5)", "rgb(230, 46, 46, 0.5)", "rgb(230, 46, 46, 0.5)"],
            borderColor: ["rgb(153, 230, 30)", "rgb(153, 230, 30)", "rgb(153, 230, 30)", "rgb(153, 230, 30)", "rgb(153, 230, 30)", "rgb(230, 46, 46)", "rgb(230, 46, 46)", "rgb(230, 46, 46)", "rgb(230, 46, 46)", "rgb(230, 46, 46)"],
            borderWidth: 1,
            cutout: "90%",
            borderRadius: 0,
            offset: 0
        }]
    },
    customDatalabels = {
        id: "customDatalabels",
        afterDatasetsDraw(a) {
            const {
                ctx: b,
                data: c,
                chartArea: {
                    top: d,
                    bottom: e,
                    left: f,
                    right: g,
                    width: h,
                    height: i
                }
            } = a;
            b.save();
            const j = h / 2 + f;
            c.datasets[0].data.forEach((e, f) => {
                const {
                    x: g,
                    y: h
                } = a.getDatasetMeta(0).data[f].tooltipPosition();
                if (b.font = "bold 12px sans-serif", b.fillStyle = c.datasets[0].borderColor[f], b.textAlign = "center", b.textBaseline = "middle", 1 <= e) {
                    b.fillText(e, g, h);
                    const a = g >= j ? g + 15 : g - 15,
                        k = h >= i / 2 + d ? h + 25 : h - 25,
                        l = g >= j ? 15 : -15,
                        m = b.measureText(c.labels[f]).width,
                        n = g >= j ? "left" : "right",
                        o = g >= j ? 10 : -10;
                    b.textAlign = n, b.strokeStyle = c.datasets[0].borderColor[f], b.beginPath(), b.moveTo(g, h), b.lineTo(a, k), b.lineTo(a + l, k), b.stroke(), b.fillText(" " + c.labels[f] + " ", a + l + o, k)
                }
            })
        }
    },
    procentenInCirkel = {
        id: "procentenInCirkel",
        afterDatasetsDraw(a) {
            const {
                ctx: b,
                data: c,
                chartArea: {
                    top: d,
                    bottom: e,
                    left: f,
                    right: g,
                    width: h,
                    height: i
                }
            } = a;
            b.save();
            let j = "";
            j = 50 <= totaalPR ? `rgb(${fontkleur})` : `rgb(${fontkleur})`, b.font = "bold 90px sans-serif", b.textAlign = "center", b.textBaseline = "middle";
            const k = ` ${totaalPR}`,
                l = b.measureText(k).width;
            b.fillStyle = j, b.fillText(k, h / 2 + 10, d + i / 2), b.restore()
        }
    },
    config = {
        type: "doughnut",
        data,
        options: {
            layout: {
                padding: 30
            },
            maintainAspectRatio: !1,
            plugins: {
                legend: {
                    display: !1
                }
            }
        },
        plugins: [customDatalabels, procentenInCirkel]
    },
    myChart = new Chart(document.getElementById("myChart"), config);