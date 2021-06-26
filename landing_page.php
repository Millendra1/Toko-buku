<?php

@$sql="SELECT * FROM set_laporan";
$tampil=mysqli_fetch_assoc(mysqli_query($con,$sql));

?>



<div class="container  text-secondary mt-5 border border-4  rounded py-4 px-2 shadow  border-start-0 border-end-0">
  <div class="panel panel-heading">
    <div class="panel panel-title">
      <div class="mx-auto"> <img class="mx-auto d-block w-50" src="logo/<?= $tampil['logo'] ?>"> </div>
      <h2 align="center"><?= $tampil['nama_perusahaan'] ?></h2>
      <h3 align="center"></h3>
    </div>
  </div>
</div>
<div class="col-md-12 text-center">
  <p>Copyright 2021 <a href="#"></a>. Powered By <a href="#"> )</a></p>
</div>