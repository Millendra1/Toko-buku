<?php
include "config/connection.php";
include "library/controller.php";


?>

<div class="container  text-secondary mt-5 border border-4  rounded py-4 px-2 shadow  border-start-0 border-end-0" data-aos="fade-up" data-aos-delay="600" data-aos-anchor=".top">
  <table  id="data" class="data table table-striped table-bordered border-light table-hover py-3 display ">
    <thead>
        <tr class="table-primary">
            <th>Id Faktur</th>
            <th>Id Buku</th>
            <th>Id Kasir</th>
            <th>Jumlah Beli</th>
            <th>Bayar</th>
            <th>Uang kembali</th>
            <th>Total Harga</th>
            <th>Tanggal Transaksi</th>
          </tr>
    </thead>
    <tbody class="table-light">
        <?php 
            
            $no = 0;
            $sql = "SELECT * from penjualan";
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
              <td><?=  $r['id_penjualan'] ?></td>
              <td><?=  $r['id_buku'] ?></td>
              <td><?=  $r['id_kasir'] ?></td>
              <td><?=  $r['jumlah_beli'] ?></td>
              <td><?=  $r['bayar'] ?></td>
              <td><?=  $r['kembalian'] ?></td>
              <td><?=  $r['total_harga'] ?></td>
              <td><?=  $r['tanggal'] ?></td>
          </tr>
          <?php }  ?>
    </tbody>
    <tfoot class="table-primary">
    <tr>
            <th>Id Faktur</th>
            <th>Id Buku</th>
            <th>Id Kasir</th>
            <th>Jumlah Beli</th>
            <th>Bayar</th>
            <th>Uang kembali</th>
            <th>Total Harga</th>
            <th>Tanggal Transaksi</th>
          </tr>
      </tr>
    </tfoot>

  </table>
</div>