<?php 
include "config/connection.php";
include "library/controller.php";
$req = "?menu=pasok";
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

$query="SELECT * FROM pasok ORDER BY id_pasok DESC LIMIT 1";
$data = mysqli_fetch_assoc(mysqli_query($con,$query));
if(@$data['id_pasok']==" "){
  $id_pas = "PSK0000000001";
}
else{
  @$id_pas = substr($data['id_pasok'],3);
  @$id_pas = intval($id_pas);
  if($id_pas <9){
    $id_pas = "PSK000000000".( $id_pas+1);
  }
  elseif($id_pas <99){
    $id_pas = "PSK00000000".( $id_pas+1);
  }
  elseif($id_pas <999){
    $id_pas = "PSK0000000".( $id_pas+1);
  }
  elseif($id_pas <9999){
    $id_pas = "PSK000000".( $id_pas+1);
  }
  elseif($id_pas <99999){
    $id_pas = "PSK00000".( $id_pas+1);
  }
  elseif($id_pas <999999){
    $id_pas = "PSK0000".( $id_pas+1);
  }
  elseif($id_pas <9999999){
    $id_pas = "PSK000".( $id_pas+1);
  }
  elseif($id_pas <99999999){
    $id_pas = "PSK00".( $id_pas+1);
  }
  elseif($id_pas <999999999){
    $id_pas = "PSK0".( $id_pas+1);
  }
  elseif($id_pas <9999999999){
    $id_pas = "PSK".( $id_pas+1);
  }
}
if(isset($_GET['pilih'])){
  $tampil = $go->edit($con,$tabel,$where);
  $tampildis = $go->edit($con,$tabeldis,$wheredis);
 }

if(isset($_POST['simpan'])){
  $sql="INSERT INTO pasok VALUES ('$id_pasok','$id_dis','$id_buku','$jumlah','$date')";
  @$jalan = mysqli_query($con,"SELECT * FROM buku WHERE id_buku = '$id_buku'");
  $sisastok = mysqli_fetch_assoc($jalan);
  $sisa = $sisastok['stok'];
  $sisa = intval($sisa)+intval($jumlah);
  @$stok = mysqli_query($con,"UPDATE buku SET stok ='$sisa' WHERE id_buku = '$id_buku'");
  $go = mysqli_query($con,$sql);
  if(isset($go)){
    echo "<script>alert('Berhasil tersimpan');document.location.href='$req'</script>";
  }else{
    echo "<script>alert('Gagal disimpan');document.location.href='$req'</script>";
  }
 }
if(isset($_GET['update'])){
  $q="UPDATE tmp_penjualan SET jumlah_beli = '$jumlah', harga_total = '$total' WHERE id_buku = '$id_buku' )";
  $jalan=mysqli_query($con,$q); 
  if(isset($jalan)){
    echo "<script>alert('Berhasil tersimpan');document.location.href='$req'</script>";
  }else{
    echo "<script>alert('Gagal disimpan');document.location.href='$req'</script>";
  }
}
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
    <form method="post" class="">
        <div>
            <div class="form-group">
              <label class="form-label">ID PASOK</label>
                <div class="">
                  <input type="text" id="" class="form-control" name="id_pasok" value="<?php echo $id_pas ?>"readonly>
                </div>
            </div>
            <div class="form-group">
              <label class="form-label">Judul | ID BUKU</label>
              <div class="row">
                <div class="col-auto">
                  <input readonly type="text" name="id_buku" class="form-control" value="<?php echo @$tampil['id_buku'] ?>"></div>
                  <div class="col-auto"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">CARI BUKU</button></div>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Distributor</label>
              <div class="row">
                <div class="col-auto">
                  <input readonly type="text" name="id_dis" class="form-control" value="<?php echo @$tampildis['id_dis'] ?>"></div>
                  <div class="col-auto"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disModal">CARI Distributor</button></div>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Jumlah</label>
              <div class="">
                <input type="number" min="0" name="jumlah" class="form-control" value="<?php ?>">
              </div>
            </div>
              <Input type="submit" class="mt-3 btn btn-primary p-2" name="simpan" href="?menu=penjualan&update&id=<?= $tampil['id_buku']?>" value="simpan">

          </div>
        </div>
        <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0">
          <table class="data table table-secondary table-striped table-bordered border-light table-hover py-3 display" id="data">
              <thead>
                <tr>
                  <th>ID PASOK</th>
                  <th>ID BUKU</th>
                  <th>ID DISTRIBUTOR</th>
                  <th>JUMLAH PASOK</th>
                  <th>tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
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
                  <td><a href="?menu=pasok&hapus&id=<?php echo $data['id_pasok']; ?>" onClick="return confirm('Apakah anda yakin ingin menghapus ?')">Hapus</a></td>
                  </tr>
                  <?php } ?> 
                </tbody> 
                <tfoot>
            
                </tfoot>
          </table>
        </div>
    </form>

      
      



      <div class="modal" id="disModal" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0">
                  <table  id="tabelbukum" class="data table table-striped table-bordered border-light table-hover py-3 display">
                    <thead>
                        <tr class="table-primary">
                            <th>Id Distributor</th>
                            <th>Nama Distributr</th>
                            <th>Alamat</th>
                            <th>No telpon</th>
                          </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php 
                            
                            $no = 0;
                            $sql = "SELECT * from distributor";
                            $jalan = mysqli_query($con, $sql);
                            
                              
                              // if ($jalan == "") {
                              //     echo "<tr><td colspan='4'>No Record</td></tr>";
                              
                              // } else{

                              // foreach($jalan as $r){
                              //     $no++
                              // $query=mysqli_fetch_assoc($jalan);
                              while ($r = mysqli_fetch_assoc($jalan)){
                              $no++;
                          ?>
                          <tr>
                              <td><a href="?menu=pasok&pilih&id=<?= $id_buku?>&id_dis=<?= $r['id_dis']?>"><?=  $r['id_dis'] ?></a></td>
                              <td><?=  $r['nama_dis'] ?></td>
                              <td><?=  $r['alamat'] ?></td>
                              <td><?=  $r['telpon_dis'] ?></td>
                          </tr>
                          <?php }  ?>
                    </tbody>
                    <tfoot class="table-primary">
                    <tr class="table-primary">
                            <th>Id Distributor</th>
                            <th>Nama Distributr</th>
                            <th>Alamat</th>
                            <th>No telpon</th>
                          </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal" id="exampleModal" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0">
                  <table  id="tabelbukum" class="data table table-striped table-bordered border-light table-hover py-3 display">
                    <thead>
                        <tr class="table-primary">
                            <th>Id Buku</th>
                            <th>Judul</th>
                            <th>stok</th>
                            <th>Harga Jual</th>
                            <th>DISKON</th>
                          </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php 
                            
                            $no = 0;
                            $sql = "SELECT * from buku";
                            $jalan = mysqli_query($con, $sql);
                            
                              
                              // if ($jalan == "") {
                              //     echo "<tr><td colspan='4'>No Record</td></tr>";
                              
                              // } else{

                              // foreach($jalan as $r){
                              //     $no++
                              // $query=mysqli_fetch_assoc($jalan);
                              while ($r = mysqli_fetch_assoc($jalan)){
                              $no++;
                          ?>
                          <tr>
                              <td><a href="?menu=pasok&pilih&id=<?= $r['id_buku']?>"><?=  $r['id_buku'] ?></a></td>
                              <td><?=  $r['judul'] ?></td>
                              <td><?=  $r['stok'] ?></td>
                              <td><?=  $r['harga_jual'] ?></td>
                              <td><?=  $r['diskon'] ?></td>
                          </tr>
                          <?php }  ?>
                    </tbody>
                    <tfoot class="table-primary">
                    <tr>
                            <th>Id Buku</th>
                            <th>Judul</th>
                            <th>stok</th>
                            <th>Harga Jual</th>
                            <th>DISKON</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <script>
            var myModal = document.getElementById('myModal')
            var myInput = document.getElementById('myInput')
            myModal.addEventListener('shown.bs.modal', function () {
              myInput.focus()
            })    
        </script>
  </div>