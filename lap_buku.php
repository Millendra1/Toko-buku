<?php
include "config/connection.php";
include "library/controller.php";
?>
 <div class="container">
  <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow  border-start-0 border-end-0" data-aos="fade-up" data-aos-delay="600" data-aos-anchor=".top">
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
    <tfoot class="table-primary">
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