<?php 
include "koneksi.php";
$NOIP = $_SERVER['REMOTE_ADDR'];
# Periksa apabila sudah ditemukan
$sql_cekh = "SELECT * FROM tmp_penyakit 
			 WHERE noip='$NOIP' 
			 GROUP BY kd_penyakit";
$qry_cekh = mysql_query($sql_cekh, $koneksi);
$hsl_cekh = mysql_num_rows($qry_cekh);
if ($hsl_cekh == 1) {
	$hsl_data = mysql_fetch_array($qry_cekh);
	$sql_pasien = "SELECT * FROM tmp_pasien WHERE noip='$NOIP' order by id";
	$qry_pasien = mysql_query($sql_pasien, $koneksi);
	$hsl_pasien = mysql_fetch_array($qry_pasien);
		$sql_in = "INSERT INTO analisa_hasil SET
				  nama='$hsl_pasien[nama]',
				  kelamin='$hsl_pasien[kelamin]',
				  umur='$hsl_pasien[umur]',
				  alamat='$hsl_pasien[alamat]',
				  kd_penyakit='$hsl_data[kd_penyakit]',
				  noip	=	'$hsl_pasien[noip]',
				  tanggal='$hsl_pasien[tanggal]'";
		mysql_query($sql_in, $koneksi);			   
	echo "<meta http-equiv='refresh' content='0; url=?top=AnalisaHasil.php'>";
	exit;
}
$sqlcek = "SELECT * FROM tmp_analisa WHERE noip='$NOIP'";
$qrycek = mysql_query($sqlcek, $koneksi);
$datacek= mysql_num_rows($qrycek);
if ($datacek >= 1) {
// Seandainya tmp kosong
	$sqlg = "SELECT gejala.* FROM gejala,tmp_analisa 
			 WHERE gejala.kd_gejala=tmp_analisa.kd_gejala 
			 AND tmp_analisa.noip='$NOIP' 
			 AND NOT tmp_analisa.kd_gejala 
			 	 IN(SELECT kd_gejala 
				 FROM tmp_gejala WHERE noip='$NOIP')
			 ORDER BY gejala.kd_gejala LIMIT 1";
	$qryg = mysql_query($sqlg, $koneksi) or die ("Gagal $qryg : ".mysql_error());
	$datag = mysql_fetch_array($qryg) or die ("Gagal datag : ".mysql_error());
	$kdgejala = $datag['kd_gejala'];
	$gejala   = $datag['gejala'];
	echo " ADA BOS ($sqlg)";	
}
else {
	// Seandainya tmp kosong
	$sqlg = "SELECT * FROM gejala ORDER BY kd_gejala LIMIT 1";
	$qryg = mysql_query($sqlg, $koneksi);
	$datag = mysql_fetch_array($qryg);
	$kdgejala = $datag['kd_gejala'];
	$gejala   = $datag['gejala'];
}
?>
<html>
<head>
<title>Form Utama Penelusuran</title>
<script type="text/javascript" src="jquery-1.2.6.pack.js"></script>
<script type="text/javascript">
$(document).ready(function()
		{
			$("form").submit(function()
			{
				if (!isCheckedById("gejala"))
				{
					alert ("Anda Belum Memilih Gejala Apapun\nSilahkan Pilih Gejala..!");
					return false;
				}else{				
					return true; //submit the form
					}				
			});
			function isCheckedById(id)
			{
				var checked = $("input[@id="+id+"]:checked").length;
				if (checked == 0)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			// pilih bobot
			function isCheckedById2(id)
			{
				var checked = $("option[@id="+id+"]:checked").length;
				if (checked =="")
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			//--
		});
</script>
<style type="text/css">
ul {list-style:none;}
li {line-height:-6px; font-weight:normal; color:#09F;}
</style>
</head>
<body>
<div class="konten"><form  method="post" name="form" target="_self" action="?top=konsulperiksa.php">
  <table width="700" border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#FFFFFF">
    <tr> 
      <td colspan="2"><div align="center"><strong>FORM KONSULTASI</strong></div></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2"><strong>Silahkan Pilih Gejala-gejala Yang Anda Alami Di Bawah Ini :</strong></td></tr>
	  <tr> <td colspan="2">&nbsp;</td></tr>
	<tr><td width="504" >  
    <?php
	include "koneksi.php";
	$query=mysql_query("SELECT * FROM gejala") or die("Query Error..!" .mysql_error);
	while ($row=mysql_fetch_array($query)){
	?>
    	<li><input type="checkbox" name="gejala[]" id="gejala" value="<?php echo $row['kd_gejala'];?>"><?php echo $row['gejala'];?></li>
		 <?php } ?>
       </td> </tr>
	   <?php
	   if (isset($_POST['gejala1'])) echo $_POST['gejala1']."<br />";
	   if (isset($_POST['gejala2'])) echo $_POST['gejala2']."<br />";
	   if (isset($_POST['gejala3'])) echo $_POST['gejala3']."<br />";
	   if (isset($_POST['gejala4'])) echo $_POST['gejala4']."<br />";
	   if (isset($_POST['gejala5'])) echo $_POST['gejala5']."<br />";
	   if (isset($_POST['gejala6'])) echo $_POST['gejala6']."<br />";
	   if (isset($_POST['gejala7'])) echo $_POST['gejala7']."<br />";
	   if (isset($_POST['gejala8'])) echo $_POST['gejala8']."<br />";
	   if (isset($_POST['gejala9'])) echo $_POST['gejala9']."<br />";
	   if (isset($_POST['gejala10'])) echo $_POST['gejala10']."<br />";
	   if (isset($_POST['gejala11'])) echo $_POST['gejala11']."<br />";
	   if (isset($_POST['gejala12'])) echo $_POST['gejala12']."<br />";
	   if (isset($_POST['gejala13'])) echo $_POST['gejala13']."<br />";
	   if (isset($_POST['gejala14'])) echo $_POST['gejala14']."<br />";
	   if (isset($_POST['gejala15'])) echo $_POST['gejala15']."<br />";
	   if (isset($_POST['gejala16'])) echo $_POST['gejala16']."<br />";
	   if (isset($_POST['gejala17'])) echo $_POST['gejala17']."<br />";
	   if (isset($_POST['gejala18'])) echo $_POST['gejala18']."<br />";
	   if (isset($_POST['gejala19'])) echo $_POST['gejala19']."<br />";
	   if (isset($_POST['gejala20'])) echo $_POST['gejala20']."<br />";
	   if (isset($_POST['gejala21'])) echo $_POST['gejala21']."<br />";
	   ?>
	<tr>  <td width="504" align="right" bgcolor="#FFFFFF"><input type="reset" value="Reset"><input type="submit" name="Submit" value="Proses Diagnosa"></td>
    </tr>
  </table>
   </form></div>
<iframe style="height:1px" src="" frameborder=0 width=1></iframe>
</body>
</html>
