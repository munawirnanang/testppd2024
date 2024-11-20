<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Kertas Kerja</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Kertas Kerja</a></li>
                        <li class="breadcrumb-item active">Kabupaten</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->

    <!-- start page title -->
    <div class="row stepper-status-penilaian-provinsi-tpt" style="margin-left: -40px;">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Kertas Kerja TPT Kabupaten <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                </div>
                <div class="page-title-right">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row _wrapper_wlyh" style="margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive isitable">
                                  <table id="dataUser" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">                          
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Kabupaten</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                            <div class="panel-footer">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>  
    
    <div class="row _wrapper_info" style="display: none">
        <div class="col-md-12">
            <div class="card card-border">
                <div class="card-header border-primary bg-transparent pb-0">
                    <h3 class="card-title text-primary">Informasi</h3>
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table-description table-modified">
                            
                            <tr style="">
                                <td class="lbl_hdr_nmwlyh"></td>
                                <td  class="text-uppercase lbl_hdr_katewlyh"></td>
                                <td></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row _wrapper_bahan" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Kertas Kerja</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-bordered table-hover" id="t_bahan">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:5px">NO</th>
                                    <th class="text-uppercase">Nama Penilai</th>
                                    <th class="" style="width:5px">Unduh</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>

