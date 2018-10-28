<style type="text/css">
	.btn{
		font-weight: bold;
	}
	.table-responsive{
		overflow-x: visible;
	}
</style>

<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">

			<ol class="breadcrumb" style="margin:0 10 0 0px; padding: 0px;">
        <li class="active">Laporan</li>
      </ol>

			<div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>TABEL LAPORAN DIVISI CETAK</b></h4><br>

            <!-- DETAIL LAPORAN -->
	            <?php
	            $nama_bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember', );
	            $nama_hari = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => "Jum'at", 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');
	            foreach ($data_percetakan as $v) {
	            	$tanggal = substr($v->tanggal, 8,2);
								$bulan = $nama_bulan[substr($v->tanggal, 5,2)] ;
								$tahun = substr($v->tanggal, 0,4);
								$hari = $nama_hari[date('l', strtotime($v->tanggal))]; 

								$tanggal_mantap = $tanggal . " " . $bulan . " " . $tahun;
	            ?>
		            <div id="detail-cetak-<?php echo $v->id_percetakan; ?>" class="modal fade bs-example-modal-lg-<?php echo $v->id_percetakan; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
		              <div class="modal-dialog modal-lg">
		                <div class="modal-content">
		                  <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		                    <h4 class="modal-title" id="myLargeModalLabel"><b>Laporan Divisi Cetak</b></h4>
		                  </div>
		                  <div class="modal-body">
		                    <!-- HARI -->
					            	<div class="row"> 
					                <div class="col-md-12"> 
					                  <div class="form-group">
															<label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px">Hari</label>
															<label class="control-label col-md-5" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $hari; ?></label>
														</div>
					                </div> 
					              </div>
					              <!-- TANGGAL -->
					            	<div class="row"> 
					                <div class="col-md-12"> 
					                  <div class="form-group">
															<label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Tanggal</label>
															<label class="control-label col-md-10" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $tanggal_mantap; ?></label>
														</div>
					                </div> 
					              </div>
					              <!-- NAMA KORAN -->
					            	<div class="row" style="margin-bottom: 10px;"> 
					                <div class="col-md-12"> 
					                  <div class="form-group">
															<label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Nama Koran</label>
															<label class="control-label col-md-10" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $v->nama_koran; ?></label>
														</div>
					                </div> 
					              </div>
					              <!-- RINCIAN -->
					              <div class="row"> 
					                <div class="col-md-12"> 
					                  <div class="form-group">
															<label class="control-label col-md-3" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Rincian Laporan</label>
														</div>
					                </div> 
					              </div>
					              <!-- TABEL -->
					              <div class="row"> 
					                <div class="col-md-12"> 
														<div class="table-responsive">
															<table class="table m-0">
																<thead>
																	<tr>
																		<th><center>No.</center></th>
																		<th><center>Sesi</center></th>
																		<th><center>Waktu Mulai</center></th>
																		<th><center>Waktu Selesai</center></th>
																		<th><center>Jumlah Cetak</center></th>
																		<th><center>Status</center></th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$no = 1;
																	foreach ($data_cetak as $x) {
																		if ($v->id_percetakan == $x->id_percetakan) {
																			$empty_c = FALSE;
																			$waktu_mulai = substr($x->jam_masuk_cetak, 0, 5);
																			$waktu_selesai = substr($x->jam_selesai_cetak, 0, 5);
																	?>
																	<tr>
																		<th scope="row"><center><?php echo $no; ?></center></th>
																		<td><center><?php echo $x->sesi; ?></center></td>
																		<td><center><?php if ($x->status == 'Menunggu') {
																			echo "-";
																		} else { echo $waktu_mulai; } ?></center></td>
																		<td><center><?php if ($x->status != 'Selesai') {
																			echo "-";
																		} else { echo $waktu_selesai; }  ?></center></td>
																		<td><center><?php echo $x->jumlah_cetak; ?></center></td>
																		<td><center><?php echo $x->status; ?></center></td>
																	</tr>
																	<?php
																		$no++;
																		}									
																	}

																	if (!isset($empty_c)) {
																	?>
																	<tr>
																		<th colspan="6"><center>Belum ada data aktivitas divisi cetak</center></th>
																	</tr>
																	<?php
																	}
																	?>
																</tbody>
															</table>
														</div>
					                </div> 
					              </div>
		                  </div>
		                </div>
		              </div>
		            </div>
	            <?php
	            $empty_c = null;
	            }
	            ?>

	          <!-- TABEL LAPORAN -->
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                	<th style="width: 10px !important; max-width: 10px !important;"><center>No.</center></th>
                  <th width="80"><center>Tanggal</center></th>
                  <th width="250"><center>Koran</center></th>
                  <th width="30"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
              	<?php
              	$no = 1;
              	$nama_bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember', );
              	foreach ($data_cetak as $v) {
              		$tanggal = substr($v->tanggal, 8,2);
									$bulan = $nama_bulan[substr($v->tanggal, 5,2)] ;
									$tahun = substr($v->tanggal, 0,4);
									$tanggal_mantap = $tanggal . " " . $bulan . " " . $tahun;
              	?>
              	<tr>
                  <td><center><?php echo $no; ?></center></td>
                  <td><center><?php echo $tanggal_mantap; ?></center></td>
                  <td><center><?php echo $v->nama_koran; ?></center></td>
                  <td>
                  	<center>
                  	<a href="" title="Detail Laporan" data-toggle="modal" data-target=".bs-example-modal-lg-<?php echo $v->id_percetakan; ?>"><i style="font-size: 20px;" class=" md-remove-red-eye"></i></a>
                  		&nbsp;&nbsp;&nbsp;
                  	<a title="Cetak Laporan" href="" onclick="printCetak('<?php echo $v->id_percetakan; ?>')"><i style="font-size: 20px;" class="md-print"></i></a>
                  	</center>
                  </td>
                </tr>
              	<?php
              	$no++;
              	}
              	?>
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
<script type="text/javascript">
	function setId($id, $tanggal, $nama_koran, $sesi, $waktu_mulai, $waktu_selesai, $sumber_berita, $penerima_berita, $status){
		var tgl = $tanggal.substr(5,2) + '/' + $tanggal.substr(8,2) + '/' + $tanggal.substr(0,4);
		
		document.getElementById('id_cetak').value = $id;
		document.getElementById('datepicker').value = tgl;
		document.getElementById('nama_koran-edit').value = $nama_koran;
		document.getElementById('sesi-edit').value = $sesi;
		document.getElementById('waktu_mulai-edit').value = $waktu_mulai.substr(0, 5);
		document.getElementById('waktu_selesai-edit').value = $waktu_selesai.substr(0, 5);
		document.getElementById('sumber_berita-edit').value = $sumber_berita;
		document.getElementById('penerima_berita-edit').value = $penerima_berita;
		
		var status = document.getElementById('status-edit');
		
		for(var i = 0; i < status.options.length; i++){
			if (status.options[i].value == $status) {
				switch(status.options[i].value){
					case 'Menunggu':
						document.getElementById('Menunggu').setAttribute('selected','');
					break;

					case 'Proses':
						document.getElementById('Proses').setAttribute('selected','');
					break;

					case 'Selesai':
						document.getElementById('Selesai').setAttribute('selected','');
					break;
				}
			}
		}
	}
</script>

<?php
	if ($this->session->flashdata('tambah_precetak_1')) {
		echo "<script>alert('".$this->session->flashdata('tambah_precetak_1')."');</script>";
	} else if ($this->session->flashdata('tambah_precetak_0')) {
		echo "<script>alert('".$this->session->flashdata('tambah_precetak_0')."');</script>";
	} else if ($this->session->flashdata('edit_pre_cetak_1')) {
		echo "<script>alert('".$this->session->flashdata('edit_pre_cetak_1')."');</script>";
	} else if ($this->session->flashdata('edit_pre_cetak_0')) {
		echo "<script>alert('".$this->session->flashdata('edit_pre_cetak_0')."');</script>";
	} else if ($this->session->flashdata('tambah_precetak_2')) {
		echo "<script>alert('".$this->session->flashdata('tambah_precetak_2')."');</script>";
	} else if ($this->session->flashdata('edit_pre_cetak_2')) {
		echo "<script>alert('".$this->session->flashdata('edit_pre_cetak_2')."');</script>";
	}
?>