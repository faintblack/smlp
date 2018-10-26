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
        <li>Laporan Divisi</li>
        <li class="active">Finishing</li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>TABEL LAPORAN DIVISI FINISHING</b></h4><br>

            <!-- DETAIL LAPORAN -->
              <?php
              $nama_bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember', );
              $nama_hari = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => "Jum'at", 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');
              foreach ($data_finishing as $v) {
                $jml_cetak = 0;
                $tanggal = substr($v->tanggal, 8,2);
                $bulan = $nama_bulan[substr($v->tanggal, 5,2)] ;
                $tahun = substr($v->tanggal, 0,4);
                $waktu_mulai = substr($v->jam_masuk_finishing, 0,5);
                $waktu_selesai = substr($v->jam_selesai_finishing, 0,5);
                $hari = $nama_hari[date('l', strtotime($v->tanggal))]; 

                $tanggal_mantap = $tanggal . " " . $bulan . " " . $tahun;

                foreach ($data_cetak as $x) {
                  if (($v->tanggal == $x->tanggal) && ($v->nama_koran == $x->nama_koran)) {
                    $jml_cetak = $jml_cetak + $x->jumlah_cetak;
                  }
                }
              ?>
                <div id="detail-<?php echo $v->id_finishing; ?>" class="modal fade bs-example-modal-lg-<?php echo $v->id_finishing; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel"><b>Laporan Divisi Finishing</b></h4>
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
                        <div class="row"> 
                          <div class="col-md-12"> 
                            <div class="form-group">
                              <label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Nama Koran</label>
                              <label class="control-label col-md-10" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $v->nama_koran; ?></label>
                            </div>
                          </div> 
                        </div>
                        <!-- JUMLAH CETAK -->
                        <div class="row"> 
                          <div class="col-md-12"> 
                            <div class="form-group">
                              <label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Jumlah Cetak</label>
                              <label class="control-label col-md-10" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $jml_cetak; ?></label>
                            </div>
                          </div> 
                        </div>
                        <!-- JUMLAH EDARAN -->
                        <div class="row"> 
                          <div class="col-md-12"> 
                            <div class="form-group">
                              <label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Jumlah Edaran</label>
                              <label class="control-label col-md-10" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $v->jumlah_edaran; ?></label>
                            </div>
                          </div> 
                        </div>
                        <!-- WAKTU MULAI -->
                        <div class="row"> 
                          <div class="col-md-12"> 
                            <div class="form-group">
                              <label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Waktu Mulai</label>
                              <label class="control-label col-md-10" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $waktu_mulai; ?></label>
                            </div>
                          </div> 
                        </div>
                        <!-- WAKTU SELESAI -->
                        <div class="row"> 
                          <div class="col-md-12"> 
                            <div class="form-group">
                              <label class="control-label col-md-2" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">Waktu Selesai</label>
                              <label class="control-label col-md-10" style="padding-top: 7px; padding-left: 0px; margin-bottom: 0px;">: <?php echo $waktu_selesai; ?></label>
                            </div>
                          </div> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
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
                  <td>
                    <center>
                    <a href="" title="Detail Laporan" data-toggle="modal" data-target=".bs-example-modal-lg-<?php echo $v->id_finishing ?>"><i style="font-size: 20px;" class=" md-remove-red-eye"></i></a>
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
    
    document.getElementById('id_finishing').value = $id;
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
  } else if ($this->session->flashdata('edit_finishing_1')) {
    echo "<script>alert('".$this->session->flashdata('edit_finishing_1')."');</script>";
  } else if ($this->session->flashdata('edit_finishing_0')) {
    echo "<script>alert('".$this->session->flashdata('edit_finishing_0')."');</script>";
  } else if ($this->session->flashdata('tambah_precetak_2')) {
    echo "<script>alert('".$this->session->flashdata('tambah_precetak_2')."');</script>";
  } else if ($this->session->flashdata('edit_finishing_2')) {
    echo "<script>alert('".$this->session->flashdata('edit_finishing_2')."');</script>";
  }
?>