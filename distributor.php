<?php 

include 'config/connection.php';
include 'library/controller.php';

$tabel = 'distributor';
@$field = array('id_dis'=>$_POST['id_dis'],'nama_dis'=>$_POST['nama_dis'],'alamat'=>$_POST['alamat_dis'],'telpon_dis'=>$_POST['telpon']);
$redirect = '?menu=distributor';
@$where = "id_dis = '$_GET[id]' ";

$go = new Controller();

if (isset($_POST['simpan'])) {
    $go->simpan($con, $tabel, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    @$edit = $go->edit($con, $tabel, $where);
}

if(isset($_POST['ubah'])){
    $go->ubah($con, $tabel, $field, $where, $redirect);
}


$query="SELECT * FROM distributor ORDER BY id_dis DESC LIMIT 1";
$data = mysqli_fetch_assoc(mysqli_query($con,$query));
if(!isset($data['id_dis'])){
  $id_dis = "DSTU00000000001";
}
else{
  @$id_dis = substr($data['id_dis'],4);
  @$id_dis = intval($id_dis);
  if($id_dis <10){
    @$id_dis = substr($data['id_dis'],14);
    $id_dis = "DSTU0000000000".( $id_dis+1);
  }
  elseif($id_dis <100){
    @$id_dis = substr($data['id_dis'],13);
    $id_dis = "DSTU000000000".( $id_dis+1);
  }
  elseif($id_dis <1000){
    @$id_dis = substr($data['id_dis'],12);
    $id_dis = "DSTU00000000".( $id_dis+1);
  }
  elseif($id_dis <10000){
    @$id_dis = substr($data['id_dis'],11);
    $id_dis = "DSTU0000000".( $id_dis+1);
  }
  elseif($id_dis <100000){
    @$id_dis = substr($data['id_dis'],10);
    $id_dis = "DSTU000000".( $id_dis+1);
  }
  elseif($id_dis <1000000){
    @$id_dis = substr($data['id_dis'],9);
    $id_dis = "DSTU00000".( $id_dis+1);
  }
  elseif($id_dis <10000000){
    @$id_dis = substr($data['id_dis'],8);
    $id_dis = "DSTU0000".( $id_dis+1);
  }
  elseif($id_dis <100000000){
    @$id_dis = substr($data['id_dis'],7);
    $id_dis = "DSTU000".( $id_dis+1);
  }
  elseif($id_dis <100000000){
    @$id_dis = substr($data['id_dis'],6);
    $id_dis = "DSTU000".( $id_dis+1);
  }
  elseif($id_dis <1000000000){
    @$id_dis = substr($data['id_dis'],5);
    $id_dis = "DSTU00".( $id_dis+1);
  }
  elseif($id_dis <10000000000){
    @$id_dis = substr($data['id_dis'],4);
    $id_dis = "DSTU0".( $id_dis+1);
  }
}
?>


<form action="" method="POST">
    <div class="container w-75  mt-3 pt-3" data-aos="fade-up" data-aos-delay="100">
        <div class="">
          <label class="form-label h5 ">Id Distributor :</label>
          <input readonly type="text" class="form-control" name="id_dis" value="<?php if(@$edit['id_dis']==null){echo $id_dis;}else{ echo @$edit['id_dis'];}?>" required>
          <label class="form-label h5 ">Nama Distributor :</label>
          <input type="text" class="form-control" name="nama_dis" value="<?php echo @$edit['nama_dis'] ?>" required>
          <label class="form-label h5 ">alamat :</label>
          <textarea class="form-control" rows="3" name="alamat_dis"><?php echo @$edit['alamat'] ?></textarea>
          <label class="form-label h5 ">no telpon :</label>
          <input type="number" class="form-control" name="telpon" value="<?php echo @$edit['telpon_dis'] ?>" required>
          <?php if (@$_GET['id']=="") { ?>
          <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary text-light mt-2">
          <?php  }else{?>
          <input type="submit" name="ubah" value="UBAH" class="btn btn-primary text-light mt-2">
          <?php  }?> 
        </div>
        <div class="mt-2">
          
        </div>      
    </div>
</form>

<div class="container w-75  text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0" data-aos="fade-up" data-aos-delay="200">
  <table id="data" class="data table table-striped table-bordered border-light table-hover py-3">
    <thead class="table-primary">
      <tr>
        <th>id distributor</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No Telpon</th>
        <th>Edit</th>
        <th>hapus</th>
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
                <td><?=  $r['id_dis'] ?></td>
                <td><?=  $r['nama_dis'] ?></td>
                <td><?=  $r['alamat'] ?></td>
                <td><?=  $r['telpon_dis'] ?></td>
                <td><a class="btn btn-primary text-light hover" href="?menu=distributor&hapus&id=<?= $r['id_dis']?>" onclick=return confirm('yakin mau hapus?')>Hapus</a></td>
                <td><a class="btn btn-primary text-light hover" href="?menu=distributor&edit&id=<?= $r['id_dis']?>">Edit</a></td>
            </tr>
            <?php }  ?>
      </tbody>
      <tfoot class="table-primary">
        <tr>
        <th>id distributor</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No Telpon</th>
        <th>Edit</th>
        <th>hapus</th>
        </tr>
      </tfoot>
  </table>
</div>
