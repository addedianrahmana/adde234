<?php
require_once('templates/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Stok Barang</h1>

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

    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Master">
                Tambah Master Barang
            </button>

            <!-- Modal -->
            <div class="modal fade" id="Master" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <input class="form-control" type="text" name="idbarang" placeholder="ID Barang" required />
                                <br>
                                <input class="form-control" type="text" name="namabarang" placeholder="Nama Barang" required />
                                <br>
                                <input class="form-control" type="text" name="diameter" placeholder="Diameter" required />
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="addnew" class="btn btn-primary" name="addnewbarang">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card-body">
                <table class="table table-striped" style="width: 100%;" id="TblStokBarang">
                    <thead>
                        <tr style="text-align: center;">
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Diameter</th>
                            <th>Qty Masuk</th>
                            <th>Qty Keluar</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT `idbarang`,`namabarang`,`diameter`,`tglmasuk`,
                            SUM(qtymasuk)AS barangmasuk,SUM(qtykeluar)AS barangkeluar,`jenis`,
                            SUM(qtymasuk-qtykeluar) AS stok,`penerima`,`keterangan` 
                            FROM transaksi
                            GROUP BY idbarang";
                        $query = $conn->query($sql);

                        while ($row = $query->fetch_assoc()) : ?>
                            <tr style="text-align: center;">
                                <td><?php echo $row['idbarang']; ?></td>
                                <td><?php echo $row['namabarang']; ?></td>
                                <td><?php echo $row['diameter']; ?></td>
                                <td><?php echo $row['barangmasuk']; ?></td>
                                <td><?php echo $row['barangkeluar']; ?></td>
                                <td><?php echo $row['stok']; ?></td>
                                <td><a type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahMasterBrg<?php echo $row['idbarang']; ?>">Ubah</a>
                                    <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusMasterBrg<?php echo $row['idbarang']; ?>">Hapus</a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="ubahMasterBrg<?php echo $row['idbarang']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Pemasukan Barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <input class="form-control" type="hidden" name="id_transaksi" id="id_transaksi" placeholder="ID Barang" value="<?php echo $row['idbarang']; ?>" required  />
                                                <input class="form-control" type="text" name="idbarang" id="idbarang" placeholder="ID Barang" value="<?php echo $row['idbarang']; ?>" required  />
                                                <br>
                                                <input class="form-control" type="text" name="namabrg" id="namabrg" placeholder="Nama Barang" value="<?php echo $row['namabarang']; ?>" required  />
                                                <br>
                                                <input class="form-control" type="text" name="dia" id="dia" placeholder="Diameter" value="<?php echo $row['diameter']; ?>" required  />
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="ubahmasterbarang" id="ubahmasterbarang">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="hapusMasterBrg<?php echo $row['idbarang']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Ini ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <input class="form-control" type="hidden" name="idbarang" id="idbarang" placeholder="ID Barang" value="<?php echo $row['idbarang']; ?>" required />
                                            </div>
                                            <div class="modal-footer" style="justify-content: center; align-items:center;">
                                                <button type="submit" class="btn btn-dark btn-sm" name="hapusmasterbarang" id="hapusmasterbarang">OK</button>
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