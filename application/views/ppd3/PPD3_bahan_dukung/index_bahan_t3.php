<!-- <div class="container-fluid"> -->
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Tahap 3</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Tahap 3</li>
                        <li class="breadcrumb-item active">Bahan Dukung</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->
    <div class="row stepper-navigation-bahan-dukung-tpt">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <!-- <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="prov">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">List Provinsi <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div> -->
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">List Bahan Dukung <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <!-- <a href="#" class="btnShwHd" data-show="._wrapper" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="prov"><p style="padding: 5px; font-size: 0.8rem !important;"><strong><i class="mdi mdi-undo" style="color: #2ad408;"></i> Kembali</strong></p></a> -->
                </div>
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Moltran</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="row _wrapper_bahan" style="margin-top: 90px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?php echo base_url();?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-info-circle "></i> Sebelum melakukan penilaian, silahkan mengunduh Dokumen Daerah.
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="col-12" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 5px;">
                            <h3 class="card-title">List Bahan Dukung Tahap 3</h3>
                            <button class="btn btn-sm btn-primary waves-effect waves-light" id="btnShwMdlSindiAdd"style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Unduh Semua <i class="fas fa-download" style="padding-left: 5px;"></i></button>
                        </div>
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-condensed table-bordered table-striped " id="t_bahan" style="border: 1px solid black; margin-bottom: 0px; border-collapse: inherit;">
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                <tr>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;"><center><b>No</b></center></th>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;"><center><b>Nama Dokumen</b></center></th>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;"><center><b>Diupload Oleh</b></center></th>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;"><center><b>Aktivitas</b></center></th>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;"><center><b>Unduh</b></center></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <!-- <button class="btn btn-info" id="btnShwMdlSindiAdd"><i class="fas"></i>&nbsp;Unduh Semua</button> -->
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->



 