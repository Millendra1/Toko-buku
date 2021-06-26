<?php
include "config/connection.php";
include "library/controller.php";



@$id= $_POST['id_buku'];
@$judul = $_POST['judul'];
@$no = $_POST['no'];
@$penulis = $_POST['penulis'];
@$penerbit = $_POST['penerbit'];
@$tahun = $_POST['tahun'];
@$stok = $_POST['stok'];
@$h_pokok = $_POST['h_pokok'];
@$h_jual = $_POST['h_jual'];
@$ppn = $_POST['ppn'];
@$diskon = $_POST['diskon'];
@$req = '?menu=buku';
@$field=array('id_buku' => $id, 'judul' => $judul,'isbn' => $no,'penulis' => $penulis, 'penerbit' => $penerbit, 'tahun' => $tahun, 'stok' => $stok, 'harga_pokok' => $h_pokok, 'harga_jual' => $h_jual, 'ppn' => $ppn, 'diskon' => $diskon );
@$where = "id_buku = '$_GET[id]'";

@$cek = $j > 0;
$go = new controller();

$tabel = "buku";
$tanggal = date('Y-m-d');


if(isset($_POST['simpan'])){
  $go->simpan($con, $tabel, $field, $req);
}

if(isset($_GET['hapus'])){
  $go->hapus($con,$tabel,$where,$req);
}

if(isset($_GET['edit'])){

 $edit = $go->edit($con,$tabel,$where);
}
if(isset($_POST['update'])){
  $go->ubah($con,$tabel,$field,$where,$req);
}
$query="SELECT * FROM buku ORDER BY id_buku DESC LIMIT 1";
$data = mysqli_fetch_assoc(mysqli_query($con,$query));
if($data['id_buku']==" "){
  $id_buku = "BUKU00000000001";
}
else{
  @$id_buku = substr($data['id_buku'],4);
  @$id_buku = intval($id_buku);
  if($id_buku <9){
    $id_buku = "BUKU0000000000".( $id_buku+1);
  }
  elseif($id_buku <99){
    $id_buku = "BUKU000000000".( $id_buku+1);
  }
  elseif($id_buku <999){
    $id_buku = "BUKU00000000".( $id_buku+1);
  }
  elseif($id_buku <9999){
    $id_buku = "BUKU0000000".( $id_buku+1);
  }
  elseif($id_buku <99999){
    $id_buku = "BUKU000000".( $id_buku+1);
  }
  elseif($id_buku <999999){
    $id_buku = "BUKU00000".( $id_buku+1);
  }
  elseif($id_buku <9999999){
    $id_buku = "BUKU0000".( $id_buku+1);
  }
  elseif($id_buku <99999999){
    $id_buku = "BUKU000".( $id_buku+1);
  }
  elseif($id_buku <999999999){
    $id_buku = "BUKU000".( $id_buku+1);
  }
  elseif($id_buku <9999999999){
    $id_buku = "BUKU00".( $id_buku+1);
  }
  elseif($id_buku <99999999999){
    $id_buku = "BUKU0".( $id_buku+1);
  }
}
?>

 <div class="container">
	 	<form method="post" enctype="multipart/form-data" class="form-horizontal">
		 	<div class="row">
		 		<div class="panel-body">
         <div class="form-group">
		 				<label class="col-sm-2 control-label">Id Buku</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="id_buku" class="form-control" value="<?php if(@$edit['id_buku']==null){echo $id_buku;}else{ echo @$edit['id_buku'];}?>"readonly>
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Judul</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="judul" class="form-control" value="<?php echo @$edit['judul'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Nomor ISBN</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="no" class="form-control" value="<?php echo @$edit['isbn'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Penulis</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="penulis" class="form-control" value="<?php echo @$edit['penulis'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Penerbit</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="penerbit" class="form-control" value="<?php echo @$edit['penerbit'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Tahun</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="tahun" class="form-control" value="<?php echo @$edit['tahun'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Harga Pokok</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="h_pokok" class="form-control" value="<?php echo @$edit['harga_pokok'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Harga Jual</label>
		 				<div class="col-sm-10">
		 					<input type="text" name="h_jual" class="form-control" value="<?php echo @$edit['harga_jual'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">PPN</label>
		 				<div class="col-sm-10">
		 					<input readonly="" type="number" value="10" name="ppn" class="form-control" value="<?php echo @$edit['ppn'] ?>">
		 				</div>
		 			</div>
		 			<div class="form-group">
		 				<label class="col-sm-2 control-label">Diskon</label>
		 				<div class="col-sm-10">
		 					<input type="number" name="diskon" class="form-control" value="<?php echo @$edit['diskon'] ?>">
		 				</div>
		 			</div>
		 		
		 			<div class="col-md-offset-2">
		 				<?php 
		 					if (@$_GET['id']=="") {
		 				 ?>
		 				<button name="simpan" class="btn btn-primary mt-3">Simpan</button>
		 				<?php }else{ ?>
		 				<button name="update" class="btn btn-primary mt-3">Update</button>
		 				<?php } ?>
		 			</div>
		 		</div>
		 	</div>
	 	</form>
 </div>


<div class="container  text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0" data-aos="fade-up" data-aos-delay="600" data-aos-anchor=".top">
  <table  id="data" class="data table-sm table table-striped table-bordered border-light table-hover py-3 display ">
    <thead>
        <tr class="table-primary">
            <th>Id Buku</th>
            <th>Judul</th>
            <th>ISBN</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>stok</th>
            <th>Harga Pokok</th>
            <th>Harga Jual</th>
            <th>PPN</th>
            <th>Diskon</th>
            <th>hapus</th>
            <th>edit</th>
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
              <td><?=  $r['id_buku'] ?></td>
              <td><?=  $r['judul'] ?></td>
              <td><?=  $r['isbn'] ?></td>
              <td><?=  $r['penulis'] ?></td>
              <td><?=  $r['penerbit'] ?></td>
              <td><?=  $r['tahun'] ?></td>
              <td><?=  $r['stok'] ?></td>
              <td><?=  $r['harga_pokok'] ?></td>
              <td><?=  $r['harga_jual'] ?></td>
              <td><?=  $r['ppn'] ?></td>
              <td><?=  $r['diskon'] ?></td>
              <td><a class="btn btn-primary text-light hover" href="?menu=buku&hapus&id=<?php echo $r['id_buku'] ?>" onclick="return confirm('yakin mau hapus?')">Hapus</a></td>
              <td><a class="btn btn-primary text-light hover" href="?menu=buku&edit&id=<?php echo $r['id_buku'] ?>">Edit</a></td>
          </tr>
          <?php }  ?>
    </tbody>
    <tfoot class="table-Primary">
    <tr>
            <th>Id Buku</th>
            <th>Judul</th>
            <th>ISBN</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>stok</th>
            <th>Harga Pokok</th>
            <th>Harga Jual</th>
            <th>PPN</th>
            <th>Diskon</th>
            <th>hapus</th>
            <th>edit</th>
      </tr>
    </tfoot>

  </table>
</div>