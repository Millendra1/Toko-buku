<?php
include "config/connection.php";
include "library/controller.php";

$go = new controller();

$tabel = "set_laporan";
$tanggal = date('Y-m-d');
// @$field = array('name'=>$_POST['nama'], 'alamat'=>$_POST['alamat'], 'telpon'=>$_POST['telp'], 'logo'=>$_POST['foto']);
$redirect = "";
$where = "id_set = '1'";
@$foto= $_POST['foto'];

if(isset($_POST['ubah'])){
  $foto = $_FILES['foto'];
  @$name =$_POST['nama'];
  @$no_telepon = $_POST['telpon'];
  @$web = $_POST['web'];
  @$no_telpon = $_POST['telpon'];
  @$email = $_POST['email'];
  @$tmp_file = $foto['tmp_name'];
  @$logo=$foto['name'];
  $tempat= "logo";
  move_uploaded_file($tmp_file, "$tempat/$logo");

   
     if (empty($_FILES['foto']['name'])){
      @$set = mysqli_query($con,"UPDATE set_laporan SET nama_perusahaan='$name', no_telpon ='$no_telepon', web ='$web', no_hp='$no_telpon', email='$email' WHERE id_set=1 ");
    }
    else{
      @$set = mysqli_query($con,"UPDATE set_laporan SET nama_perusahaan='$name', no_telpon ='$no_telepon', web ='$web', no_hp='$no_telpon',logo = '$logo' , email='$email' WHERE id_set=1 ");
     }
     if($set){
      echo "<script>alert('Berhasil diubah');</script>";
     }else{
      echo "<script>alert('Gagal diubah');</script>";
     }

}


@$sql="SELECT * FROM set_laporan";
$edit=mysqli_fetch_assoc(mysqli_query($con,$sql));

?>

<form method="post" enctype="multipart/form-data">
    <div class="container w-75  mt-3 pt-3" id="top">
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">Nama Toko :</label>
          <input type="text" class="form-control" name="nama" value="<?php echo @$edit['nama_perusahaan'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">WEB :</label>
          <input type="text" class="form-control" name="web" value="<?php echo @$edit['web'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">email :</label>
          <input type="text" class="form-control" name="email" value="<?php echo @$edit['email'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">No telp :</label>
          <input type="number" class="form-control" name="telpon" value="<?php echo @$edit['no_telpon'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="300">
          <label class="form-label h6">Foto :</label>
          <input class="form-control" id="formFile" type="file" name="foto" >
          <img style="width:20%;" src="logo/<?php echo @$edit['logo'] ?>" alt="">
        </div>
        <div data-aos="fade-up" data-aos-delay="500">
            <input class="btn btn-primary text-light" type="submit" name="ubah" value="ubah">
        </div>
  </div>
</form>


