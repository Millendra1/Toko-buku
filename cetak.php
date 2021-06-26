<?php 

include 'config/connection.php';
include 'library/controller.php';

@$id_fak=$_GET['id'];

@$sql = mysqli_query($con,"SELECT * FROM penjualan WHERE id_penjualan = '$id_fak'");
@$data = mysqli_fetch_assoc($sql);			 					

?>

<div class="container  text-secondary mt-5 border border-4  rounded py-4 px-2 shadow  border-start-0 border-end-0" data-aos="fade-up" data-aos-delay="600" data-aos-anchor=".top">
<h1 class="mb-5">CETAK STRUK PENJUALAN</h1>
    <table class="data table table-primary table-striped table-bordered border-light table-hover py-3 display" id="">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Buku</th>
                  <th>Jumlah Beli</th>
                  <th>Harga</th>
                  <th>PPN</th>
                  <th>Diskon</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody class="table-light">
              <?php
                    $no=0;
                    @$sql = mysqli_query($con,"SELECT * FROM penjualan INNER JOIN buku USING(id_buku) WHERE id_penjualan = '$id_fak'");
                    while($data = mysqli_fetch_assoc($sql)){
                      
                    $no++;
                  ?>
                  <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $data['judul'] ?></td>
                  <td><?php echo $data['jumlah_beli'] ?></td>
                  <td><?php echo $data['harga_jual'] ?></td>
                  <td><?php echo $data['ppn'] ?></td>
                  <td><?php echo $data['diskon'] ?></td>
                  <td><?php  @$total = (intval($data['jumlah_beli'])*intval($data['harga_jual'])); echo $total; ?></td>
                  <?php } ?> 
                </tbody> 
                <tfoot class="table-secondary">
                <?php 
                @$sql = mysqli_query($con,"SELECT * FROM penjualan WHERE id_penjualan = '$id_fak'");
                @$data = mysqli_fetch_assoc($sql);
                ?>
                  <tr>
                    <td colspan="2">Total buku</td>
                    <?php 
                       $sql = mysqli_fetch_array(mysqli_query($con,"SELECT jumlah_beli,sum(jumlah_beli) AS jumlah_beli FROM penjualan WHERE id_penjualan = '$id_fak' "));
                    ?>
                    <td colspan="2" ><?= $sql['jumlah_beli'] ?>&nbsp;&nbsp;&nbsp;<strong>BUKU</strong></td>
                    <td>Total Harga | setelah diskon dan pajak </td>
                    <td colspan="2"><?php echo $data['total_harga']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="4"></td>
                    <td>Bayar</td>
                    <td colspan="2"><?php echo $data['bayar']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="4"></td>
                    <td>Kembalian</td>
                    <td colspan="2"><?php echo $data['kembalian']; ?></td>
                  </tr>
                </tfoot>
    </table>
    <a class="w-100 btn btn-primary mt-2">CETAK</a>
    <a class="w-100 btn btn-primary mt-1" href="?menu=cetakfak">KEMBALI</a>


</div>