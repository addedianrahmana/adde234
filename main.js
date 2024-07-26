var count = 0;

var map = L.map("map").setView([-6.7113251, 108.5498207], 13);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

var marker = L.marker([-6.7118637, 108.5449298]).addTo(map);

$("#nolang").keydown(function (e) {
  if (e.keyCode == 13) {
    var nolang = $("#nolang").val();
    nolang = ("000000" + nolang).slice(-6);
    tampil(nolang);
  }
});

$("#proses").click(function () {
  var nolang = $("#nolang").val();
  nolang = ("000000" + nolang).slice(-6);
  tampil(nolang);
});

function tampil(nolang) {
  $.ajax({
    url:
      "http://193.1.1.193:81/tgnapi/pelanggan/nolang?token=sc0wkgsw0cksk0gwcgcsggk8w804scoo4k0ggc0k&nolang=" +
      nolang,
    method: "GET",
  }).done(function (data) {
    if (data.status === true) {
      console.log(data.data.nolang);

      $("#datanolang").val(data.data.nolang);
      $("#datanosamb").val(data.data.nosamw);
      $("#datatrf").val(data.data.jlw);
      $("#datastat").val(data.data.stat);
      $("#datastanbc").val(data.tagihan[0].met_k);

      $("#datanama").val(data.data.nama);
      $("#datadatameter").val(data.meter.no_met);
      $("#datamerk").val(data.meter.merk);
      $("#datadia").val(data.meter.dia_met);
      $("#datatagihan").val(data.rekap.total);
      $("#datatglpas").val(data.meter.tgl_pas);
      $("#datatglcab").val(data.meter.tgl_cbt);
      $("#datatglgm").val(data.meter.tgl_met);
      $("#datalat").val(data.lokasi.latitude);
      $("#datalong").val(data.lokasi.longitude);
      map.removeLayer(marker);

      marker = L.marker([data.lokasi.latitude, data.lokasi.longitude]).addTo(
        map
      );
    } else {
      Swal.fire({
        title: "Lokasi Tidak Ada",
        showClass: {
          popup: `
      animate__animated
      animate__fadeInUp
      animate__faster
    `,
        },
        hideClass: {
          popup: `
      animate__animated
      animate__fadeOutDown
      animate__faster
    `,
        },
      });
    }
  });
}

