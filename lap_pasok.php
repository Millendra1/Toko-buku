<?php 
include "config/connection.php";
include "library/controller.php";
$req = "?menu=lap_pasok";
$tabel="buku";
$tabeldis = "distributor";
@$id_buku = $_GET['id'];
@$id_pasok = $_POST['id_pasok'];
@$id_dis = $_POST['id_dis'];
@$jumlah = $_POST['jumlah'];
@$fieldsementara = array('id_buku'=>$_GET['id'],'judul'=>$_POST['judul'],'jumlah'=>$_POST['jumlah'],'total'=>$_POST['total']);
@$where="id_buku = '$_GET[id]'";
@$wheredis="id_dis = '$_GET[id_dis]'";
$date= date('Y-m-d');

$go = new controller();


if(isset($_GET['hapus'])){
  $id_pasok = $_GET['id'];
  $delete=mysqli_query($con,"DELETE FROM pasok WHERE id_pasok ='$id_pasok' ");
  if($delete){
    echo "<script>alert('Berhasil dihapus');document.location.href='$req'</script>";
  }else{
      echo "<script>alert('Gagal dihapus');document.location.href='$req'</script>";
  }
}

?>


<div class="container w-75 mt-3 pt-3 ">
    <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow  border-start-0 border-end-0">
        <table  id="data" class="data table table-striped table-bordered table-hover py-3 display">
              <thead class="table-primary">
                <tr>
                  <th>ID PASOK</th>
                  <th>ID BUKU</th>
                  <th>ID DISTRIBUTOR</th>
                  <th>JUMLAH PASOK</th>
                  <th>tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody class="table-light">
              <?php
                    @$sql = mysqli_query($con,"SELECT * FROM pasok");
                    while($data = mysqli_fetch_assoc($sql)){
                  ?>
                  <tr>
                    <td><?php echo $data['id_pasok'] ?></td>
                    <td><?php echo $data['id_buku'] ?></td>
                    <td><?php echo $data['id_dis'] ?></td>
                    <td><?php echo $data['jumlah'] ?></td>
                    <td><?php echo $data['tanggal'] ?></td>
                    <td><a href="?menu=lap_pasok&hapus&id=<?php echo $data['id_pasok']; ?>" onClick="return confirm('Apakah anda yakin ingin menghapus ?')">Hapus</a></td>
                  </tr>
                  <?php } ?> 
              </tbody>

              <tfoot class="table-primary">
                  <tr>
                    <th>ID PASOK</th>
                    <th>ID BUKU</th>
                    <th>ID DISTRIBUTOR</th>
                    <th>JUMLAH PASOK</th>
                    <th>tanggal</th>
                    <th>Aksi</th>
                  </tr>
              </tfoot>
          </table>
      </div>

      
      <script>
            var myModal = document.getElementById('myModal')
            var myInput = document.getElementById('myInput')
            myModal.addEventListener('shown.bs.modal', function () {
              myInput.focus()
            })    
        </script>
  </div>