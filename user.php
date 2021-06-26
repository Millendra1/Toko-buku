<?php 
include "config/connection.php";
include "library/controller.php";

$go = new controller();

$tabel = "user";
@$field = array('nama'=>$_POST['nama'],'alamat' =>$_POST['alamat'],'telpon'=>$_POST['telpon'],'status'=>$_POST['status'],'username'=>$_POST['user'], 'password'=>$_POST['pass'], 'akses'=>$_POST['akses']);
$redirect = "?menu=input_user";
@$where = "id = $_GET[id]";


if(isset($_POST['simpan'])){
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

?>

<form method="post">
    <div class="container w-75 mt-3 pt-3">
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">Nama :</label>
          <input type="text" class="form-control" name="nama" value="<?php echo @$edit['nama'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">Alamat :</label>
          <input type="text" class="form-control" name="alamat" value="<?php echo @$edit['alamat'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">telepon :</label>
          <input type="number" class="form-control" name="telpon" value="<?php echo @$edit['telpon'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">Status :</label>
          <input type="text" class="form-control" name="status" value="<?php echo @$edit['status'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="100">
          <label class="form-label h6">Username :</label>
          <input type="text" class="form-control" name="user" value="<?php echo @$edit['username'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="200">
        <label class="form-label h6">Password :</label>
        <input type="password"  class="form-control" name="pass" value="<?php echo@$edit['password'] ?>" required>
        </div>
        <div class="mb-2" data-aos="fade-up" data-aos-delay="200">
        <label class="form-label h6">Hak Akses :</label>
          <select class="form-select" name="akses" required>
            <option value="manager">manager</option>
            <option value="admin">admin</option>
            <option value="kasir">Kasir</option>
          </select>
        </div>

        <div data-aos="fade-up" data-aos-delay="300">
          <?php if (@$_GET['id']==""){?>
                  <input class="btn btn-primary text-light" type="submit" name="simpan" value = "simpan">
                <?php }
                else {?>
                  <input class="btn btn-primary text-light" type="submit" name="ubah" value="ubah">
                <?php } ?>
        </div>
    </div>
</form>


<div class="container w-75 text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0" data-aos="fade-up" data-aos-delay="400">
  <table  id="data" class="data table table-striped table-bordered table-hover py-3 display ">
    <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Password</th>
          <th>Aksi</th>
          <th>Aksi</th>
        </tr>
    </thead>
    <tbody class="table-light">
    <?php 
          $data = $go->tampil($con, $tabel);
          $no = 0;

          foreach($data as $r){
              $no++;
              echo "<tr>
                <td>".$r['id']."</td>
                <td>".$r['username']."</td>
                <td>".$r['password']."</td>
                <td><a class='btn btn-dark text-light hover' href=?menu=input_user&hapus&id=".$r['id']." onclick=return confirm('yakin mau hapus?')>Hapus</a></td>
                <td><a class='btn btn-dark text-light hover' href=?menu=input_user&edit&id=".$r['id'].">Edit</a></td>
              </tr>";
          } 
      ?>
    </tbody>
    <tfoot class="table-dark">
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Password</th>
          <th>Aksi</th>
          <th>Aksi</th>
        </tr>
    </tfoot>
  </table>
</div>