                        <!-- start page title -->                        <div class="row">                            <div class="col-12">                                <div class="page-title-box">                                    <h2 class="page-title" style="font-size: 14px">Penilaian</h2>                                    <div class="page-title-right">                                        <ol class="breadcrumb p-0 m-0">                                            <li class="breadcrumb-item"><a href="#">Penilaian Dokumen</a></li>                                            <li class="breadcrumb-item active"><a href="#">Kota</a></li>                                        </ol>                                    </div>                                    <div class="clearfix"></div>                                </div>                            </div>                        </div><div class="row">    <div class="col-sm-12">        <div class="card">            <div class="card-header">                <div class="card-body">                    <div class="form">                        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="get" action="#" novalidate="novalidate">                            <div class="form-group row">                                <label for="cname" class="col-form-label col-lg-2">Modul </label>                                <div class="col-lg-4">                                    <select class="form-control" name="group" id="select_groupadd">                                        <option value=""> Modul 1 Penilaian Dokumen </option>                                    </select>                                </div>                            </div>                                                        <div class="form-group row">                                <label for="cname" class="col-form-label col-lg-2">Tim penilai  </label>                                <div class="col-lg-4">                                    <select class="form-control" name="select_penilai" id="select_penilai">                                        <option value=""> - Pilih - </option>                                        <?php                                        foreach ($list_user->result() as $m) {                                            ?>                                        <option value="<?php                                        $idcomb = "KAB-".$m->id;                                        $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));                                        echo $encrypted_id;                                        ?>"><?php echo $m->name?></option>                                                <?php                                        }                                        ?>                                    </select>                                                    </div>                            </div>                            <input type="hidden" id="inp_tim" />                            <div class="form-group row">                                <label for="cname" class="col-form-label col-lg-2">Daerah yang di nilai </label>                                <div class="col-lg-4" id="selecttpt">                                    <select class="form-control _penTPT" name="select_tpt" id="select_tpt">                                        <option value=""> - Silakan Dipilih Tim Penilai TPT - </option>                                                                              </select>                                </div>                            </div>                                                        <div class="form-group row mb-0">                                <div class="offset-lg-2 col-lg-10">                                    <button class="btn btn-success waves-effect waves-light mr-1 btnDown" type="submit">Download</button>    <!--                                                        <button class="btn btn-secondary waves-effect" type="button">Cancel</button>-->                                </div>                            </div>                        </form>                    </div>                    <!-- .form -->                </div>            <!-- card-body -->        </div>        <!-- card -->    </div>        <!-- col -->    </div></div>                                                <div id="pop_berkas" class="modal fade " tabindex="-1">    <div class="modal-dialog modal-xl">            <div class="modal-content">                <div class="modal-header">                    <h5 class="modal-title"><i>Lembar Pernyataan</i></h5>                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >                        <span aria-hidden="true">&times;</span>                    </button>                </div>                <div class="card-body">                    <div class="card-body">                        <form id="form_pernyataan">                        </form>                    </div>                                    </div>            </div>    </div></div>                         