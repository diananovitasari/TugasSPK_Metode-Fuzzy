<div class="art-post">
<div class="art-post-body">
<div class="art-post-inner art-article">
<h2 class="art-postheader">Daftar Penyakit</h2>
<div class="art-postcontent">
<table width="95%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#22B5DD">
  <tr bgcolor="#0099FF"> 
    <td width="23" ><b>No</b></td>
    <td width="244" ><strong>Deskripsi  Penyakit</strong></td>
  </tr>
  <?php 
	$sql = "SELECT * FROM penyakit_solusi ORDER BY kd_penyakit";
	$qry = mysqli_query($sql, $koneksi) or die ("SQL Error".mysqli_error());
	$no=0;
	while ($data=mysqli_fetch_array($qry)) {
	$no++;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td><div align="center"><?php echo $no; ?></div> </td>
    <td><div align="left">
      <div align="left"><?php echo "<h3><em>$data[nama_penyakit]</em></h3>"; ?></div>
      <ul>
      	<li><label>Definisi Penyakit :</label><p><?php echo "$data[definisi]";?></p></li>
        <li><label>Solusi :</label><p><?php echo "$data[solusi]";?></p>
    </div></li>
      </ul>
      
      </td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
                <div class="cleared"></div>
                </div>

		<div class="cleared"></div>
    </div>
</div>