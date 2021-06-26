<?php

class controller{

    //fungsi login
    function login($con, $tabel, $username, $password, $hak, $redirect){
        $sql = "SELECT * FROM $tabel WHERE username = '$username' and password = '$password' and akses ='$hak' ";
        $jalan = mysqli_query($con, $sql);
        $cek = mysqli_num_rows($jalan);
        if($cek > 0){
            echo "<script>alert('Selamat Datang $username');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal login. cek username & password');document.location.href='index.php'</script>";
        }
    } 
    //penutup fungsi login

    //fungsi simpan
    function simpan($con, $tabel, array $field, $redirect){
        $sql = "INSERT INTO $tabel SET ";
        // sql -> insert into login set
        
        foreach($field as $key => $value){
            $sql.= " $key = '$value',";  
            // sql-> insert into login set username = '$_POST[username]', password = '$_POST[password]',
        }

        $sql = rtrim($sql, ',');
        // sql -> insert into login set username = '$_POST[username]', password = '$_POST[password]',
       

        $jalan = mysqli_query($con, $sql);
        if(isset($jalan)){
            echo "<script>alert('Berhasil tersimpan');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal disimpan');document.location.href='$redirect'</script>";
        }
    }
    //penutup fungsi simpan

    //fungsi tampil
    function tampil($con, $tabel){
        $sql = "SELECT * FROM $tabel";
        $jalan = mysqli_query($con, $sql);
        while($data = mysqli_fetch_assoc($jalan))
            $isi[] = $data;
            return @$isi;
    }
    //penutup fungsi tampil

    //fungsi hapus
    function hapus($con, $tabel, $where, $redirect){
        $sql = "DELETE FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        if($jalan){
            echo "<script>alert('Berhasil dihapus');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal dihapus');document.location.href='$redirect'</script>";
        }
    }
    //penutup fungsi hapus

    //fungsi edit
    function edit($con, $tabel, $where){
        $sql = "SELECT * FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        $tampung = mysqli_fetch_assoc($jalan);
        return $tampung;
    }
    //penutup fungsi edit

    //fungsi ubah
    function ubah($con, $tabel, array $field, $where, $redirect){
        $sql = "UPDATE $tabel SET ";
        foreach($field as $key => $value){
            $sql.= " $key = '$value',";  
        }
        $sql = rtrim($sql, ',');
        $sql.= " WHERE $where";
        // sql-> update login set username = admin, password = admin where id = 1';

        $jalan = mysqli_query($con, $sql);
        if($jalan){
            echo "<script>alert('Berhasil diubah');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal diubah');document.location.href='$redirect'</script>";
        }
    }
    //penutup fungsi ubah
    function upload($foto, $tempat){
      $alamat = $foto['tmp_name'];
      $namafile = "logo.jpg";
      move_uploaded_file($alamat, "$tempat/$namafile");
      return $namafile;
  }
}
//penutup class controller


?>