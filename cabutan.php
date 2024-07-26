<?php
require_once('templates/header.php');
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Pelanggan</h1>
    <div class="card mt-4">
        <div class="card-header">
            <label for="nolang" class="form-label">Pencarian Nolang
                <input type="text" class="form-control" id="nolang" name="nolang" maxlength="6" />
            </label>
            <button type="button" class="btn btn-primary" id="proses">Cari</button>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title text-center">Informasi Pelanggan</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Nolang</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datanolang" name="datanolang" disabled></td>
                                    <td></td>
                                    <td>No Sambungan</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datanosamb" name="datanosamb" disabled></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datanama" name="datanama" disabled></td>
                                    <td></td>
                                    <td>Tarif</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datatrf" name="datatrf" disabled></td>
                                </tr>
                                <tr>
                                    <td>Data Meter</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datadatameter" name="datadatameter" disabled></td>
                                    <td></td>
                                    <td>Status</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datastat" name="datastat" disabled></td>
                                </tr>
                                <tr>
                                    <td>Merk Meter</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datamerk" name="datamerk" disabled></td>
                                    <td></td>
                                    <td>Stand Baca Terakhir</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datastanbc" name="datastanbc" disabled></td>

                                </tr>
                                <tr>
                                    <td>Diameter</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datadia" name="datadia" disabled></td>
                                    <td></td>
                                    <td>Tagihan</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datatagihan" name="datatagihan" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title text-center">Riwayat Pelanggan</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Tanggal Perbaikan</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datatglpas" name="datatglpas" disabled></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cabut</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datatglcab" name="datatglcab" disabled></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Penggantian Meter</td>
                                    <td>: </td>
                                    <td> <input type="text" class="form-control" id="datatglgm" name="datatglgm" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                Lokasi Pelanggan
            </div>
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <td>Lat :<input type="text" class="form-control w-3" id="datalat" name="datalat" disabled></td>
                    <td>Long :<input type="text" class="form-control w-3" id="datalong" name="datalong" disabled></td>
                </thead>
                <tbody>
                    <div id="map" style="width:auto;height:500px;"></div>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="main.js"></script>
<?php
require_once('templates/footer.php');
?>