<?php

function FuncPDO()
{
    $host = 'us-cdbr-iron-east-01.cleardb.net';
    $dbname = 'heroku_dcb24109b0b5c1c';
    $username = 'bb31e6f5157566';
    $password = '629b26ec';
    $dbc = new PDO("mysql:host=$host;dbname=$dbname",$username,$password); //menghubungkan ke database
    return $dbc;
}

function checkUser($username, $passwd) //membuat fungsi checkUser
{
    $dbc= FuncPDO(); //menghubungkan ke database
    $admin = $dbc->prepare("SELECT * FROM ADMIN WHERE SURNAME = :username and PASSWORD = SHA2(:passwd,0)"); //memberikan perintah query SELECT * pada table admin untuk di cek username dengan passwd sudah benar atau tidak
    $admin->bindValue(':username',$username); //bindValue untuk variable username
    $admin->bindValue(':passwd',$passwd); //bindValue untuk variable passwd
    $admin->execute(); //mengeksekusi queri yang sudah disiapkan sebelumnya

    $customer = $dbc->prepare("SELECT * FROM CUSTOMER WHERE USERNAME = :username and PASSWORD = SHA2(:passwd,0)"); //memberikan perintah query SELECT * pada table customer untuk di cek username dengan passwd sudah benar atau tidak
    $customer->bindValue(':username',$username); //bindValue untuk variable username
    $customer->bindValue(':passwd',$passwd); //bindValue untuk variable passwd
    $customer->execute(); //mengeksekusi queri yang sudah disiapkan sebelumnya

    if ($admin->rowcount() > 0) { //mengecek apakah admin dengan username dan passwd yang telah diinputkan ada pada tabel atau tidak ada
        session_start(); //memnulai session
        foreach ($admin as $key) { //mengambil nilai pada admin ke var $key
            $data = $key;
        }
        $_SESSION['level'] = 'admin'; //men-set session 'level' untuk menentukan user tsb adalah sebagi admin atau customer
        return $data; //return data
    }
    elseif ($customer->rowcount() > 0) {//mengecek apakah customer dengan username dan passwd yang telah diinputkan ada pada tabel atau tidak ada
        session_start(); //memnulai session
        foreach ($customer as $key) {  //mengambil nilai pada customer ke var $key
            $data = $key;
        }
        $_SESSION['level'] = 'customer'; //men-set session 'level' untuk menentukan user tsb adalah sebagi admin atau customer
        return $data; //return data
    }

    else { //jika username dan passwd yang di inputkan tidak cocok dengan data yang ada di database
        return ''; //maka akan return kosongan untuk pengecekan di halaman logi.php
    }
}
function set2col($table, $col, $value, $idcol, $id) //fungsi untuk men-set value yang ada pada subuah colom yang sudah ditenntukan
{
    $dbc = FuncPDO(); //menyambung ke database
    $query = $dbc->prepare("UPDATE $table SET $col=:value WHERE $idcol=:id"); //menyiapkan query update pada table dan value yang sudah ditenntukan
    $query->bindValue(':value',$value);//menyiapkan variable $value
    $query->bindValue(':id',$id);//menyiapkan variable $id
    $query->execute(); //mengeksekusi query yang sudah disiapkan sebelumnya

}
function getCol($table, $col, $idcol, $id)//fungsi untuk mengambil data pada sebuah colom yang sudah ditentukan
{
    $dbc = FuncPDO(); //menyambung ke database
    $query = $dbc->prepare("SELECT $col FROM $table WHERE $idcol = :id"); //menyiapkan query SELECT pada table dan value yang sudah ditenntukan
    $query->bindValue(':id',$id); ////menyiapkan variable $value
    $query->execute(); //mengeksekusi query yang sudah disiapkan sebelumnya
    if ($query->rowcount() > 0) { //jika data yang diambil ada.
        $lis = array();
        foreach ($query as $key => $value) { //mengambil nilai pada query ke var $key
            $lis[$key] = $value;

        }
        return $lis;
    }else {
        return '';
    }
}

function selectAll($table, $idCol = '', $id = '')
{
    $dbc = FuncPDO(); //menyambung ke database
    $query = '';
    if ($idCol) {
        $query = $dbc->prepare("SELECT * FROM $table WHERE $idCol=:id");//menyiapkan query SELECT pada table
        $query -> bindValue(':id',$id);
    }
    else {
        $query = $dbc->prepare("SELECT * FROM $table WHERE 1"); //menyiapkan query SELECT pada table
    }
    // $query = $dbc->prepare("SELECT * FROM $table WHERE 1"); //menyiapkan query SELECT pada table
    $query->execute(); //mengeksekusi query yang sudah disiapkan sebelumnya
    return $query->fetchAll();
}
function recordTransaksi($SelfNoRek, $no_rek, $nominal,$saldoAsal, $saldoTujuan)
{
    $dbc = FuncPDO(); //menyambung ke database
    $query = $dbc->prepare("INSERT INTO `TRANSAKSI`(`NO_REKENING`, `REK_NO_REKENING`, `TANGGAL`, `NOMINAL`,`SALDO_ASAL`,`SALDO_TUJUAN`) VALUES (:selfNoRek,:no_rek,:tgl,:nominal,:saldoAsal,:saldoTujuan)");
    $query -> bindValue(':selfNoRek',$SelfNoRek);
    $query -> bindValue(':no_rek',$no_rek);
    $query -> bindValue(':tgl',date("Y-m-d H:i:s"));
    $query -> bindValue(':nominal',$nominal);
    $query -> bindValue(':saldoAsal',$saldoAsal);
    $query -> bindValue(':saldoTujuan',$saldoTujuan);
    $query->execute(); //mengeksekusi query yang sudah disiapkan sebelumnya

}

function checkLassPass($pass,$idUsername)
{
    $dbc = FuncPDO(); //menyambung ke database
    $query = $dbc->prepare("SELECT * FROM CUSTOMER WHERE USERNAME=:id AND PASSWORD=SHA2(:pass,0)");
    $query->bindValue(':id',$idUsername);//menyiapkan variable $id
    $query->bindValue(':pass',$pass);//menyiapkan variable $value
    $query->execute();
    if ($query->rowcount() > 0) {
        return true;
    }
    else {
        return false;
    }
}
function setPass($newPass, $id)
{
    $dbc = FuncPDO(); //menyambung ke database
    $query = $dbc->prepare("UPDATE `CUSTOMER` SET `PASSWORD` = SHA2(:pass,0) WHERE `CUSTOMER`.`USERNAME` = :id");
    $query->bindValue(':pass',$newPass);
    $query->bindValue(':id',$id);
    $query->execute();
}

function getTransaksi($no_rek)
{
    $dbc = FuncPDO();
    $query = $dbc->prepare("SELECT `NO_TRANSAKSI`, `TANGGAL`, `NO_REKENING` ,`NOMINAL` ,`SALDO_ASAL` AS SALDO, 1 AS jenis FROM `TRANSAKSI` WHERE `NO_REKENING` =  :no_rek
                            UNION ALL
                             SELECT `NO_TRANSAKSI`, `TANGGAL`, `REK_NO_REKENING`, `NOMINAL`,`SALDO_TUJUAN` AS SALDO, 0 AS jenis FROM `TRANSAKSI` WHERE `REK_NO_REKENING` = :no_rek
                             ORDER BY `TANGGAL` ");
    $query->bindValue(':no_rek',$no_rek);
    $query->execute();
    return $query->fetchAll();
}
function jenisKelamin($value)
{
    if ($value) {
       return "Laki-Laki";
    }
    else {
       return "Perempuan";
    }
}

function addCustomer($username,$password,$nama,$tgl_lahir,$jenisKelamin,$alamat,$noTlp,$email)
{
    $dbc = FuncPDO();
    $query = $dbc->prepare("INSERT INTO `CUSTOMER`(`USERNAME`, `PASSWORD`, `NAMA`, `TGL_LAHIR`, `JENIS_KELAMIN`, `ALAMAT`, `NO_TELP`, `EMAIL`)
                            VALUES (:username,SHA2(:password,0),:nama,:tgl_lahir,:jenisKelamin,:alamat,:noTlp,:email)");
    $query->bindValue(':username',$username);
    $query->bindValue(':password',$password);
    $query->bindValue(':nama',$nama);
    $query->bindValue(':tgl_lahir',$tgl_lahir);
    $query->bindValue(':jenisKelamin',$jenisKelamin);
    $query->bindValue(':alamat',$alamat);
    $query->bindValue(':noTlp',$noTlp);
    $query->bindValue(':email',$email);
    $query->execute();
}
function addRek($no_rek,$saldo,$pin,$username)
{
    $dbc = FuncPDO();
    $query = $dbc->prepare("INSERT INTO `REKENING`(`NO_REKENING`, `USERNAME`, `PIN`, `SALDO`)
                            VALUES (:no_rek,:username,:pin,:saldo)");
    $query->bindValue(':no_rek',$no_rek);
    $query->bindValue(':username',$username);
    $query->bindValue(':pin',$pin);
    $query->bindValue(':saldo',$saldo);
    $query->execute();
}

function deleteRow($table, $whereId, $id)
{
    $dbc = FuncPDO();
    $query = $dbc->prepare("DELETE FROM $table WHERE $whereId = :id");
    $query->bindValue(':id',$id);
    $query->execute();

}

?>
