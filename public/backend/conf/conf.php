<?php
    if(strpos($_SERVER['REQUEST_URI'],"conf")){
        exit(header("Location:../index.php"));
    }
    
    $db_hostname    = "127.0.0.1";
    $db_username    = "server";
    $db_password    = "rssms123";
    $db_name        = "databaru";
    define('USERHYBRIDWEB', 'yanghack');
    define('PASHYBRIDWEB', 'sialselamanya');

    function host(){
        global $db_hostname;
        return $db_hostname;
    }

    function  bukakoneksi(){
     	global $db_hostname, $db_username, $db_password, $db_name;
         $konektor=mysqli_connect($db_hostname,$db_username,$db_password)
         or die ("<font color=red><h3>Not Connected ..!!</h3></font>");
         $db_select=mysqli_select_db($konektor, $db_name)
         or die("<font color=red><h3>Cannot chose database..!!</h3></font>". mysqli_error());
	return $konektor;
    }
     
    $sqlinjectionchars = array("=","-","'","\"","+"); //tambah sendiri

    function cleankar($dirty){
	$konektor=bukakoneksi();
	$clean = mysqli_real_escape_string($konektor,$dirty);	
	mysqli_close($konektor);
	return preg_replace('/[^a-zA-Z0-9\s_,@. ]/', '',$clean);
    }
    
    function mysql_safe_query($format) {
        $args = array_slice(func_get_args(),1);
        $args = array_map('mysql_safe_string',$args);
        $query = vsprintf($format,$args);
        return mysqli_query($query);
    }
    
    function validUrl($url){
        $format="/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(([0-9]{1,5})?\/.*)?$/";
        $url=strtolower($url);
        if(preg_match($format,$url)) return true; else return false;
    }
    
    function validTeks($data){
        $save=str_replace("'","",$data);
        $save=str_replace("\\","",$save);
        $save=str_replace(";","",$save);
        $save=str_replace("`","",$save);
        $save=str_replace("--","",$save);
        $save=str_replace("/*","",$save);
        $save=str_replace("*/","",$save);
        $save=str_replace("text/html","",$save);
        $save=str_replace("<script>","",$save);
        $save=str_replace("</script>","",$save);
        $save=str_replace("<noscript>","",$save);
        $save=str_replace("</noscript>","",$save);
        $save=str_replace("<img","",$save);
        $save=str_replace("document","",$save);
        $save=str_replace(" from ","",$save);
        $save=str_replace("concat","",$save);
        $save=str_replace("union","",$save);
        $save=str_replace("base64","",$save);
        $save=str_replace("//","",$save);
        $save=str_replace("*","",$save);
        $save=str_replace("}","",$save);
        $save=str_replace("$","",$save);
        $save=str_replace("{","",$save);
        $save=str_replace("@","",$save);
        $save=str_replace("[","",$save);
        $save=str_replace("]","",$save);
        $save=str_replace("(","",$save);
        $save=str_replace(")","",$save);
        $save=str_replace("|","",$save);
        $save=str_replace(",","",$save);
        $save=str_replace("<","",$save);
        $save=str_replace(">","",$save);
        $save=str_replace(":","",$save);
        $save=str_replace("+","",$save);
        $save=str_replace("^","",$save);
        $save=str_replace("#","",$save);
        $save=str_replace("!","",$save);
        $save=str_replace("='","",$save);
        $save=str_replace("=/","",$save);
        $save=str_replace("=","",$save);
        return $save;
    }
    
    function validTeks2($data){
        $save=str_replace("'","",$data);
        $save=str_replace("\\","",$save);
        $save=str_replace(";","",$save);
        $save=str_replace("`","",$save);
        $save=str_replace("--","",$save);
        $save=str_replace("/*","",$save);
        $save=str_replace("*/","",$save);
        $save=str_replace("text/html","",$save);
        $save=str_replace("<script>","",$save);
        $save=str_replace("</script>","",$save);
        $save=str_replace("<noscript>","",$save);
        $save=str_replace("</noscript>","",$save);
        $save=str_replace("<img","",$save);
        $save=str_replace("document","",$save);
        $save=str_replace(" from ","",$save);
        $save=str_replace("concat","",$save);
        $save=str_replace("union","",$save);
        $save=str_replace("base64","",$save);
        $save=str_replace("//","",$save);
        $save=str_replace("*","",$save);
        $save=str_replace("}","",$save);
        $save=str_replace("$","",$save);
        $save=str_replace("{","",$save);
        $save=str_replace("@","",$save);
        $save=str_replace("[","",$save);
        $save=str_replace("]","",$save);
        $save=str_replace("(","",$save);
        $save=str_replace(")","",$save);
        $save=str_replace("|","",$save);
        $save=str_replace(",","",$save);
        $save=str_replace("<","",$save);
        $save=str_replace(">","",$save);
        $save=str_replace(":","",$save);
        $save=str_replace("+","",$save);
        $save=str_replace("^","",$save);
        $save=str_replace("!","",$save);
        $save=str_replace("='","",$save);
        $save=str_replace("=/","",$save);
        $save=str_replace("=","",$save);
        return $save;
    }
    
    function validTeks3($data){
        $save=str_replace("'","",$data);
        $save=str_replace("\\","",$save);
        $save=str_replace(";","",$save);
        $save=str_replace("`","",$save);
        $save=str_replace("--","",$save);
        $save=str_replace("/*","",$save);
        $save=str_replace("*/","",$save);
        $save=str_replace("text/html","",$save);
        $save=str_replace("<script>","",$save);
        $save=str_replace("</script>","",$save);
        $save=str_replace("<noscript>","",$save);
        $save=str_replace("</noscript>","",$save);
        $save=str_replace("<img","",$save);
        $save=str_replace("document","",$save);
        $save=str_replace(" from ","",$save);
        $save=str_replace("concat","",$save);
        $save=str_replace("union","",$save);
        $save=str_replace("base64","",$save);
        $save=str_replace("//","",$save);
        $save=str_replace("*","",$save);
        $save=str_replace("}","",$save);
        $save=str_replace("$","",$save);
        $save=str_replace("{","",$save);
        $save=str_replace("@","",$save);
        $save=str_replace("[","",$save);
        $save=str_replace("]","",$save);
        $save=str_replace("(","",$save);
        $save=str_replace(")","",$save);
        $save=str_replace("|","",$save);
        $save=str_replace(",","",$save);
        $save=str_replace("<","",$save);
        $save=str_replace(">","",$save);
        $save=str_replace("+","",$save);
        $save=str_replace("^","",$save);
        $save=str_replace("!","",$save);
        $save=str_replace("='","",$save);
        $save=str_replace("=/","",$save);
        $save=str_replace("=","",$save);
        return $save;
    }
    
    function validTeks4($data,$panjang){
        $save="";
        if(strlen($data)>$panjang){
            header('Location: https://www.google.com');
        }else{
            $save=str_replace("'","",$data);
            $save=str_replace("\\","",$save);
            $save=str_replace(";","",$save);
            $save=str_replace("`","",$save);
            $save=str_replace("--","",$save);
            $save=str_replace("/*","",$save);
            $save=str_replace("*/","",$save);
            $save=str_replace("text/html","",$save);
            $save=str_replace("<script>","",$save);
            $save=str_replace("</script>","",$save);
            $save=str_replace("<noscript>","",$save);
            $save=str_replace("</noscript>","",$save);
            $save=str_replace("<img","",$save);
            $save=str_replace("document","",$save);
            $save=str_replace(" from ","",$save);
            $save=str_replace("concat","",$save);
            $save=str_replace("union","",$save);
            $save=str_replace("base64","",$save);
            $save=str_replace("//","",$save);
            $save=str_replace("*","",$save);
            $save=str_replace("}","",$save);
            $save=str_replace("$","",$save);
            $save=str_replace("{","",$save);
            $save=str_replace("@","",$save);
            $save=str_replace("[","",$save);
            $save=str_replace("]","",$save);
            $save=str_replace("(","",$save);
            $save=str_replace(")","",$save);
            $save=str_replace("|","",$save);
            $save=str_replace(",","",$save);
            $save=str_replace("<","",$save);
            $save=str_replace(">","",$save);
            $save=str_replace(":","",$save);
            $save=str_replace("+","",$save);
            $save=str_replace("^","",$save);
            $save=str_replace("#","",$save);
            $save=str_replace("!","",$save);
            $save=str_replace("='","",$save);
            $save=str_replace("=/","",$save);
            $save=str_replace("=","",$save);
        }
        return $save;
    }
    
    function validTeks5($data,$panjang){
        $save="";
        if(strlen($data)>$panjang){
            header('Location: https://www.google.com');
        }else{
            $save=str_replace("'","",$data);
            $save=str_replace("\\","",$save);
            $save=str_replace(";","",$save);
            $save=str_replace("`","",$save);
            $save=str_replace("--","",$save);
            $save=str_replace("/*","",$save);
            $save=str_replace("*/","",$save);
            $save=str_replace("text/html","",$save);
            $save=str_replace("<script>","",$save);
            $save=str_replace("</script>","",$save);
            $save=str_replace("<noscript>","",$save);
            $save=str_replace("</noscript>","",$save);
            $save=str_replace("<img","",$save);
            $save=str_replace("document","",$save);
            $save=str_replace(" from ","",$save);
            $save=str_replace("concat","",$save);
            $save=str_replace("union","",$save);
            $save=str_replace("base64","",$save);
            $save=str_replace("//","",$save);
            $save=str_replace("*","",$save);
            $save=str_replace("}","",$save);
            $save=str_replace("$","",$save);
            $save=str_replace("{","",$save);
            $save=str_replace("@","",$save);
            $save=str_replace("[","",$save);
            $save=str_replace("]","",$save);
            $save=str_replace("(","",$save);
            $save=str_replace(")","",$save);
            $save=str_replace("|","",$save);
            $save=str_replace(",","",$save);
            $save=str_replace("<","",$save);
            $save=str_replace(">","",$save);
            $save=str_replace("+","",$save);
            $save=str_replace("^","",$save);
            $save=str_replace("#","",$save);
            $save=str_replace("!","",$save);
            $save=str_replace("='","",$save);
            $save=str_replace("=/","",$save);
            $save=str_replace("=","",$save);
        }
        return $save;
    }
    
    function validTeks6($data,$panjang){
        $save="";
        if(strlen($data)>$panjang){
            header('Location: https://www.google.com');
        }else{
            $save=str_replace("'","",$data);
            $save=str_replace("\\","",$save);
            $save=str_replace(";","",$save);
            $save=str_replace("`","",$save);
            $save=str_replace("--","",$save);
            $save=str_replace("/*","",$save);
            $save=str_replace("*/","",$save);
            $save=str_replace("text/html","",$save);
            $save=str_replace("<script>","",$save);
            $save=str_replace("</script>","",$save);
            $save=str_replace("<noscript>","",$save);
            $save=str_replace("</noscript>","",$save);
            $save=str_replace("<img","",$save);
            $save=str_replace("document","",$save);
            $save=str_replace(" from ","",$save);
            $save=str_replace("concat","",$save);
            $save=str_replace("union","",$save);
            $save=str_replace("base64","",$save);
            $save=str_replace("//","",$save);
            $save=str_replace("*","",$save);
            $save=str_replace("}","",$save);
            $save=str_replace("$","",$save);
            $save=str_replace("{","",$save);
            $save=str_replace("@","",$save);
            $save=str_replace("[","",$save);
            $save=str_replace("]","",$save);
            $save=str_replace("|","",$save);
            $save=str_replace("<","",$save);
            $save=str_replace(">","",$save);
            $save=str_replace("+","",$save);
            $save=str_replace("^","",$save);
            $save=str_replace("#","",$save);
            $save=str_replace("!","",$save);
            $save=str_replace("='","",$save);
            $save=str_replace("=/","",$save);
            $save=str_replace("=","",$save);
        }
        return $save;
    }
    
    function validangka($angka){
        if (isset($angka)) {
            if(!is_numeric($angka)) {
                return 0;
            }else{
                return $angka;
            }
        }else{
            return 0;
        }
    }
    
    function antisqlinjection($hal){
       /* if(!get_magic_quotes_gpc()){
            $_GET = array_map('mysql_real_escape_string', $_GET); 
            $_POST = array_map('mysql_real_escape_string', $_POST); 
            $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
        }else{  
            $_GET = array_map('stripslashes', $_GET); 
            $_POST = array_map('stripslashes', $_POST); 
            $_COOKIE = array_map('stripslashes', $_COOKIE);
            $_GET = array_map('mysql_real_escape_string', $_GET); 
            $_POST = array_map('mysql_real_escape_string', $_POST); 
            $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
        }
        if (strlen($_SERVER['REQUEST_URI']) > 255 || strpos($_SERVER['REQUEST_URI'], "concat") || 
                strpos($_SERVER['REQUEST_URI'], "union") || strpos($_SERVER['REQUEST_URI'], "base64") || 
                strpos($_SERVER['REQUEST_URI'], "'")||strpos($_SERVER['REQUEST_URI'], "/")||
                strpos($_SERVER['REQUEST_URI'], "*")||strpos($_SERVER['REQUEST_URI'], ";")||
                strpos($_SERVER['REQUEST_URI'], "/*")||strpos($_SERVER['REQUEST_URI'], "\\")||
                strpos($_SERVER['REQUEST_URI'], "}")||strpos($_SERVER['REQUEST_URI'], "$")||
                strpos($_SERVER['REQUEST_URI'], "{")||strpos($_SERVER['REQUEST_URI'], "@")||
                strpos($_SERVER['REQUEST_URI'], "[")||strpos($_SERVER['REQUEST_URI'], "]")||
                strpos($_SERVER['REQUEST_URI'], "(")||strpos($_SERVER['REQUEST_URI'], ")")||
                strpos($_SERVER['REQUEST_URI'], "|")||strpos($_SERVER['REQUEST_URI'], ",")||
                strpos($_SERVER['REQUEST_URI'], "<")||strpos($_SERVER['REQUEST_URI'], ">")||
                strpos($_SERVER['REQUEST_URI'], "`")||strpos($_SERVER['REQUEST_URI'], ":")||
                strpos($_SERVER['REQUEST_URI'], "+")||strpos($_SERVER['REQUEST_URI'], "-")||
                strpos($_SERVER['REQUEST_URI'], "^")||strpos($_SERVER['REQUEST_URI'], "#")||
                strpos($_SERVER['REQUEST_URI'], "!")||strpos($_SERVER['REQUEST_URI'], "-")||
                strpos($_SERVER['REQUEST_URI'], "='")||strpos($_SERVER['REQUEST_URI'], "=/")) {
            echo "<b>Harus disetujui : <br/>
            Dilarang keras melakukan hacking/membajak Software/Web ini dengan cara apapun.<br/>
            Bagi yang sengaja melakukan hacking/membajak softaware ini,<br/>
            kami sumpahi sial 1000 turunan,miskin sampai 500 turunan.<br/>
            Selalu mendapat kecelakaan sampai 400 turunan. Anak pertama<br/>
            nya cacat tidak punya kaki sampai 300 turunan. Susah cari jodoh<br/>
            sampai umur 50 tahun sampai 200 turunan. Ya Alloh maafkan kami <br/>
            karena telah berdoa buruk, semua ini kami lakukan karena kami ti<br/>
            dak pernah rela karya kami dihack/dibajak..</b> ";
            Zet($hal);
            @header("HTTP/1.1 414 Request-URI Too Long");
            @header("Status: 414 Request-URI Too Long");
            @header("Connection: Close");
            @exit;
        }*/
        
    }
    
    function reportsqlinjection(){
        /*if(!get_magic_quotes_gpc()){
            $_GET = array_map('mysql_real_escape_string', $_GET); 
            $_POST = array_map('mysql_real_escape_string', $_POST); 
            $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
        }else{  
            $_GET = array_map('stripslashes', $_GET); 
            $_POST = array_map('stripslashes', $_POST); 
            $_COOKIE = array_map('stripslashes', $_COOKIE);
            $_GET = array_map('mysql_real_escape_string', $_GET); 
            $_POST = array_map('mysql_real_escape_string', $_POST); 
            $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
        }
        if (strlen($_SERVER['REQUEST_URI']) > 255 || strpos($_SERVER['REQUEST_URI'], "concat") || 
                strpos($_SERVER['REQUEST_URI'], "union") || strpos($_SERVER['REQUEST_URI'], "base64") || 
                strpos($_SERVER['REQUEST_URI'], "'")||strpos($_SERVER['REQUEST_URI'], "/")||
                strpos($_SERVER['REQUEST_URI'], "*")||strpos($_SERVER['REQUEST_URI'], ";")||
                strpos($_SERVER['REQUEST_URI'], "/*")||strpos($_SERVER['REQUEST_URI'], "\\")||
                strpos($_SERVER['REQUEST_URI'], "}")||strpos($_SERVER['REQUEST_URI'], "$")||
                strpos($_SERVER['REQUEST_URI'], "{")||strpos($_SERVER['REQUEST_URI'], "@")||
                strpos($_SERVER['REQUEST_URI'], "[")||strpos($_SERVER['REQUEST_URI'], "]")||
                strpos($_SERVER['REQUEST_URI'], "(")||strpos($_SERVER['REQUEST_URI'], ")")||
                strpos($_SERVER['REQUEST_URI'], "|")||strpos($_SERVER['REQUEST_URI'], ",")||
                strpos($_SERVER['REQUEST_URI'], "<")||strpos($_SERVER['REQUEST_URI'], ">")||
                strpos($_SERVER['REQUEST_URI'], "`")||strpos($_SERVER['REQUEST_URI'], ":")||
                strpos($_SERVER['REQUEST_URI'], "+")||strpos($_SERVER['REQUEST_URI'], "-")||
                strpos($_SERVER['REQUEST_URI'], "^")||strpos($_SERVER['REQUEST_URI'], "#")||
                strpos($_SERVER['REQUEST_URI'], "!")||strpos($_SERVER['REQUEST_URI'], "-")||
                strpos($_SERVER['REQUEST_URI'], "='")||strpos($_SERVER['REQUEST_URI'], "=/")) {
            echo "<b>Harus disetujui : <br/>
            Dilarang keras melakukan hacking/membajak Software/Web ini dengan cara apapun.<br/>
            Bagi yang sengaja melakukan hacking/membajak softaware ini,<br/>
            kami sumpahi sial 1000 turunan,miskin sampai 500 turunan.<br/>
            Selalu mendapat kecelakaan sampai 400 turunan. Anak pertama<br/>
            nya cacat tidak punya kaki sampai 300 turunan. Susah cari jodoh<br/>
            sampai umur 50 tahun sampai 200 turunan. Ya Alloh maafkan kami <br/>
            karena telah berdoa buruk, semua ini kami lakukan karena kami ti<br/>
            dak pernah rela karya kami dihack/dibajak..</b> ";
            echo"<meta http-equiv='refresh' content='2;?'>";
            @header("HTTP/1.1 414 Request-URI Too Long");
            @header("Status: 414 Request-URI Too Long");
            @header("Connection: Close");
            @exit;
        }*/
        
    }
    
    function tutupkoneksi(){
       global  $konektor;
       mysqli_close($konektor);
    }

    function bukaquery($sql){    
        $konektor=bukakoneksi();
        $result=mysqli_query($konektor, $sql)
        or die (/*mysqli_error($konektor)*/"Silahkan hubungi administrator..!");
        mysqli_close($konektor);
        return $result;
    }
    
    function fetch_assoc($sql) {
        $result = mysqli_fetch_assoc(bukaquery($sql));
        return $result;
    }
     
    function bukaquery2($sql){
        $konektor=bukakoneksi();
        $result=mysqli_query($konektor,$sql);
        mysqli_close($konektor);
        return $result;
    }

    function bukainput($sql){
        $konektor=bukakoneksi();
        $result=mysqli_query($konektor,$sql)
        or die(/*mysqli_error().*/"<br/><font color=red><b>Gagal..!!</b>");
        mysqli_close($konektor);
        return $result;
    }

    function hapusinput($sql){
        $konektor=bukakoneksi();
        $result=mysqli_query($konektor,$sql)
        or die("<font color=red><b>Gagal</b>, Data masih dipakai di tabel lain !");
        mysqli_close($konektor);
        return $result;
    }

    function Tambah($tabelname,$attrib,$pesan) {
        $command = bukainput("INSERT INTO ".$tabelname." VALUES (".$attrib.")");
        echo  "<img src='images/simpan.gif' />&nbsp;&nbsp; Data $pesan berhasil disimpan";
        return $command;
    }
     
    function Tambah2($tabelname,$attrib,$pesan) {
        $command = bukainput("INSERT INTO ".$tabelname." VALUES (".$attrib.")");
        echo  "<img src='images/simpan.gif' />&nbsp;&nbsp; <font size='9'>Data $pesan berhasil disimpan</font>";
        return $command;
    }
     
    function Tambah3($tabelname,$attrib) {
        $command = bukainput("INSERT INTO ".$tabelname." VALUES (".$attrib.")");
        return $command;
    }

    function InsertData($tabelname,$attrib) {
        $command = bukaquery("INSERT INTO ".$tabelname." VALUES (".$attrib.")");
        return $command;
    }
     
    function InsertData2($tabelname,$attrib) {
        $command = bukaquery2("INSERT INTO ".$tabelname." VALUES (".$attrib.")");
        return $command;
    }
     
    function EditData($tabelname,$attrib) {
        $command = bukaquery("UPDATE ".$tabelname." SET ".$attrib." ");
        return $command;
    }

    function Ubah($tabelname,$attrib,$pesan) {
        $command = bukaquery("UPDATE ".$tabelname." SET ".$attrib." ");
        echo  "<img src='images/simpan.gif' />&nbsp;&nbsp; Data $pesan berhasil diubah";
        return $command;
    }
     
    function Ubah2($tabelname,$attrib) {
        $command = bukaquery("UPDATE ".$tabelname." SET ".$attrib." ");
        return $command;
    }

    function Hapus($tabelname,$param,$hal) {
        $sql ="DELETE FROM ".$tabelname." WHERE ".$param." ";
        $command = hapusinput($sql);
        Zet($hal);
        return $command;
    }
     
    function Hapus2($tabelname,$param) {
        $sql ="DELETE FROM ".$tabelname." WHERE ".$param." ";
        $command = hapusinput($sql);
        return $command;
    }

    function HapusAll($tabelname) {
        $sql ="DELETE FROM ".$tabelname;
        $command = bukaquery($sql);
        return $command;
    }
     
    function deletegb($sql){
         $_sql         = $sql;
         $hasil        = bukaquery($_sql);
         $baris        = mysqli_fetch_row($hasil);
         $gb           = $baris[0];
         $hapus        = unlink($gb);
    }

    function JSRedirect($url){
         echo"<html><head><title></title><meta http-equiv='refresh' content='1;URL=$url'></head><body></body></html>";
    }

    function Zet($url){
         echo"<html><head><title></title><meta http-equiv='refresh' content='0;URL=$url'></head><body></body></html>";
    }

    function JurusKibasNaga(){
        $id	= $_SERVER['REMOTE_ADDR'];
        $sql = bukaquery("DELETE FROM tmp WHERE ID='$id'");
        return $sql;
    }


    function konversiTgl($tanggal){
        list($thn,$bln,$tgl)=explode('-',$tanggal);
        $tmp = $tgl."-".$bln."-".$thn;
        return $tmp;
    }

    function konversiBulan($bln) {
        switch($bln) {
            case "01": $bulan="Januari"; break;
            case "02": $bulan="Februari"; break;
            case "03": $bulan="Maret"; break;
            case "04": $bulan="April"; break;
            case "05": $bulan="Mei"; break;
            case "06": $bulan="Juni"; break;
            case "07": $bulan="Juli"; break;
            case "08": $bulan="Agustus"; break;
            case "09": $bulan="September"; break;
            case "10": $bulan="Oktober"; break;
            case "11": $bulan="Nopember"; break;
            case "12": $bulan="Desember"; break;
            default  : $bulan="Tidak Boleh";
        }
        return $bulan;
    }

    function konversiTanggal($tanggal){
        list($thn,$bln,$tgl)=explode('-',$tanggal);
        $tmp = $tgl." ".konversiBulan($bln)." ".$thn;
        return $tmp;
    }

    function formatDuit($duit){
        return "Rp. ".number_format($duit,0,",",".").",-";
    }
        
    function formatDuit2($duit){
        return @number_format($duit,0,",",".")."";
    }
        
    function formatDec($duit){
        return round($duit);
    }
        
    function formatRound($duit){
        return str_replace(".",",",round($duit,5));
    }

    function JumlahBaris($result) {
        return mysqli_num_rows($result);
    }

    function getOne($sql) {
        $hasil=bukaquery($sql);
        list($result) =mysqli_fetch_array($hasil);
        return $result;
    }
    
    function getOne3($sql,$string) {
        $hasil=bukaquery($sql);
        list($result) =mysqli_fetch_array($hasil);
        if(empty($result)) $result=$string;
        return $result;
    }
    
    function fetch_array($result) {
        return mysqli_fetch_array($result);
    }

    function cekKosong($sql) {
        $jum = mysqli_num_rows($sql);
        if ($jum==0) return true;
        else return false;
    }
	
    function loadTgl(){
        echo "<option>-&nbsp</option>";
        for($tgl=1; $tgl<=31; $tgl++){
            $tgl_leng=strlen($tgl);
            if ($tgl_leng==1)
            $i="0".$tgl;
            else
            $i=$tgl;                        
            echo "<option value=$i>$i</option>";
        }
    }

    function loadTglnow(){
        $tglsekarang=date('d');
        echo "<option>".$tglsekarang."</option>";
        for($tgl=1; $tgl<=31; $tgl++){
            $tgl_leng=strlen($tgl);
            if ($tgl_leng==1)
            $i="0".$tgl;
            else
            $i=$tgl;                        
            echo "<option value=$i>$i</option>";
        }
    }


    function loadTgl2(){
        //echo "<option>-&nbsp</option>";
        for($tgl=1; $tgl<=31; $tgl++){
            $tgl_leng=strlen($tgl);
            if ($tgl_leng==1)
            $i="0".$tgl;
            else
            $i=$tgl;
            echo "<option value=$i>$i</option>";
        }
    }

    function loadBln(){
        echo "<option>-&nbsp</option>";
        for($bln=1; $bln<=12; $bln++){
            $bln_leng=strlen($bln);
            if ($bln_leng==1)
            $i="0".$bln;
            else
            $i=$bln;                        
            echo "<option value=$i>$i</option>";
        }
    }

    function loadBlnnow(){
        $blnsekarang=date('m');
        echo "<option>$blnsekarang</option>";
        for($bln=1; $bln<=12; $bln++){
            $bln_leng=strlen($bln);
            if ($bln_leng==1)
            $i="0".$bln;
            else
            $i=$bln;                        
            echo "<option value=$i>$i</option>";
        }
    }

    function loadBln2(){
        //echo "<option>-&nbsp</option>";
        for($bln=1; $bln<=12; $bln++){
            $bln_leng=strlen($bln);
            if ($bln_leng==1)
            $i="0".$bln;
            else
            $i=$bln;                        
            echo "<option value=$i>$i</option>";
        }
    }

    function loadThn(){
        $thnini=date('Y');
        echo "<option>-&nbsp</option>";
        for($thn=$thnini; $thn>=1960; $thn--){
            $thn_leng=strlen($thn);
            if ($thn_leng==1)
            $i="0".$thn;
            else
            $i=$thn;                        
            echo "<option value=$i>$i</option>";
        }
    }


    function loadThnnow(){
        $thnini=date('Y');
        //echo "<option>-&nbsp</option>";
        for($thn=$thnini; $thn>=1960; $thn--){
            $thn_leng=strlen($thn);
            if ($thn_leng==1)
            $i="0".$thn;
            else
            $i=$thn;                        
            echo "<option value=$i>$i</option>";
        }
    }

    function loadThn2(){
        $thnini=date('Y');
        echo "<option>-&nbsp</option>";
        for($thn=$thnini+30; $thn>=1960; $thn--){
                $thn_leng=strlen($thn);
                if ($thn_leng==1)
                $i="0".$thn;
                else
                $i=$thn;
                echo "<option value=$i>$i</option>";
        }
    }
    
    function loadThn3(){
        $thnini=date('Y');
        //echo "<option>-&nbsp</option>";
        for($thn=$thnini+30; $thn>=1960; $thn--){
                $thn_leng=strlen($thn);
                if ($thn_leng==1)
                $i="0".$thn;
                else
                $i=$thn;
                echo "<option value=$i>$i</option>";
        }
    }

    function loadThn4(){
        $thnini=date('Y');
        //echo "<option>-&nbsp</option>";
        for($thn=$thnini; $thn>=1960; $thn--){
            $thn_leng=strlen($thn);
            if ($thn_leng==1)
            $i="0".$thn;
            else
            $i=$thn;                        
            echo "<option value=$i>$i</option>";
        }
    }
    
    function loadThn5(){
        $thnini=date('Y');
        //echo "<option>-&nbsp</option>";
        for($thn=$thnini+15; $thn>=$thnini; $thn--){
                $thn_leng=strlen($thn);
                if ($thn_leng==1)
                $i="0".$thn;
                else
                $i=$thn;
                echo "<option value=$i>$i</option>";
        }
    }

    function loadJam(){
        //echo "<option selected>-----&nbsp</option>";
        for($jam=0; $jam<=23; $jam++){
            $jam_leng=strlen($jam);
            if ($jam_leng==1)
            $i="0".$jam;
            else
            $i=$jam;                        
            echo "<option value=$i>$i</option>";
        }
    }

    function loadMenit(){
        //echo "<option selected>-----&nbsp</option>";
        for($menit=0; $menit<=60; $menit++){
            $menit_leng=strlen($menit);
            if ($menit_leng==1)
            $i="0".$menit;
            else
            $i=$menit;                        
            echo "<option value=$i>$i</option>";
        }
    }

    function autonomer($table,$strawal,$pnj){
        $hasil        = bukaquery($table);
        $s            = mysqli_num_rows($hasil)+1;
        $j            = strlen($s);         
        $s1           = "";
        for($i=1;$i<=$pnj-$j;$i++){
            $s1=$s1+"0";
        }

        return $strawal."".$s1."".$s;
    }

    function validation_errors($error) {
        $errors = '<div class="alert bg-pink alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$error.'</div>';
        return $errors;
    }
    
    function encrypt_decrypt($string,$action){
        $secret_key     = 'Bar12345Bar12345'; 
        $secret_iv      = 'sayangsamakhanza';
        $output         = FALSE;
        $encrypt_method = "AES-256-CBC";
        $key            = hash('sha256', $secret_key);
        $iv             = substr(hash('sha256', $secret_iv), 0, 16);
 
        switch ($action){
             case "e":
                $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
                break;
             case "d":
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
                break;
        }
        
        return $output;
    }
    
    // function decrypt($input){
    //     $secret_key     = 'Bar12345Bar12345'; 
    //     $secret_iv      = 'sayangsamakhanza';
    //     return openssl_decrypt(base64_decode($input), 'AES-128-CBC', $secret_key, OPENSSL_RAW_DATA, $secret_iv);
    // }
    
    // function encrypt($input){
    //     $secret_key     = 'Bar12345Bar12345'; 
    //     $secret_iv      = 'sayangsamakhanza';
    //     return base64_encode(openssl_encrypt($input, 'AES-128-CBC', $secret_key, OPENSSL_RAW_DATA, $secret_iv));
    // }
    
    function Terbilang($x){
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
          return " " . $abil[$x];
        elseif ($x < 20)
          return Terbilang($x - 10) . "belas";
        elseif ($x < 100)
          return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
        elseif ($x < 200)
          return " seratus" . Terbilang($x - 100);
        elseif ($x < 1000)
          return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
        elseif ($x < 2000)
          return " seribu" . Terbilang($x - 1000);
        elseif ($x < 1000000)
          return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
        elseif ($x < 1000000000)
          return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
    }
        
?>
