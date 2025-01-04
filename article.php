<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Article
    </button>
    <div class="row">
        <div class="table-responsive" id="article_data">

        </div>

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Article</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="Judul" placeholder="Tuliskan Judul Artikel" required>
                            </div>
                            <div class="mb-3">
                                <label for="floatingTextarea2">Isi</label>
                                <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="Isi" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="Gambar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah-->
    </div>
</div>

<script>
$(document).ready(function() {
    console.log(load_data);
    load_data();

    function load_data(hlm) {
        $.ajax({
            url: "article_data.php",
            method: "POST",
            data: { hlm: hlm },
            beforeSend: function(jqXHR) {
                // Log the request headers
                console.log("Request Headers:", jqXHR.getAllResponseHeaders());
            },
            success: function(data) {
                $('#article_data').html(data);
            }
        });
    } 
    
    $(document).on('click', '.halaman', function(){
    var hlm = $(this).attr("id");
    load_data(hlm);
});
});

</script>

<?php
include "uploadfoto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $Judul = $_POST['Judul'];
    $Isi = $_POST['Isi'];
    $Tanggal = date("Y-m-d H:i:s");
    $Username = $_SESSION['Username'];
    $Gambar = '';
    $nama_Gambar = $_FILES['Gambar']['name'];

    //jika ada file yang dikirim  
    if ($nama_Gambar != '') {
        //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
        //function ini memiliki 2 keluaran yaitu status dan message
        $cek_upload = uploadfoto($_FILES["Gambar"]);

        //cek status true/false
        if ($cek_upload['status']) {
            //jika true maka message berisi nama file gambar
            $Gambar = $cek_upload['message'];
        } else {
            //jika true maka message berisi pesan error, tampilkan dalam alert
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=article';
            </script>";
            die;
        }
    }

    //cek apakah ada id yang dikirimkan dari form
    if (isset($_POST['Id'])) {
        //jika ada id,    lakukan update data dengan id tersebut
        $Id = $_POST['Id'];

        if ($nama_Gambar == '') {
            //jika tidak ganti gambar
            $Gambar = $_POST['Gambar_lama'];
        } else {
            //jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['Gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE article 
                                SET 
                                Judul =?,
                                Isi =?,
                                Gambar = ?,
                                Tanggal = ?,
                                Username = ?
                                WHERE Id = ?");

        $stmt->bind_param("sssssi", $Judul, $Isi, $Gambar, $Tanggal, $Username, $Id);
        $simpan = $stmt->execute();
    } else {
        //jika tidak ada id, lakukan insert data baru
        $stmt = $conn->prepare("INSERT INTO article (Judul,Isi,Gambar,Tanggal,Username)
                                VALUES (?,?,?,?,?)");

        $stmt->bind_param("sssss", $Judul, $Isi, $Gambar, $Tanggal, $Username);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $Id = $_POST['Id'];
    $Gambar = $_POST['Gambar'];

    if ($Gambar != '') {
        //hapus file gambar
        unlink("img/" . $Gambar);
    }

    $stmt = $conn->prepare("DELETE FROM article WHERE Id =?");

    $stmt->bind_param("i", $Id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>