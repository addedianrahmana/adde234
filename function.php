<?php

session_start();

// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stokbarang");
#####################################################################################################
                                        // INDEX 

//Synchronize
if (isset($_POST['sync'])) {

    $sync = mysqli_query($conn, "UPDATE transaksi SET stok=qtymasuk-qtykeluar");
    if ($sync) {
        $_SESSION['status'] = "Synchronize Berhasil";
        header('location:index.php');
        unset($_POST);
        exit();
    } else {

        $_SESSION['gagal'] = "Synchronize Gagal";
        header('location:index.php');
        unset($_POST);
        exit();
    }
}

#####################################################################################################
                                    // MASTER BARANG 

// tambah barang baru
if (isset($_POST['addnewbarang'])) {
    $idbarang   = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $diameter   = $_POST['diameter'];

    $cekidbarang = mysqli_query($conn, "SELECT * FROM transaksi WHERE idbarang='$idbarang'");
    $hitung = mysqli_num_rows($cekidbarang);
    if ($hitung < 1) {

        $addtotable = mysqli_query($conn, "INSERT into transaksi (idbarang,namabarang,diameter)values('$idbarang','$namabarang','$diameter')");
        if ($addtotable) {
            $_SESSION['status'] = "Data Master Berhasil Di Input";
            header('location :index.php');
        }
    } else {
        $_SESSION['gagal'] = "Data Master Gagal Di Input,ID Barang Sudah Ada";
        header('location :index.php');
    }
}

//ubah master barang
if (isset($_POST['ubahmasterbarang'])) {
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabrg'];
    $dia = $_POST['dia'];

    $editmaster = mysqli_query($conn, "UPDATE transaksi SET idbarang='$idbarang',namabarang='$namabarang',
                                        diameter='$dia'
                                        WHERE idbarang='$idbarang'");
    if ($editmaster) {
        $_SESSION['status'] = "Data Master Barang Berhasil Di Ubah";
        header('location:master.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Master Barang gagal Di Ubah";
        header('location:master.php');
        unset($_POST);
        exit();
    }
}

//hapus master barang 
if (isset($_POST['hapusmasterbarang'])) {
    $idbarang = $_POST['idbarang'];


    $hpsmaster = mysqli_query($conn, "DELETE FROM transaksi WHERE idbarang = '$idbarang'");
    if ($hpsmaster) {
        $_SESSION['status'] = "Data Barang Masuk Berhasil Di Hapus";
        header('location:master.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Barang Masuk gagal Di Hapus";
        header('location:master.php');
        unset($_POST);
        exit();
    }
}

#####################################################################################################
                                    // BARANG MASUK
// menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['idbarang'];
    $namabarang = $_POST['namabrg'];
    $dia = $_POST['dia'];
    $tglmasuk = $_POST['tglmasuk'];
    $qty        = $_POST['qtymasuk'];
    $jenis        = $_POST['jenis'];
    $penerima        = $_POST['penerima'];
    $keterangan        = $_POST['keterangan'];


    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM transaksi where idbarang='$barangnya'");
    $addtomasuk = mysqli_query($conn, "INSERT INTO transaksi(idbarang,namabarang,diameter,tglmasuk,qtymasuk,jenis,penerima,keterangan) 
                    VALUES ('$barangnya','$namabarang','$dia','$tglmasuk','$qty','$jenis','$penerima','$keterangan')");
    if ($addtomasuk) {
        $_SESSION['status'] = "Data Barang Masuk berhasil Di Input";
        header('location:masuk.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Barang Masuk gagal Di Input";
        header('location:masuk.php');
        unset($_POST);
        exit();
    }
}

//ubah barang masuk
if (isset($_POST['ubahbarangmasuk'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $tglmasuk = $_POST['tglmasuk'];
    $qty = $_POST['qtymasuk'];
    $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];

    $editmsk = mysqli_query($conn, "UPDATE transaksi SET tglmasuk='$tglmasuk',qtymasuk='$qty',
                                        penerima='$penerima',keterangan='$keterangan'
                                        WHERE id_transaksi='$id_transaksi'");
    if ($editmsk) {
        $_SESSION['status'] = "Data Barang Masuk Berhasil Di Ubah";
        header('location:masuk.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Barang Masuk gagal Di Ubah";
        header('location:masuk.php');
        unset($_POST);
        exit();
    }
}

//hapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $id_transaksi = $_POST['id_transaksi'];


    $hpskeluar = mysqli_query($conn, "UPDATE transaksi SET tglmasuk='',qtymasuk='0',jenis='',
                                        penerima='',keterangan=''
                                        WHERE id_transaksi='$id_transaksi'");
    if ($hpskeluar) {
        $_SESSION['status'] = "Data Barang Masuk Berhasil Di Hapus";
        header('location:masuk.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Barang Masuk gagal Di Hapus";
        header('location:masuk.php');
        unset($_POST);
        exit();
    }
}

####################################################################################################
                                    // BARANG KELUAR


// menambah barang keluar
if (isset($_POST['barangkeluar'])) {
    $barangnya = $_POST['idbarang'];
    $namabarang = $_POST['namabrg'];
    $dia = $_POST['dia'];
    $tglkeluar = $_POST['tglkeluar'];
    $qty        = $_POST['qtykeluar'];
    $jenis        = $_POST['jenis'];
    $penerima        = $_POST['penerima'];
    $keterangan        = $_POST['keterangan'];


    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM transaksi where idbarang='$barangnya'");
    $addtomasuk = mysqli_query($conn, "INSERT INTO transaksi(idbarang,namabarang,diameter,tglkeluar,qtykeluar,jenis,penerima,keterangan) 
                    VALUES ('$barangnya','$namabarang','$dia','$tglkeluar','$qty','$jenis','$penerima','$keterangan')");
    if ($addtokeluar) {
        $_SESSION['status'] = "Data Barang Keluar Berhasil Di Input";
        header('location:keluar.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Barang Keluar Gagal Di Input";
        header('location:keluar.php');
        unset($_POST);
        exit();
    }
}

//ubah barang keluar
if (isset($_POST['ubahbarangkeluar'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $tglkeluar = $_POST['tglkeluar'];
    $qty = $_POST['qtykeluar'];
    $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];

    $editkeluar = mysqli_query($conn, "UPDATE transaksi SET tglkeluar='$tglkeluar',qtykeluar='$qty',
                                        penerima='$penerima',keterangan='$keterangan'
                                        WHERE id_transaksi='$id_transaksi'");
    if ($editkeluar) {
        $_SESSION['status'] = "Data Barang Keluar Berhasil Di Ubah";
        header('location:keluar.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Barang Keluar Gagal Di Ubah";
        header('location:keluar.php');
        unset($_POST);
        exit();
    }
}

//hapus barang masuk
if (isset($_POST['hapusbarangkeluar'])) {
    $id_transaksi = $_POST['id_transaksi'];


    $hpskeluar = mysqli_query($conn, "UPDATE transaksi SET tglkeluar='',qtykeluar='0',jenis='',
                                        penerima='',keterangan=''
                                        WHERE id_transaksi='$id_transaksi'");
    if ($hpskeluar) {
        $_SESSION['status'] = "Data Barang Keluar Berhasil Di Hapus";
        header('location:keluar.php');
        unset($_POST);
        exit();
    } else {
        $_SESSION['gagal'] = "Data Barang Keluar gagal Di Hapus";
        header('location:keluar.php');
        unset($_POST);
        exit();
    }
}

####################################################################################################
