<?php
  $nama_bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember', );

  // TANGGAL PRE CETAK
  if (count($data_pre_cetak) != 0) {    
    $tanggal_pc = substr($data_pre_cetak[0]->tanggal, 8,2);
    $bulan_pc = $nama_bulan[substr($data_pre_cetak[0]->tanggal, 5,2)] ;
    $tahun_pc = substr($data_pre_cetak[0]->tanggal, 0, 4);
    $tanggal_mantap_pc = $tanggal_pc . " " . $bulan_pc . " " . $tahun_pc;
    $empty_pc = FALSE;
  } else {
    $empty_pc = TRUE;
  }

  // TANGGAL CETAK
  if (count($data_cetak) != 0) {    
    $tanggal_c = substr($data_cetak[0]->tanggal, 8,2);
    $bulan_c = $nama_bulan[substr($data_cetak[0]->tanggal, 5,2)] ;
    $tahun_c = substr($data_cetak[0]->tanggal, 0, 4);
    $tanggal_mantap_c = $tanggal_c . " " . $bulan_c . " " . $tahun_c;
    $empty_c = FALSE;
  } else {
    $empty_c = TRUE;
  }

  // TANGGAL FINISHING
  if (count($data_finishing) != 0) {
    $tanggal_f = substr($data_finishing[0]->tanggal, 8,2);
    $bulan_f = $nama_bulan[substr($data_finishing[0]->tanggal, 5,2)] ;
    $tahun_f = substr($data_finishing[0]->tanggal, 0, 4);
    $tanggal_mantap_f = $tanggal_f . " " . $bulan_f . " " . $tahun_f;
    $empty_f = FALSE;
  } else {
    $empty_f = TRUE;
  }

?>
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">

			<ol class="breadcrumb" style="margin:0 10 0 0px; padding: 0px;">
        <li class="active">Monitoring</li>
      </ol>

			<div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>TABEL AKTIVITAS DIVISI</b></h4><br>

            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th width="30"><center>No.</center></th>
                  <th width="120"><center>Divisi</center></th>
                  <th width="100"><center>Tanggal</center></th>
                  <th width="180"><center>Koran</center></th>
                  <th width="100"><center>Sesi</center></th>
                  <th width="120"><center>Waktu Mulai</center></th>
                  <th width="120"><center>Waktu Selesai</center></th>
                  <th width="100"><center>Status</center></th>
                </tr>
              </thead>
              <tbody>
                <!-- PRE CETAK -->
                <tr>
                  <td><center>1</center></td>
                  <td><center>Pre Cetak</center></td>
                  <?php
                  if ($empty_pc) {
                  ?>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <?php
                  } else {
                  ?>
                  <td><center><?php echo $tanggal_mantap_pc; ?></center></td>
                  <td><center><?php echo $data_pre_cetak[0]->nama_koran; ?></center></td>
                  <td><center><?php echo $data_pre_cetak[0]->sesi; ?></center></td>
                  <td><center><?php echo substr($data_pre_cetak[0]->jam_masuk_pre_cetak, 0, 5); ?></center></td>
                  <td>
                    <center><?php echo substr($data_pre_cetak[0]->jam_selesai_pre_cetak, 0, 5); ?></center>
                  </td>
                  <td>
                    <center>
                      <span class="label label-<?php
                        switch($data_pre_cetak[0]->status){
                          case 'Selesai':
                            echo 'success';
                          break;
                          
                          case 'Proses':
                            echo 'primary';
                          break;

                          case 'Menunggu':
                            echo 'warning';
                          break;
                        }
                        ?>"><?php echo $data_pre_cetak[0]->status; ?>
                      </span>
                    </center>
                  </td>
                  <?php
                  }
                  ?>
                </tr>
                <!-- CETAK -->
                <tr>
                  <td><center>2</center></td>
                  <td><center>Cetak</center></td>
                  <?php
                  if ($empty_c) {
                  ?>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <?php
                  } else {
                  ?>
                  <td><center><?php echo $tanggal_mantap_c; ?></center></td>
                  <td><center><?php echo $data_cetak[0]->nama_koran; ?></center></td>
                  <td><center><?php echo $data_cetak[0]->sesi; ?></center></td>
                  <td><center><?php echo substr($data_cetak[0]->jam_masuk_cetak, 0, 5); ?></center></td>
                  <td><center><?php echo substr($data_cetak[0]->jam_selesai_cetak, 0, 5); ?></center></td>
                  <td><center><span class="label label-<?php
                    switch($data_cetak[0]->status){
                      case 'Selesai':
                        echo 'success';
                      break;
                      
                      case 'Proses':
                        echo 'primary';
                      break;

                      case 'Menunggu':
                        echo 'warning';
                      break;
                    }
                    ?>"><?php echo $data_cetak[0]->status; ?></span></center>
                  </td>
                  <?php
                  }
                  ?>                  
                </tr>
                <!-- FINISHING -->
                <tr>
                  <td><center>3</center></td>
                  <td><center>Finishing</center></td>
                  <?php
                  if ($empty_f) {
                  ?>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <td><center>-</center></td>
                  <?php
                  } else {
                  ?>
                  <td><center><?php echo $tanggal_mantap_f; ?></center></td>
                  <td><center><?php echo $data_finishing[0]->nama_koran; ?></center></td>
                  <td><center>1</center></td>
                  <td><center><?php echo substr($data_finishing[0]->jam_masuk_finishing, 0, 5); ?></center></td>
                  <td><center><?php echo substr($data_finishing[0]->jam_selesai_finishing, 0, 5); ?></center></td>
                  <td><center><span class="label label-<?php
                    switch($data_finishing[0]->status){
                      case 'Selesai':
                        echo 'success';
                      break;
                      
                      case 'Proses':
                        echo 'primary';
                      break;

                      case 'Menunggu':
                        echo 'warning';
                      break;
                    }
                    ?>"><?php echo $data_finishing[0]->status; ?></span></center>
                  </td>
                  <?php
                  }
                  ?>                  
                </tr>              	
              </tbody>
            </table>
          </div>
        </div>
      </div>

		</div> <!-- container -->
		
	</div> <!-- content -->

	<footer class="footer text-right">
		PT. Metro Grafindo 2018
	</footer>
</div>
<?php
	if ($this->session->flashdata('tambah_pengguna_1')) {
		echo "<script>alert('".$this->session->flashdata('tambah_pengguna_1')."');</script>";
	} else if ($this->session->flashdata('tambah_pengguna_0')) {
		echo "<script>alert('".$this->session->flashdata('tambah_pengguna_0')."');</script>";
	} else if ($this->session->flashdata('edit_pengguna_1')) {
		echo "<script>alert('".$this->session->flashdata('edit_pengguna_1')."');</script>";
	} else if ($this->session->flashdata('edit_pengguna_0')) {
		echo "<script>alert('".$this->session->flashdata('edit_pengguna_0')."');</script>";
	} else if ($this->session->flashdata('hapus_pengguna_1')) {
		echo "<script>alert('".$this->session->flashdata('hapus_pengguna_1')."');</script>";
	} else if ($this->session->flashdata('hapus_pengguna_0')) {
		echo "<script>alert('".$this->session->flashdata('hapus_pengguna_0')."');</script>";
	}
?>