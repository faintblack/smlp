<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">

			<div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Daftar Pengguna</b></h4><br>
            <button href="" data-toggle="modal" data-target="#tambah-pengguna" style="margin-bottom: 15px;" class="btn btn-info waves-effect waves-light"> <i style="font-size: 16px;" class="md-person-add m-r-5"></i> <span>Tambah Pengguna</span> </button>

            <!-- TAMBAH PENGGUNA -->
				      <div id="tambah-pengguna" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				      	<?php 
				      	$attribute = array('data-parsley-validate' => '', 'novalidate' => '', 'role' => 'form');
				      	echo form_open('admincontroller/tambahpengguna'); ?>
				      		<div class="modal-dialog"> 
					          <div class="modal-content"> 
					            <div class="modal-header"> 
					              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					              <h4 class="modal-title"><strong>Tambah Pengguna</strong> </h4> 
					            </div> 
					            <div class="modal-body">
					            	<div class="row"> 
					                <div class="col-md-12"> 
					                  <div class="form-group"> 
					                    <label for="field-3" class="control-label">Nama Pengguna</label> 
					                    <input name="nama_pengguna" type="text" class="form-control" id="field-3" placeholder="Nama Pengguna" required autofocus> 
					                  </div>
					                </div> 
					              </div> 
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label  class="control-label">Username</label> 
					                    <input name="username" type="text" class="form-control"  placeholder="Username" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label class="control-label">Hak Akses</label> 
					                    <select name="hak_akses" class="selectpicker"  data-style="btn-white" required>
					                    	<option value="" disabled selected>Pilih Hak Akses</option>
					                    	<?php
					                    	foreach ($data_pengguna as $v) {
					                    		if ($v->hak_akses == 'Pimpinan') {
					                    			$pimpinan = TRUE;
					                    		}
					                    	}
					                    	if ($pimpinan == FALSE) {
					                    	?>
					                    	<option value="Pimpinan">Pimpinan</option>
					                    	<?php
					                    	}
					                    	?>
																<option value="Pre Cetak">Divisi Pre Cetak</option>
																<option value="Cetak">Divisi Cetak</option>
																<option value="Finishing">Divisi Finishing</option>
															</select> 
					                  </div> 
					                </div> 
					              </div> 
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label for="field-1" class="control-label">Password</label> 
					                    <input name="password" id="pass" type="password" class="form-control"  placeholder="Password" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label for="field-2" class="control-label">Ulangi Password</label> 
					                    <input name="re-password" data-parsley-equalto="#pass" type="password" class="form-control" placeholder="Ulangi Password" required> 
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

				    <!-- EDIT PENGGUNA -->
				      <?php
				      foreach ($data_pengguna as $v) {
				      	foreach ($data_pengguna as $x) {
				      		if ($x->hak_akses == 'Pimpinan') {
				      			$pimpinan = TRUE;
				      		}
				      	}
				      ?>
				      <div id="detail-pengguna-<?php echo $v->username; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				        <?php
				        $attribut = array('data-parsley-validate' => '', 'novalidate' => '', 'role' => 'form');
				        echo form_open('admincontroller/editpengguna');
				        ?>
				        	<div class="modal-dialog"> 
					          <div class="modal-content"> 
					            <div class="modal-header"> 
					              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					              <h4 class="modal-title"><strong>Detail Pengguna</strong> </h4> 
					            </div> 
					            <div class="modal-body">
					            	<div class="row"> 
					                <div class="col-md-12"> 
					                  <div class="form-group"> 
					                    <label for="field-3" class="control-label">Nama Pengguna</label> 
					                    <input name="nama_pengguna" value="<?php echo $v->nama_pengguna; ?>" type="text" class="form-control" id="field-3" placeholder="Nama Pengguna" required>
					                  </div> 
					                </div> 
					              </div> 
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label for="field-1" class="control-label">Username</label> 
					                    <input name="username" value="<?php echo $v->username; ?>" type="text" class="form-control" id="field-1" placeholder="Username" readonly> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label class="control-label">Hak Akses</label> 
					                    <select name="hak_akses" class="selectpicker"  data-style="btn-white" required>
					                    	<option value="" disabled selected>Pilih Hak Akses</option>
																<option value="Admin" <?php if ($v->hak_akses != 'Admin') {
																	echo "disabled";
																} else {
																	echo "selected";
																} ?> >Admin</option>
																<option value="Pimpinan" <?php if ($v->hak_akses == 'Pimpinan') {
																	echo "selected";
																} else {
																	echo "disabled";
																} ?> >Pimpinan</option>
																<option value="Pre Cetak" <?php if ($v->hak_akses == 'Pre Cetak') {
																	echo "selected";
																} else if (($v->hak_akses == 'Pimpinan') || ($v->hak_akses == 'Admin')) {
																	echo "disabled";
																} ?> >Divisi Pre Cetak</option>
																<option value="Cetak" <?php if ($v->hak_akses == 'Cetak') {
																	echo "selected";
																} else if (($v->hak_akses == 'Pimpinan') || ($v->hak_akses == 'Admin')) {
																	echo "disabled";
																} ?> >Divisi Cetak</option>
																<option value="Finishing" <?php if ($v->hak_akses == 'Finishing') {
																	echo "selected";
																} else if (($v->hak_akses == 'Pimpinan') || ($v->hak_akses == 'Admin')) {
																	echo "disabled";
																} ?> >Divisi Finishing</option>
															</select> 
					                  </div> 
					                </div> 
					              </div> 
					              <div class="row"> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label class="control-label">Password</label> 
					                    <input name="password" value="<?php echo $v->password ;?>" id="pass-<?php echo $v->username; ?>" type="password" class="form-control" placeholder="Password" required> 
					                  </div> 
					                </div> 
					                <div class="col-md-6"> 
					                  <div class="form-group"> 
					                    <label class="control-label">Password Baru</label> 
					                    <input name="new_password" type="password" class="form-control" placeholder="Password Baru" > 
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
                	<th width="50"><center>No.</center></th>
                  <th width="200"><center>Nama</center></th>
                  <th width="160"><center>Username</center></th>
                  <th width="180"><center>Hak Akses</center></th>
                  <th width="80"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
              	<?php
              	$no = 1;
              	foreach ($data_pengguna as $v) {
              	?>
              	<tr>
              		<td><center><?php echo $no; ?></center></td>
                  <td><center><?php echo $v->nama_pengguna; ?></center></td>
                  <td><center><?php echo $v->username; ?></center></td>
                  <td><center><?php echo $v->hak_akses; ?></center></td>
                  <td>
                  	<center>
                  	<a href="" title="Detail Pengguna" data-toggle="modal" data-target="#detail-pengguna-<?php echo $v->username; ?>"><i style="font-size: 20px;" class="md-remove-red-eye"></i></a>&nbsp;&nbsp;&nbsp;
                  	<a <?php if ($v->hak_akses == 'Admin'): ?>
                  		style="display: none;"
                  	<?php endif ?> title="Hapus Pengguna" href="<?php echo base_url('admincontroller/hapuspengguna/'.$v->username); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengguna atas nama <?php echo $v->nama_pengguna ?> ?')"><i style="font-size: 20px;" class="ion-trash-a"></i></a>
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