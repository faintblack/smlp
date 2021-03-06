<?php
	$nama_bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
	$today = date('d'). ' ' .$nama_bulan[date('m')]. ' ' . date('Y');
?>
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
        <li class="active">Status</li>
      </ol>

			<div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>TABEL AKTIVITAS DIVISI PRE CETAK</b></h4><br>
            <button href="" onclick="setDate('<?php echo $today; ?>')" data-toggle="modal" data-target="#tambah-aktivitas" style="margin-bottom: 15px; font-size: 14px; font-weight: 550" class="btn btn-primary waves-effect waves-light"> <i style="font-size: 16px;" class="md-person-add m-r-5"></i> <span>Tambah Aktivitas</span> </button>

            <!-- TAMBAH AKTIVITAS -->
				      <div id="tambah-aktivitas" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				      	<?php 
				      	$attribute = array('data-parsley-validate' => '', 'novalidate' => '', 'role' => 'form');
				      	echo form_open('precetakcontroller/tambahproses'); ?>
				      		<div class="modal-dialog"> 
					          <div class="modal-content"> 
					            <div class="modal-header"> 
					              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					              <h4 class="modal-title"><strong>Tambah Aktivitas Pre Cetak</strong> </h4> 
					            </div> 
					            <div class="modal-body">
					            	<input type="hidden" name="user" value="<?php echo $this->session->userdata('username'); ?>">
					            	<!-- TANGGAL -->
					            	<div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 10px;"> 
					                  <div class="form-group">
															<label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px;">Tanggal</label>
															<div class="col-md-10" style="padding: 0px;">
																<div class="input-group">
																	<input name="tanggal" type="text" class="form-control" placeholder="Tanggal Aktivitas" id="datepicker-autoclose" disabled>
																	<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
																</div>
															</div>
														</div>
					                </div> 
					              </div>
					              <!-- NAMA KORAN DAN SESI -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Nama Koran</label> 
					                    <input name="nama_koran" type="text" class="form-control"  placeholder="Contoh : Metro Riau" required autofocus> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Sesi</label> 
					                    <input name="sesi" type="number" class="form-control"  placeholder="Sesi ke-" required> 
					                  </div> 
					                </div> 
					              </div>
					              <!-- SUMBER BERITA DAN PENERIMA BERITA -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label for="field-1" class="control-label">Sumber Berita</label> 
					                    <input name="sumber_berita" id="sumber_berita" type="text" class="form-control"  placeholder="Contoh : Nasional, Olahraga, dsb" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label for="field-2" class="control-label">Penerima Berita</label> 
					                    <input name="penerima_berita"  type="text" class="form-control" placeholder="Contoh : Anto, Rizki, dsb" required> 
					                  </div> 
					                </div> 
					              </div>
					              <!-- STATUS -->
					            	<div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 10px;">
															<label class="control-label col-md-2" style="padding: 7px 0 0 0">Status</label>
															<div class="col-md-10" style="padding: 0px;">
																<select name="status" class="selectpicker"  data-style="btn-white btn-white" required>
					                    	<option value="" disabled selected>Pilih Status Aktivitas</option>
																<option value="Menunggu">Menunggu</option>
																<option value="Proses">Proses</option>
															</select> 
															</div>
					                </div> 
					              </div>
					            </div> 
					            <div class="modal-footer">
					              <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light" data-dismiss="modal">
						            	<span class="btn-label"><i class="fa fa-times"></i>
						            	</span>Batal</button> 
					              <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light">
						               <span class="btn-label"><i class="fa fa-check"></i></span>
						               Simpan
						            </button>
					            </div> 
					          </div> 
					        </div>
				      	<?php echo form_close(); ?>
				      </div>

			      <!-- EDIT PROSES -->
				     	<div id="edit-proses" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				      	<?php 
				      	$attribute = array('data-parsley-validate' => '', 'novalidate' => '', 'role' => 'form');
				      	echo form_open('precetakcontroller/editproses'); ?>
				      		<div class="modal-dialog"> 
					          <div class="modal-content"> 
					            <div class="modal-header"> 
					              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					              <h4 class="modal-title"><strong>Edit Proses Pre Cetak</strong> </h4> 
					            </div> 
					            <div class="modal-body">
					            	<input type="hidden" name="user" value="<?php echo $this->session->userdata('username'); ?>">
					            	<input type="hidden" name="id_pre_cetak" id="id_pre_cetak">
					            	<input type="hidden" name="id_percetakan" id="id_percetakan">
					            	<!-- TANGGAL -->
					            	<div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 10px;"> 
					                  <div class="form-group">
															<label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px;">Tanggal</label>
															<div class="col-md-10" style="padding: 0px;">
																<div class="input-group">
																	<input type="hidden" id="tanggal-old" name="tanggal-old">
																	<input type="hidden" id="tanggal" name="tanggal">
																	<input name="tanggal" type="text" class="form-control" placeholder="Tanggal aktivitas" id="datepicker" disabled>
																	<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
																</div>
															</div>
														</div>
					                </div> 
					              </div>
					              <!-- NAMA KORAN DAN SESI -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Nama Koran</label> 
					                    <input type="hidden" id="nama_koran-old" name="nama_koran-old">
					                    <input id="nama_koran-edit" name="nama_koran" type="text" class="form-control"  placeholder="Contoh : Metro Riau" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Sesi</label>
					                    <input type="hidden" id="sesi-old" name="sesi-old">
					                    <input id="sesi-edit" name="sesi" type="number" class="form-control"  placeholder="Sesi ke-" required> 
					                  </div> 
					                </div> 
					              </div>
					              <!-- SUMBER BERITA DAN PENERIMA BERITA -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label for="field-1" class="control-label">Sumber Berita</label> 
					                    <input name="sumber_berita" id="sumber_berita-edit" type="text" class="form-control"  placeholder="Contoh : Nasional, Olahraga, dsb" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label for="field-2" class="control-label">Penerima Berita</label> 
					                    <input name="penerima_berita" id="penerima_berita-edit" type="text" class="form-control" placeholder="Contoh : Anto, Rizki, dsb" required> 
					                  </div> 
					                </div> 
					              </div>
					              <!-- WAKTU MULAI DAN WAKTU SELESAI -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label class="control-label">Waktu Mulai</label> 
					                    <div class="input-group clockpicker " data-placement="top" data-align="top" >
																<input name="waktu_mulai" id="waktu_mulai-edit" type="text" class="form-control" placeholder="Waktu Mulai Pekerjaan" disabled>
																<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
															</div>
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label data-placement="top" class="control-label">Waktu Selesai</label> 
					                    <div class="input-group clockpicker " data-placement="top" data-align="top" >
																<input name="waktu_selesai" id="waktu_selesai-edit" type="text" class="form-control" placeholder="Waktu Mulai Pekerjaan" disabled >
																<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
															</div>
					                  </div> 
					                </div> 
					              </div>
					              <!-- STATUS -->
					            	<div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 10px;">
															<label class="control-label col-md-2" style="padding: 7px 0 0 0">Status</label>
															<div class="col-md-4" style="padding: 0px;">
																<select name="status" id="status-edit" class="form-control select2 select2-hidden-accessible"  data-style="btn-white btn-white" required>
																	<option id="Menunggu" value="Menunggu">Menunggu</option>
																	<option id="Proses" value="Proses" >Proses</option>
																	<option id="Selesai" value="Selesai">Selesai</option>
																</select> 
															</div>
					                </div> 
					              </div>
					            </div> 
					            <div class="modal-footer">
					              <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light" data-dismiss="modal">
						            	<span class="btn-label"><i class="fa fa-times"></i>
						            	</span>Batal</button> 
					              <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light">
						               <span class="btn-label"><i class="fa fa-check"></i></span>
						               Simpan
						            </button>
					            </div> 
					          </div> 
					        </div>
				      	<?php echo form_close(); ?>
				      </div>
				  
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                	<th style="width: 10px; max-width: 10px !important;"><center>No.</center></th>
                  <th width="180"><center>Tanggal</center></th>
                  <th width="250"><center>Koran</center></th>
                  <th width="50"><center>Sesi</center></th>
                  <th width="120"><center>Sumber Berita</center></th>
                  <th width="180"><center>Penerima Berita</center></th>
                  <th width="120"><center>Waktu Mulai</center></th>
                  <th width="120"><center>Waktu Selesai</center></th>
                  <th width="100"><center>Status</center></th>
                  <th width="80"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
              	<?php
              	$no = 1;
              	$nama_bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
              	foreach ($data_pre_cetak as $v) {
              		$tanggal = substr($v->tanggal, 8,2);
									$bulan = $nama_bulan[substr($v->tanggal, 5,2)] ;
									$tahun = substr($v->tanggal, 0,4);
									$waktu_mulai = substr($v->jam_masuk_pre_cetak, 0,5);
									$waktu_selesai = substr($v->jam_selesai_pre_cetak, 0,5);
									$tanggal_mantap = $tanggal . " " . $bulan . " " . $tahun;
              	?>
              	<tr>
                  <td><center><?php echo $no; ?></center></td>
                  <td><center><?php echo $tanggal_mantap; ?></center></td>
                  <td><center><?php echo $v->nama_koran; ?></center></td>
                  <td><center><?php echo $v->sesi; ?></center></td>
                  <td><center><?php echo $v->sumber_berita; ?></center></td>
                  <td><center><?php echo $v->penerima_berita; ?></center></td>
                  <td><center><?php if ($v->status == 'Menunggu') {
                  	echo "-";
                  } else { echo $waktu_mulai; }  ?></center></td>
                  <td><center><?php if ($v->status != 'Selesai') {
                  	echo "-";
                  } else { echo $waktu_selesai; }  ?></center></td>
                  <td>
                  	<center>
											<?php
											switch ($v->status) {
												case 'Selesai':
											?>
													<span class="label label-success">Selesai</span>
											<?php
												break;

												case 'Proses':
											?>
													<span class="label label-primary">Proses</span>
											<?php
												break;
												
												case 'Menunggu':
											?>
													<span class="label label-warning">Menunggu</span>
											<?php
												break;
											}
											?>
                  	</center>
                  </td>
                  <td>
                  	<center>
                  	<a href="" title="Edit Aktivitas" onclick="setId('<?php echo $v->id_pre_cetak; ?>', '<?php echo $v->id_percetakan; ?>', '<?php echo $v->tanggal; ?>','<?php echo $v->nama_koran; ?>','<?php echo $v->sesi; ?>','<?php echo $v->jam_masuk_pre_cetak; ?>','<?php echo $v->jam_selesai_pre_cetak; ?>','<?php echo $v->sumber_berita; ?>','<?php echo $v->penerima_berita; ?>','<?php echo $v->status; ?>','<?php echo substr($v->tanggal,8,2).' '.$nama_bulan[substr($v->tanggal, 5,2)].' '.substr($v->tanggal,0,4); ?>')" data-toggle="modal" data-target="#edit-proses"><i style="font-size: 20px;" class=" md-create"></i></a>
                  	<!--
                  		&nbsp;&nbsp;&nbsp;
                  	<a title="Hapus Aktivitas" href="" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengguna atas nama  ?')"><i style="font-size: 20px;" class="ion-trash-a"></i></a>-->
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
	function setId($id, $id_percetakan , $tanggal, $nama_koran, $sesi, $waktu_mulai, $waktu_selesai, $sumber_berita, $penerima_berita, $status, $placeholder){
		var tgl = $tanggal.substr(5,2) + '/' + $tanggal.substr(8,2) + '/' + $tanggal.substr(0,4);
		
		document.getElementById('id_pre_cetak').value = $id;
		document.getElementById('id_percetakan').value = $id_percetakan;
		document.getElementById('tanggal').value = tgl;
		document.getElementById('datepicker').setAttribute('placeholder', $placeholder);
		document.getElementById('tanggal-old').value = tgl;
		document.getElementById('nama_koran-old').value = $nama_koran;
		document.getElementById('nama_koran-edit').value = $nama_koran;
		document.getElementById('sesi-old').value = $sesi;
		document.getElementById('sesi-edit').value = $sesi;	
		document.getElementById('sumber_berita-edit').value = $sumber_berita;
		document.getElementById('penerima_berita-edit').value = $penerima_berita;
				
		if ($status == 'Menunggu') {
			document.getElementById('waktu_mulai-edit').value = '-';
			document.getElementById('waktu_selesai-edit').value = '-';
		} else if ($status == 'Proses') {
			document.getElementById('waktu_mulai-edit').value = $waktu_mulai.substr(0, 5);
			document.getElementById('waktu_selesai-edit').value = '-';
		} else if ($status == 'Selesai') {
			document.getElementById('waktu_mulai-edit').value = $waktu_mulai.substr(0, 5);
			document.getElementById('waktu_selesai-edit').value = $waktu_selesai.substr(0, 5);
		}

		var status = document.getElementById('status-edit');
		
		for(var i = 0; i < status.options.length; i++){
			if (status.options[i].value == $status) {
				switch(status.options[i].value){
					case 'Menunggu':
						document.getElementById('Menunggu').setAttribute('selected','');
						document.getElementById('Proses').removeAttribute('selected'); 
						document.getElementById('Selesai').removeAttribute('selected');
						status.getElementsByTagName("option")[0].disabled = false;
						status.getElementsByTagName("option")[1].disabled = false;
						status.getElementsByTagName("option")[2].disabled = true;
					break;

					case 'Proses':
						document.getElementById('Proses').setAttribute('selected','');
						document.getElementById('Menunggu').removeAttribute('selected'); 
						document.getElementById('Selesai').removeAttribute('selected');
						status.getElementsByTagName("option")[0].disabled = true;
						status.getElementsByTagName("option")[1].disabled = false;
						status.getElementsByTagName("option")[2].disabled = false;
					break;

					case 'Selesai':
						document.getElementById('Selesai').setAttribute('selected','');
						document.getElementById('Proses').removeAttribute('selected'); 
						document.getElementById('Menunggu').removeAttribute('selected'); 
						status.getElementsByTagName("option")[0].disabled = true;
						status.getElementsByTagName("option")[1].disabled = true;
						status.getElementsByTagName("option")[2].disabled = false;
					break;
				}
			}
		}
	}

	function setDate($tanggal){
		document.getElementById('datepicker-autoclose').setAttribute('placeholder', $tanggal);
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
	} else if ($this->session->flashdata('edit_pre_cetak_3')) {
		echo "<script>alert('".$this->session->flashdata('edit_pre_cetak_3')."');</script>";
	}
?>