var sucursalId = $('#sucursal').val();

$.post("../../controllers/compraControllers.php?op=listartopproducto",{idsucursal:sucursalId},function(data){
    $("#listtopcompraproducto").html(data);
});


$.post("../../controllers/ventaControllers.php?op=listartopproducto",{idsucursal:sucursalId},function(data){
    $("#listtopventaproducto").html(data);
});

$.post("../../controllers/compraControllers.php?op=top5",{idsucursal:sucursalId},function(data){
    $("#listventatop5").html(data);
});

$.post("../../controllers/categoriaControllers.php?op=stock",{idsucursal:sucursalId},function(data){
    $("#listcategoriastock").html(data);
});

$.post("../../controllers/compraControllers.php?op=compraventa",{idsucursal:sucursalId},function(data){
    $("#listcompraventa").html(data);
});

listtopventaproducto


$.ajax({
    url:"../../controllers/compraControllers.php?op=dountcompra",
    method: "POST",
    data: {idsucursal:sucursalId},
    success: function(data){

        data=JSON.parse(data);

        var categoria=[];
        var cantidad=[];
        for (var i in data){
            categoria.push(data[i].categoriaNombre);
            cantidad.push(data[i].cantidad);
        }

        var isdoughnutchart = document.getElementById("grafdona");
        (doughnutChartColors = getChartColorsArray("grafdona")),
        doughnutChartColors &&
            (lineChart = new Chart(isdoughnutchart, {
            type: "doughnut",
            data: {
                labels: categoria,
                datasets: [
                {
                    data: cantidad,
                    backgroundColor: doughnutChartColors,
                    hoverBackgroundColor: doughnutChartColors,
                    hoverBorderColor: "#fff",
                },
                ],
            },
            options: {
                plugins: { legend: { labels: { font: { family: "Poppins" } } } },
            },
            }));
    }
});

/*
$.ajax({
    url:"../../controller/compra.php?op=barras",
    method: "POST",
    data: {suc_id:sucursalId},
    success: function(data){

        data=JSON.parse(data);

        var fecha=[];
        var total=[];
        for (var i in data){
            fecha.push(data[i].FECH_CREA);
            total.push(data[i].COMPR_TOTAL);
        }

        var barChart,
        isbarchart = document.getElementById("grafcompra");
        (barChartColor = getChartColorsArray("grafcompra")),
        barChartColor &&
        (isbarchart.setAttribute("width", isbarchart.parentElement.offsetWidth),
        (barChart = new Chart(isbarchart, {
            type: "bar",
            data: {
            labels: fecha,
            datasets: [
                {
                label: "Compras",
                backgroundColor: barChartColor[0],
                borderColor: barChartColor[0],
                borderWidth: 1,
                hoverBackgroundColor: barChartColor[1],
                hoverBorderColor: barChartColor[1],
                data: total,
                },
            ],
            },
            options: {
            x: { ticks: { font: { family: "Poppins" } } },
            y: { ticks: { font: { family: "Poppins" } } },
            plugins: { legend: { labels: { font: { family: "Poppins" } } } },
            },
        })));
    }
});

$.ajax({
    url:"../../controller/venta.php?op=barras",
    method: "POST",
    data: {suc_id:sucursalId},
    success: function(data){

        data=JSON.parse(data);

        var fechav=[];
        var totalv=[];
        for (var i in data){
            fechav.push(data[i].FECH_CREA);
            totalv.push(data[i].VENT_TOTAL);
        }

    var barChart,
    isbarchart = document.getElementById("grafventa");
    (barChartColor = getChartColorsArray("grafventa")),
      barChartColor &&
        (isbarchart.setAttribute("width", isbarchart.parentElement.offsetWidth),
        (barChart = new Chart(isbarchart, {
          type: "bar",
          data: {
            labels: fechav,
            datasets: [
              {
                label: "Ventas",
                backgroundColor: barChartColor[0],
                borderColor: barChartColor[0],
                borderWidth: 1,
                hoverBackgroundColor: barChartColor[1],
                hoverBorderColor: barChartColor[1],
                data: totalv,
              },
            ],
          },
          options: {
            x: { ticks: { font: { family: "Poppins" } } },
            y: { ticks: { font: { family: "Poppins" } } },
            plugins: { legend: { labels: { font: { family: "Poppins" } } } },
          },
        })));
    }
});
*/