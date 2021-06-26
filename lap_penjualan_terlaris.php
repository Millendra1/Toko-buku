<?php
include "config/connection.php";
include "library/controller.php";


?>

<div class="container  text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-start-0 border-end-0" data-aos="fade-up" data-aos-delay="600" data-aos-anchor=".top">
  <table  id="data" class="data table table-striped table-bordered border-light table-hover py-3 display ">
    <thead>
        <tr class="table-primary">
            <th>NO</th>
            <th>Id Buku</th>
            <th>Judul Buku</th>
            <th>Jumlah Terjual</th>
          </tr>
    </thead>
    <tbody class="table-light">
        <?php 
            
            $no = 0;
            $sql = "SELECT DISTINCT id_buku from penjualan ";
            $jalan = mysqli_query($con, $sql);
            
              
              // if ($jalan == "") {
              //     echo "<tr><td colspan='4'>No Record</td></tr>";
              
              // } else{

              // foreach($jalan as $r){
              //     $no++
              // $query=mysqli_fetch_assoc($jalan);
              while ($r = mysqli_fetch_assoc($jalan)){
              $query = "SELECT * ,sum(jumlah_beli) AS jumlah_beli from penjualan INNER JOIN buku using(id_buku) WHERE id_buku = '$r[id_buku]' ";
              $data = mysqli_fetch_assoc(mysqli_query($con,$query));
              // $total_jual = mysqli_fetch_array(mysqli_query($con,"SELECT sum(jumlah_beli) AS jumlah_beli FROM penjualan WHERE id_buku = '$r[id_buku]' "));
              $no++;
          ?>
          <tr>
              <td><?=  $no ?></td>
              <td><?=  $data['id_buku'] ?></td>
              <td><?=  $data['judul'] ?></td>
              <td><?=  $data['jumlah_beli'] ?></td>
          </tr>
          <?php } ?>
    </tbody>
    <tfoot class="table-primary">
    <tr>
            <th>NO</th>
            <th>Id Buku</th>
            <th>Judul Buku</th>
            <th>Jumlah Terjual</th>
          </tr>
      </tr>
    </tfoot>

  </table>
</div>