<?php
require_once('templates/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Barang Keluar</h1>

    <?php
    if (isset($_SESSION['status'])) {
    ?>
        <div class="alert auto-close alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['status']);
    }
    ?>

    <?php
    if (isset($_SESSION['gagal'])) {
    ?>
        <div class="alert auto-close alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['gagal']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['gagal']);
    }
    ?>

    <div class="card mb-2">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#BrgKeluar">
                Tambah Barang Keluar
            </button>

            <!-- Modal -->
            <div class="modal fade" id="BrgKeluar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengeluaran Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <select name="idbarang" id="idbarang" onchange="changeValue(this.value)" class="form-control">
                                    <option disabled="" selected="">Pilih</option>
                                    <?php
                                    $alldata = mysqli_query($conn, "SELECT `idbarang`,`namabarang`,`diameter`,
                                                SUM(qtymasuk)AS barangmasuk,SUM(qtykeluar)AS barangkeluar,`jenis`,
                                                SUM(qtymasuk-qtykeluar)AS stok
                                                FROM transaksi
                                                GROUP BY idbarang");
                                    $jsArray = "var dtBarang = new Array();\n";
                                    while ($row = mysqli_fetch_array($alldata)) {
                                        echo '<option value="' . $row['idbarang'] . '">' . $row['idbarang'] . '</option> ';
                                        $jsArray .= "dtBarang['" . $row['idbarang'] . "'] = {
                                        namabarang:'" . addslashes($row['namabarang']) . "',
                                        diameter:'" . addslashes($row['diameter']) . "',
                                        stok:'" . addslashes($row['stok']) . "'
                                        };\n";
                                    }
                                    ?>
                                </select>
                                <br>
                                <input class="form-control" type="text" name="namabrg" id="namabrg" placeholder="Nama Barang" required readonly />
                                <br>
                                <input class="form-control" type="text" name="dia" id="dia" placeholder="Diameter" required readonly />
                                <br>
                                <input class="form-control" type="date" name="tglkeluar" id="tglkeluar" placeholder="17/08/1945" required />
                                <br>
                                <input class=" form-control" type="number" name="qtykeluar" id="qtykeluar" placeholder="Qty" required />
                                <br>
                                <input class="form-control" type="text" name="jenis" id="jenis" placeholder="KELUAR" value="KELUAR" required readonly />
                                <br>
                                <input class=" form-control" type="text" name="penerima" id="penerima" placeholder="Penerima" required />
                                <br>
                                <input class=" form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" />
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="barangkeluar" id="barangkeluar">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card-body">
                <form method="post">
                    <div class="input-group" style="width: 50%;">
                        <select class="form-control" style="width:170px;" name="month">
                            <option value='01'>January</option>
                            <option value='02'>February</option>
                            <option value='03'>March</option>
                            <option value='04'>April</option>
                            <option value='05'>May</option>
                            <option value='06'>June</option>
                            <option value='07'>July</option>
                            <option value='08'>August</option>
                            <option value='09'>September</option>
                            <option value='10'>October</option>
                            <option value='11'>November</option>
                            <option value='12'>December</option>
                        </select>
                        <input type="text" name="tahun" class="form-control" placeholder="2024" value="2024">
                        <button class="btn btn-danger btn-sm" type="submit" id="filter" name="filter">Filter</button>
                        <button class="btn btn-primary btn-sm" type="submit" id="all" name="all">All Data</button>
                    </div>
                </form>

                <table class="table table-striped table-bordered" style="width: 100%;" id="TblStokBarang">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Diameter</th>
                            <th>Tanggal Keluar</th>
                            <th>Qty Keluar</th>
                            <th>Petugas</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['filter'])) {
                            $selected = $_POST['month'];
                            $year = $_POST['tahun'];

                            $sql = "SELECT * FROM transaksi WHERE jenis = 'KELUAR' and MONTH(tglkeluar)='$selected' and YEAR(tglkeluar)='$year' ORDER BY tglkeluar DESC";
                            $query = $conn->query($sql);
                        } elseif (isset($_POST['all'])) {
                            $sql = "SELECT * FROM transaksi WHERE jenis = 'KELUAR' ORDER BY tglkeluar DESC";
                            $query = $conn->query($sql);
                        } else {
                            $sql = "SELECT * FROM transaksi WHERE jenis = 'KELUAR' ORDER BY tglkeluar DESC";
                            $query = $conn->query($sql);
                        }
                        while ($row = $query->fetch_assoc()) : ?>
                            <tr style="text-align: center;">
                                <td><?php echo $row['idbarang']; ?></td>
                                <td><?php echo $row['namabarang']; ?></td>
                                <td><?php echo $row['diameter']; ?></td>
                                <td><?php echo $row['tglkeluar']; ?></td>
                                <td><?php echo $row['qtykeluar']; ?></td>
                                <td><?php echo $row['penerima']; ?></td>
                                <td><?php echo $row['keterangan']; ?></td>
                                <td><a type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahBrg<?php echo $row['id_transaksi']; ?>">Ubah</a>
                                    <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusBrg<?php echo $row['id_transaksi']; ?>">Hapus</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="ubahBrg<?php echo $row['id_transaksi']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Pengeluaran Barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <input class="form-control" type="hidden" name="id_transaksi" id="id_transaksi" placeholder="ID Barang" value="<?php echo $row['id_transaksi']; ?>" required readonly />
                                                <input class="form-control" type="text" name="idbarang" id="idbarang" placeholder="ID Barang" value="<?php echo $row['idbarang']; ?>" required readonly />
                                                <br>
                                                <input class="form-control" type="text" name="namabrg" id="namabrg" placeholder="Nama Barang" value="<?php echo $row['namabarang']; ?>" required readonly />
                                                <br>
                                                <input class="form-control" type="text" name="dia" id="dia" placeholder="Diameter" value="<?php echo $row['diameter']; ?>" required readonly />
                                                <br>
                                                <input class="form-control" type="date" name="tglkeluar" id="tglkeluar" placeholder="17/08/1945" value="<?php echo $row['tglkeluar']; ?>" required />
                                                <br>
                                                <input class=" form-control" type="number" name="qtykeluar" id="qtykeluar" placeholder="Qty" value="<?php echo $row['qtykeluar']; ?>" required />
                                                <br>
                                                <input class="form-control" type="text" name="jenis" id="jenis" placeholder="MASUK" value="<?php echo $row['jenis']; ?>" required readonly />
                                                <br>
                                                <input class=" form-control" type="text" name="penerima" id="penerima" placeholder="Petugas" value="<?php echo $row['penerima']; ?>" required />
                                                <br>
                                                <input class=" form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $row['keterangan']; ?>" />
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="ubahbarangkeluar" id="ubahbarangkeluar">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="hapusBrg<?php echo $row['id_transaksi']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Ini ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <input class="form-control" type="hidden" name="id_transaksi" id="id_transaksi" placeholder="ID Barang" value="<?php echo $row['id_transaksi']; ?>" required readonly />
                                            </div>
                                            <div class="modal-footer" style="justify-content: center; align-items:center;">
                                                <button type="submit" class="btn btn-dark btn-sm" name="hapusbarangkeluar" id="hapusbarangkeluar">OK</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php
    echo $jsArray;
    ?>

    function changeValue(idbarang) {
        document.getElementById('namabrg').value = dtBarang[idbarang].namabarang;
        document.getElementById('dia').value = dtBarang[idbarang].diameter;
        document.getElementById('qtykeluar').placeholder = dtBarang[idbarang].stok;
    };
</script>

<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#TblStokBarang').DataTable();
    });
</script>
<?php
require_once('templates/footer.php');
?>