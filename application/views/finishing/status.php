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
            <h4 class="m-t-0 header-title"><b>TABEL AKTIVITAS DIVISI FINISHING</b></h4><br>
            <button href="" data-toggle="modal" data-target="#tambah-proses" style="margin-bottom: 15px; font-size: 14px; font-weight: 550" class="btn btn-primary waves-effect waves-light"> <i style="font-size: 16px;" class="md-person-add m-r-5"></i> <span>Tambah Aktivitas</span> </button>

            <!-- TAMBAH AKTIVITAS -->
				      <div id="tambah-proses" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				      	<?php 
				      	$attribute = array('data-parsley-validate' => '', 'novalidate' => '', 'role' => 'form');
				      	echo form_open('finishingcontroller/tambahproses'); ?>
				      		<div class="modal-dialog"> 
					          <div class="modal-content"> 
					            <div class="modal-header"> 
					              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					              <h4 class="modal-title"><strong>Tambah Aktivitas Finishing</strong> </h4> 
					            </div> 
					            <div class="modal-body">
					            	<input type="hidden" name="user" value="<?php echo $this->session->userdata('username'); ?>">
					            	<!-- TANGGAL -->
					            	<div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 15px;"> 
					                  <div class="form-group">
															<label class="control-label col-md-3" style="padding-top: 7px; padding-left: 0px;">Tanggal</label>
															<div class="col-md-9">
																<div class="input-group">
																	<input name="tanggal" type="text" class="form-control" placeholder="<?php echo $today; ?>" id="datepicker-autoclose" disabled>
																	<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
																</div>
															</div>
														</div>
					                </div> 
					              </div>
					              <!-- NAMA KORAN  -->
					              <div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 15px;"> 
					                  <div class="form-group"> 
					                    <label class="control-label col-md-3" style="padding-top: 7px; padding-left: 0px;">Nama Koran</label>
					                    <div class="col-md-9">
					                    	<select name="nama_koran" class="selectpicker" data-style="btn-white btn-white" required>
						                    	<option value="" disabled selected>Pilih Koran</option>
						                    	<?php
						                    	foreach ($data_cetak as $v) {
						                    		if ($v->tanggal == date('Y-m-d')) {
						                    	?>
						                    	<option value="<?php echo $v->nama_koran; ?>"><?php echo $v->nama_koran; ?></option>
						                    	<?php
						                    		}
						                    	}
						                    	?>																	
																</select> 
					                    </div>
					                    
					                  </div> 
					                </div>
					              </div>
					              <!-- JUMLAH EDARAN DAN STATUS -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Jumlah Edaran</label> 
					                    <input name="jumlah_edaran" type="text" class="form-control"  placeholder="Contoh : 500" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Status</label>
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

			      <!-- EDIT AKTIVITAS -->
			      	<?php
			      	foreach ($data_finishing as $v) {
			      		$tgl = substr($v->tanggal,8,2).' '.$nama_bulan[substr($v->tanggal,5,2)].' '.substr($v->tanggal,0,4);
			      	?>
			      	<div id="edit-proses-<?php echo $v->id_finishing; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				      	<?php 
				      	$attribute = array('data-parsley-validate' => '', 'novalidate' => '', 'role' => 'form');
				      	echo form_open('finishingcontroller/editproses'); ?>
				      		<div class="modal-dialog"> 
					          <div class="modal-content"> 
					            <div class="modal-header"> 
					              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					              <h4 class="modal-title"><strong>Edit Aktivitas Finishing</strong> </h4> 
					            </div> 
					            <div class="modal-body">
					            	<input type="hidden" name="id_finishing" id="id_finishing">
					            	<!-- TANGGAL -->
					            	<div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 10px;"> 
					                  <div class="form-group">
															<label class="control-label col-md-3" style="padding-top: 7px; padding-left: 0px;">Tanggal</label>
															<div class="col-md-9">
																<div class="input-group">
																	<input id="tanggal-old" type="hidden" name="tanggal-old">
																	<input name="tanggal" type="text" class="form-control" placeholder="Tanggal aktivitas" id="datepicker" required>
																	<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
																</div>
															</div>
														</div>
					                </div> 
					              </div>
					              <!-- NAMA KORAN  -->
					              <div class="row"> 
					                <div class="col-md-12" style="padding-bottom: 10px;"> 
					                  <div class="form-group"> 
					                    <label class="control-label col-md-3" style="padding-top: 7px; padding-left: 0px;">Nama Koran</label>
					                    <div class="col-md-9">
					                    	<input id="nama_koran-old" type="hidden" name="nama_koran-old">
																<input id="nama_koran-edit" name="nama_koran" type="text" class="form-control"  placeholder="Contoh : Metro Riau" required> 
					                    </div>
					                  </div> 
					                </div>
					              </div>
					              <!-- WAKTU MULAI DAN WAKTU SELESAI -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label class="control-label">Waktu Mulai</label> 
					                    <div class="input-group clockpicker " data-placement="top" data-align="top" >
																<input id="waktu_mulai-edit" name="waktu_mulai" type="text" class="form-control" placeholder="Waktu Mulai Pekerjaan" required>
																<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
															</div>
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label data-placement="top" class="control-label">Waktu Selesai</label> 
					                    <div class="input-group clockpicker " data-placement="top" data-align="top" >
																<input id="waktu_selesai-edit" name="waktu_selesai" type="text" class="form-control" placeholder="Waktu Mulai Pekerjaan" required >
																<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
															</div>
					                  </div> 
					                </div> 
					              </div>
					              <!-- JUMLAH EDARAN DAN STATUS -->
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Jumlah Edaran</label> 
					                    <input id="jumlah_edaran-edit" name="jumlah_edaran" type="text" class="form-control"  placeholder="Contoh : 500" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Status</label>
																<select id="status-edit" name="status" class="form-control select2 select2-hidden-accessible"  data-style="btn-white btn-white" required>
						                    	<option value="" disabled selected>Pilih Status Aktivitas</option>
																	<option id="Menunggu" value="Menunggu">Menunggu</option>
																	<option id="Proses" value="Proses">Proses</option>
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
			      	<?php
			      	}
			      	?>
				     	
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                	<th style="width: 10px; max-width: 10px !important;"><center>No.</center></th>
                  <th width="150"><center>Tanggal</center></th>
                  <th width="200"><center>Koran</center></th>
                  <th width="120"><center>Waktu Mulai</center></th>
                  <th width="120"><center>Waktu Selesai</center></th>
                  <th width="120"><center>Jumlah Edaran</center></th>
                  <th width="100"><center>Status</center></th>
                  <th width="80"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
              	<?php
              	$no = 1;
              	$nama_bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember', );
              	foreach ($data_finishing as $v) {
              		$tanggal = substr($v->tanggal, 8,2);
									$bulan = $nama_bulan[substr($v->tanggal, 5,2)] ;
									$tahun = substr($v->tanggal, 0,4);
									$waktu_mulai = substr($v->jam_masuk_finishing, 0,5);
									$waktu_selesai = substr($v->jam_selesai_finishing, 0,5);
									$tanggal_mantap = $tanggal . " " . $bulan . " " . $tahun;
              	?>
              	<tr>
                  <td><center><?php echo $no; ?></center></td>
                  <td><center><?php echo $tanggal_mantap; ?></center></td>
                  <td><center><?php echo $v->nama_koran; ?></center></td>
                  <td><center><?php if ($v->status == 'Menunggu') {
                  	echo "-";
                  } else { echo $waktu_mulai; }  ?></center></td>
                  <td><center><?php if ($v->status != 'Selesai') {
                  	echo "-";
                  } else { echo $waktu_selesai; }  ?></center></td>
                  <td><center><?php echo $v->jumlah_edaran; ?></center></td>
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
                  	<a href="" title="Edit Aktivitas"  data-toggle="modal" data-target="#edit-proses-<?php echo $v->id_finishing; ?>"><i style="font-size: 20px;" class=" md-create"></i></a>
                  	<!--
                  		onclick="setId('<?php echo $v->id_finishing; ?>','<?php echo $v->tanggal; ?>','<?php echo $v->nama_koran; ?>','<?php echo $v->jam_masuk_finishing; ?>','<?php echo $v->jam_selesai_finishing; ?>','<?php echo $v->jumlah_edaran; ?>','<?php echo $v->status; ?>')"
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
	function setId($id, $tanggal, $nama_koran, $waktu_mulai, $waktu_selesai, $jumlah_edaran, $status){
		var tgl = $tanggal.substr(5,2) + '/' + $tanggal.substr(8,2) + '/' + $tanggal.substr(0,4);
		
		document.getElementById('id_finishing').value = $id;
		document.getElementById('tanggal-old').value = tgl;
		document.getElementById('datepicker').value = tgl;
		document.getElementById('nama_koran-old').value = $nama_koran;
		document.getElementById('nama_koran-edit').value = $nama_koran;
		document.getElementById('waktu_mulai-edit').value = $waktu_mulai.substr(0, 5);
		document.getElementById('waktu_selesai-edit').value = $waktu_selesai.substr(0, 5);
		document.getElementById('jumlah_edaran-edit').value = $jumlah_edaran;
		
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
	if ($this->session->flashdata('tambah_finishing_1')) {
		echo "<script>alert('".$this->session->flashdata('tambah_finishing_1')."');</script>";
	} else if ($this->session->flashdata('tambah_finishing_0')) {
		echo "<script>alert('".$this->session->flashdata('tambah_finishing_0')."');</script>";
	} else if ($this->session->flashdata('edit_finishing_1')) {
		echo "<script>alert('".$this->session->flashdata('edit_finishing_1')."');</script>";
	} else if ($this->session->flashdata('edit_finishing_0')) {
		echo "<script>alert('".$this->session->flashdata('edit_finishing_0')."');</script>";
	} else if ($this->session->flashdata('tambah_finishing_2')) {
		echo "<script>alert('".$this->session->flashdata('tambah_finishing_2')."');</script>";
	} else if ($this->session->flashdata('edit_finishing_2')) {
		echo "<script>alert('".$this->session->flashdata('edit_finishing_2')."');</script>";
	}
?>