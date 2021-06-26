<?php 
include "config/connection.php";
include "library/controller.php";
$req = "?menu=penjualan";
$tabel="buku";
$tabelsementara = "tmp_penjualan";
$tabelpenjualan = "penjualan";
@$id_fak = $_POST['id_fak'];
@$id_buku = $_GET['id'];
@$judul = $_POST['judul'];
@$harga = $_POST['harga_jual'];
@$jumlah = $_POST['jumlah'];
@$stok = $_POST['stok'];
@$total = $_POST['total'];
@$fieldsementara = array('id_buku'=>$_GET['id'],'judul'=>$_POST['judul'],'jumlah'=>$_POST['jumlah'],'total'=>$_POST['total']);
@$where="id_buku = '$_GET[id]'";
$date= date('Y-m-d');

$go = new controller();

$query="SELECT * FROM penjualan ORDER BY id_penjualan desc LIMIT 1";
$data = mysqli_fetch_assoc(mysqli_query($con,$query));
if(@$data['id_penjualan']==" "){
  $id_penjualan = "FAK0000000001";
}
else{
  @$id_penjualan = substr($data['id_penjualan'],3);
  @$id_penjualan = intval($id_penjualan);
  if($id_penjualan <9){
    $id_penjualan = "FAK000000000".( $id_penjualan+1);
  }
  elseif($id_penjualan <99){
    $id_penjualan = "FAK00000000".( $id_penjualan+1);
  }
  elseif($id_penjualan <999){
    $id_penjualan = "FAK0000000".( $id_penjualan+1);
  }
  elseif($id_penjualan <9999){
    $id_penjualan = "FAK000000".( $id_penjualan+1);
  }
  elseif($id_penjualan <99999){
    $id_penjualan = "FAK00000".( $id_penjualan+1);
  }
  elseif($id_penjualan <999999){
    $id_penjualan = "FAK0000".( $id_penjualan+1);
  }
  elseif($id_penjualan <9999999){
    $id_penjualan = "FAK000".( $id_penjualan+1);
  }
  elseif($id_penjualan <99999999){
    $id_penjualan = "FAK00".( $id_penjualan+1);
  }
  elseif($id_penjualan <999999999){
    $id_penjualan = "FAK0".( $id_penjualan+1);
  }
  elseif($id_penjualan <9999999999){
    $id_penjualan = "FAK".( $id_penjualan+1);
  }
}
if(isset($_GET['pilih'])){
  $tampil = $go->edit($con,$tabel,$where);
 }

if(isset($_POST['simpanbuku'])){
  $sql="INSERT INTO tmp_penjualan VALUES ('$id_buku','$judul','$jumlah','$total')";
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
  $delete=mysqli_query($con,"DELETE FROM tmp_penjualan WHERE id_buku ='$id_buku' ");
  if($delete){
    echo "<script>alert('Berhasil dihapus');document.location.href='$req'</script>";
  }else{
      echo "<script>alert('Gagal dihapus');document.location.href='$req'</script>";
  }
}
if(isset($_POST['simpantransaksi'])){
  @$sql = mysqli_query($con,"SELECT * FROM tmp_penjualan");
  while($data = mysqli_fetch_assoc($sql)){
    $total_beli=$data['jumlah_beli'];
    $id_buku = $data['id_buku'];
    $id_user = $_SESSION['id'];
    $total_harga=$_POST['total_harga'];
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembali'];
    @$jalan = mysqli_query($con,"SELECT * FROM buku WHERE id_buku = '$id_buku'");
    $sisastok = mysqli_fetch_assoc($jalan);
    $sisa = $sisastok['stok'];
    $sisa = intval($sisa)-intval($total_beli);
    @$stok = mysqli_query($con,"UPDATE buku SET stok ='$sisa' WHERE id_buku = '$id_buku'");
    @$query=mysqli_query($con,"INSERT INTO penjualan VALUES('$id_fak','$id_buku','$id_user','$total_beli',' $bayar','$kembalian','$total_harga','$date')");
  }
  $delete = mysqli_query($con,"DELETE FROM tmp_penjualan");
  if($query){
    echo "<script>alert('Berhasil tersimpan');</script>";
  }else{
    echo "<script>alert('Gagal disimpan');</script>";
  }
}

?>
<script type="text/javascript">
 	function hitung(){
 		  a = document.getElementById('totharga').value * 1;
 			b = document.getElementById('bayar').value * 1;
 				document.getElementById('pulangan').value = b - a;
 	}

 	function kembalian(){
 		var a = document.getElementById('jumlahh').value * 1;
 			b = document.getElementById('hargaa').value * 1;
 				document.getElementById('totall').value = a * b;	
 	}
 </script>



  <div class="container w-75 mt-3 pt-3 ">
    <form method="post" class="">
        <div>
            <div class="form-group">
            <label class="form-label">No Faktur/ID penjualan</label>
              <div class="">
                <input type="text" id="" class="form-control" name="id_fak" value="<?php echo $id_penjualan; ?>"readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Judul</label>
              <div class="row">
                <div class="col-auto">
                  <input readonly type="text" name="judul" class="form-control" value="<?php echo @$tampil['judul'] ?>"></div>
                  <div class="col-auto"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">CARI BUKU</button></div>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Harga Buku <div class="text-sm">(Setelah Diskon Dan pajak)</div> </label>
              <div class="">
                <input type="number" name="harga" id="hargaa" class="form-control"  value="<?php 
                $total=($tampil['harga_jual']-($tampil['harga_jual']*$tampil['diskon']/100))+($tampil['harga_jual']*$tampil['ppn']/100);  echo $total; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">stok</label>
              <div class="">
                <input type="number" min="0" id="stok" class="form-control" readonly name="stok" value="<?php echo $tampil['stok']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Jumlah</label>
              <div class="">
                <input type="number" min="0" id="jumlahh" onkeyup="kembalian()" name="jumlah" class="form-control" value="<?php ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Total</label>
              <div class="">
                <input readonly type="number" id="totall" name="total" class="form-control" value="<?php ?>">
              </div>
            </div>
            <?php 
            @$sql = mysqli_query($con,"SELECT * FROM tmp_penjualan WHERE judul = '$tampil[judul]'");
            @$cek = mysqli_num_rows($sql);
            if($cek==1){?>
              <a class="mt-3 btn btn-dark p-2" name="updatebuku" href="?menu=penjualan&update&id=<?= $tampil['id_buku'];?>">Update</a>
            <?php }else { ?>        
              <button class="mt-3 btn btn-dark p-2" name="simpanbuku">Tambah</button>
            <?php } ?>
          </div>
        </div>
        <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0">
          <table class="data table table-primary table-striped table-bordered border-light table-hover py-3 display" id="data">
              <thead>
                <tr>
                  <th>Judul Buku</th>
                  <th>Jumlah Beli</th>
                  <th>Total Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    @$sql = mysqli_query($con,"SELECT * FROM tmp_penjualan");
                    while($data = mysqli_fetch_assoc($sql)){
                  ?>
                  <tr>
                  <td><?php echo $data['judul'] ?></td>
                  <td><?php echo $data['jumlah_beli'] ?></td>
                  <td><?php echo $data['total_harga'] ?></td>
                  <td><a href="?menu=penjualan&hapus&id=<?php echo $data['id_buku']; ?>" onClick="return confirm('Apakah anda yakin ingin menghapus ?')">Hapus</a></td>
                  <tr>
                  <?php } ?> 
                </tbody> 
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Total Harga</td>
                    <?php 
                      $sql = mysqli_fetch_array(mysqli_query($con,"SELECT total_harga,sum(total_harga) AS total_harga FROM tmp_penjualan"));
                    ?>
                    <td><?php echo $sql['total_harga']; ?></td>
                  </tr>
                </tfoot>
          </table>
        </div>
        <div class="container w-75 mt-3 pt-3">
              <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
                  <label class="form-label h6">total Harga :</label>
                  <input type="number" min="0" id="totharga" name="total_harga" class="form-control" value="<?php echo @$sql['total_harga'] ?>" readonly>
                  <label class="form-label h6">Bayar :</label>
                  <input type="number" min="0" id="bayar" onkeyup="hitung()" name="bayar" class="form-control" value="<?php ?>">
                </div>
                <div class="mb-2" data-aos="fade-up" data-aos-delay="200">
                  <label class="form-label h6">Kembali :</label>
                  <input readonly type="number" id="pulangan" name="kembali" class="form-control" value="<?php ?>">
                </div>
                <input class="btn btn-primary text-light" type="submit" name="simpantransaksi" value = "simpan">
          </div>
    </form>

      
      



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
                            $sql = "SELECT * from buku WHERE stok != 0";
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
                              <td><a href="?menu=penjualan&pilih&id=<?= $r['id_buku']?>"><?=  $r['id_buku'] ?></a></td>
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