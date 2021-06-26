<?php 
include "config/connection.php";
include "library/controller.php";

$go = new controller();

$tabel = "user";
$redirect = "?menu=ganti_pass";
@$id = $_SESSION['id'];
@$pass = $_POST['pass'];
$data = $go->tampil($con, $tabel);
$sql = "SELECT * FROM $tabel WHERE id = '$id' ";
$tampil = mysqli_fetch_assoc(mysqli_query($con,$sql));


if(isset($_POST['ubah'])){
  $sql = "UPDATE user SET password = '$_POST[pass]'  WHERE id = '$id'";
  $query = mysqli_query($con,$sql);
  if(isset($query)){
    echo "<script>alert('Berhasil diubah');document.location.href='$redirect'</script>";
  }else{
    echo "<script>alert('Gagal diubah');document.location.href='$redirect'</script>";
}
  }

?>

<form method="post">
    <div class="container w-75 mt-3 pt-3">
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">Username :</label>
          <input type="text" class="form-control" name="user" value="<?= @$tampil['username'] ?>" required readonly>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="200">
        <label class="form-label h6">Password lama :</label>
        <input type="text"  class="form-control" name="passlama" value="<?= @$tampil['password'] ?>" readonly>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="200">
        <label class="form-label h6">Password Baru :</label>
        <input type="text"  class="form-control" name="pass" required>
        </div>
        <div data-aos="fade-up" data-aos-delay="300">
          <input class="btn btn-dark text-light" type="submit" name="ubah" value="ubah">
        </div>
    </div>
</form>


