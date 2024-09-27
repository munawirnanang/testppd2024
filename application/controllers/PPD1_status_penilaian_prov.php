<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_status_penilaian_prov extends CI_Controller
{
    var $view_dir   = "ppd1/statuspenilaian/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd1/statuspenilaian/statuspenilaian.js";
    var $allowed    = array("PPD1");
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
    }

    /*
     * 
     */
    public function index()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/ppd1/statuspenilaian/statuspenilaian_prov.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_prov", $data_page, TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init . ".init();",
                    "csrf_hash"     => $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     => $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("access denied!");
        }
    }

    function g_nilai_berdasarkan_penilai()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                //---------------isi disini--------------------

                $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(id) FROM r_mdl1_item) * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi 
                            FROM `tbl_user_wilayah` wil
                            JOIN tbl_user us ON wil.iduser = us.id
                            JOIN provinsi pro ON wil.idwilayah = pro.id  
                        ) t1
                        LEFT JOIN t_mdl1_skor_prov skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_prov sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                        GROUP BY t1.id
                        ORDER BY t1.userid";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $no = 1;
                $str = '';
                foreach ($list_data->result() as $list) {
                    $str .= '<tr>';
                    $str .= '<td><center>' . $no . '</center></td>';
                    $str .= '<td><center>' . $list->userid . '</center></td>';
                    $str .= '<td><center>' . $list->name . '</center></td>';
                    $str .= '<td><center>' . $list->nama_provinsi . '</center></td>';
                    $str .= '<td><center>' . $list->persentase_penilaian . '</center></td>';
                    $str .= '<td><center>' . $list->lembar_pernyataan . '</center></td>';
                    $str .= '</td>';
                    $no++;
                }

                //---------end isi disini----------------------

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"     => $str,
                );
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
            } catch (Exception $exc) {
                $json_data = array(
                    "status"    => 0,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "msg"       => $exc->getMessage(),
                );
                exit(json_encode($json_data));
            }
        } else die("Die!");
    }

    function g_rekap_penilaian_tim()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                //---------------isi disini--------------------

                $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(id) FROM r_mdl1_item) * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload lembar pernyataan'
                            ELSE 'Belum upload lembar pernyataan'
                        END AS lembar_pernyataan
                        FROM(
                            SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi 
                            FROM `tbl_user_wilayah` wil
                            JOIN tbl_user us ON wil.iduser = us.id
                            JOIN provinsi pro ON wil.idwilayah = pro.id  
                            ) t1
                            LEFT JOIN t_mdl1_skor_prov skor ON t1.id = skor.mapid
                            LEFT JOIN t_mdl1_sttment_prov sttment ON t1.id = sttment.mapid
                            WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                            GROUP BY t1.userid
                            HAVING persentase_penilaian > 0  
                        ORDER BY t1.userid  ASC";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $sql_all_penilai = "SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi, COUNT(wil.iduser) AS jumlah_daerah_yang_dinilai
                                    FROM `tbl_user_wilayah` wil
                                    JOIN tbl_user us ON wil.iduser = us.id
                                    JOIN provinsi pro ON wil.idwilayah = pro.id
                                    WHERE us.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                                    GROUP BY us.userid
                                    ORDER BY us.userid ASC";
                $list_data_all_penilai = $this->db->query($sql_all_penilai);

                //---------end isi disini----------------------

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => count($list_data->result()),
                    "data"      => $list_data->result(),
                    "str_all_penilai"   => count($list_data_all_penilai->result()),
                    "data_all_penilai"  => $list_data_all_penilai->result(),
                );
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
            } catch (Exception $exc) {
                $json_data = array(
                    "status"    => 0,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "msg"       => $exc->getMessage(),
                );
                exit(json_encode($json_data));
            }
        } else die("Die!");
    }

    /*
     * =========================================================================
     *  Provinsi                                                   - START
     * =========================================================================
     */
    /*
     * list data Provinsi
     * author : FSM 
     * date : 17 des 2020
     */
    function get_datatable()
    {
        if ($this->input->is_ajax_request()) {
            try {
                $requestData = $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array(
                    // datatable column index  => database column name
                    $idx++   => 'K.`id_kode`',
                    $idx++   => 'K.`id`',
                    $idx++   => 'K.`nama_provinsi`',
                );

                $sql = "SELECT K.id mapid,K.id_kode, K.nama_provinsi
                        FROM `provinsi` K 
                        WHERE K.id != '-1' ";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( "
                        . " K.`nama_provinsi` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR K.`id_kode` LIKE '%" . $requestData['search']['value'] . "%' "
                        . ")";
                }
                $list_data = $this->db->query($sql);
                $totalFiltered = $list_data->num_rows();
                $sql .= " ORDER BY "
                    . $columns[$requestData['order'][0]['column']] . "   "
                    . $requestData['order'][0]['dir'] . "  "
                    . "LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                $list_data = $this->db->query($sql);
                $data = array();
                $i = 1;
                foreach ($list_data->result() as $row) {
                    $nestedData = array();
                    $id      = $row->mapid;
                    $idkab = "prov_" . $row->mapid;

                    $encrypted_id = base64_encode(openssl_encrypt($idkab, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmkk='" . $row->nama_provinsi . "'";
                    $id_kode = $row->id_kode;
                    if ($row->id_kode == '-1')
                        $id_kode = '';

                    $nestedData[] = $id_kode;
                    $nestedData[] = "<a href='javascript:void(0)' " . $tmp . ">" . $row->nama_provinsi . "</a>";
                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval($totalData),  // total number of records
                    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else
            die;
    }
    /*
     * list data Status penilaian
     * author :  FSM
     * date : 10 Feb 2021
     */
    function g_bahan()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $this->form_validation->set_rules('id', 'ID Data Indikator', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $link = base_url() . "attachments/kertaskerja/";
                $idcomb = decrypt_base64($this->input->post("id"));

                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                $_arr = array("prov", "kab", "kot");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");

                //get jml aspek
                $sql = "SELECT A.`id`
                        FROM r_mdl1_aspek A 
                        WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $jml_aspek = $list_data->num_rows();

                $str = "";

                if ($kate_wlyh == "prov") {
                    //get jml item
                    $sql = "SELECT I.`id`
                            FROM r_mdl1_item I 
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y'
                            JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $jml_item = $list_data->num_rows();

                    $sql = "SELECT A.iduser,C.name, A.idwilayah,B.nama_provinsi, JML.jml,IFNULL(RS.jml,0) jml_rsm, ST.id stts, ST.attachments
  FROM tbl_user_wilayah A
  JOIN `provinsi` B ON B.`id`=A.`idwilayah`
  JOIN `tbl_user` C ON C.id = A.iduser AND C.group=2
   LEFT JOIN(
	    SELECT W.`idwilayah` idprov,COUNT(1) jml,W.iduser
	    FROM `tbl_user_wilayah` W
	    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
	    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
	    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
	    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
	    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
	    WHERE 1=1
	    GROUP BY W.`idwilayah`,W.iduser
	) JML ON JML.idprov=A.`idwilayah` AND JML.`iduser` = A.iduser
    LEFT JOIN(
				SELECT W.`idwilayah` idprov,COUNT(1) jml,W.iduser
				FROM `tbl_user_wilayah` W
				JOIN `t_mdl1_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE 1=1
				GROUP BY W.`idwilayah`,W.`iduser`
                            ) RS ON RS.idprov=A.`idwilayah` AND RS.`iduser`=A.iduser      
  LEFT JOIN t_mdl1_sttment_prov ST ON ST.mapid=A.id                          
  WHERE A.`idwilayah`=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $str = "";
                    if ($list_data->num_rows() == 0)
                        $str = "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
                    $no = 1;
                    $link = base_url() . "attachments/kertaskerja/";
                    foreach ($list_data->result() as $v) {
                        $idcomb = "-" . $v->iduser;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                        //$tmp = " data-id='" . $encrypted_id . "'";
                        $tmp = " data-id='" . $v->iduser . "'";
                        $idcomb1 = "-" . $v->idwilayah;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $tmp1 = " data-pr='" . $v->idwilayah . "'";
                        $downl = $link . $v->attachments;
                        if (substr($v->attachments, -3) == 'rar') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".rar";
                        } elseif (substr($v->attachments, -3) == 'zip') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".zip";
                        } elseif (substr($v->attachments, -3) == 'pdf') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".pdf";
                        } elseif (substr($v->attachments, -4) == 'docx') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".docx";
                        } elseif (substr($v->attachments, -4) == 'xlsx') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".xlsx";
                        } elseif (substr($v->attachments, -4) == 'jpeg') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".jpeg";
                        } elseif (substr($v->attachments, -4) == 'pptx') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".pptx";
                        } else {
                            $rename = $v->name . "_" . $v->nama_provinsi;
                        }

                        $str .= "<tr class='' title='Dokumen'>";
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->name . "</td>";

                        //status
                        $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;
                        $str_tmp = number_format($prcntg, 2) . "&nbsp;%";
                        if ($prcntg == 1) {
                            $str_tmp = "<i class='fas fa-check-circle text-success'></i>";
                        }
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $str_tmp . "</td>";

                        //status
                        $str_tmp = "<i class='fas fas fa-battery-half fa-2x text-warning' title='Data penilaian belum lengkap'></i>";
                        if ($prcntg == 100) {
                            $str_tmp = "<i class='fas fas fa-exclamation-circle fa-2x text-warning' title='Data Resume Aspek belum lengkap'></i>";
                            if ($v->jml_rsm == $jml_aspek) {
                                $str_tmp = "<a href='javascript:void(0);' class='getSttmnt' data-id='' title='Lembar pernyataan belum lengkap'><i class='fas fa-exclamation-circle fa-2x text-pink'></i></a>";
                                if (!is_null($v->stts)) {
                                    //$str_tmp="<a href='javascript:void(0);' class='getSttmnt' data-id='' title='Lengkap'><i class='fas fa-check-circle fa-2x text-success'></i></a>";
                                    $str_tmp = "<a href='$downl' download='$rename' target='_blank' class='getSttmnt' data-id='' title='Unduh Kertas Kerja'><i class='fas fa-check-circle fa-2x text-success'></i></a>";
                                }
                            }
                        }

                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $str_tmp . "</td>";
                        $str .= "<td  class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a $tmp $tmp1 class='btn btn-sm btnDown'  title='Unduh Data'><i class='fas fa-download'></i></a></td>";
                        $str .= "</tr>";
                    }
                }



                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => $str,
                );
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
            } catch (Exception $exc) {
                $json_data = array(
                    "status"    => 0,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "msg"       => $exc->getMessage(),
                );
                exit(json_encode($json_data));
            }
        } else die("Die!");
    }

    /*
     * unduh nilai 
     * author : FSM
     * date : 17 des 2020
     */
    function Download_nilai()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }

        // $idcomb = decrypt_base64($_GET['timid']);
        // $tmp = explode('-', $idcomb);
        // if (count($tmp) != 2) {
        //     echo 'InvaliD Kategori Wilayah';
        //     exit();
        // }

        // $kate_wlyh = $tmp[0];
        // $user = $tmp[1];

        $user = $_GET['timid'];
        // $provcomb = decrypt_base64($_GET['provid']);
        // $tmp2 = explode('-', $provcomb);
        // if (count($tmp2) != 2) {
        //     echo 'InvaliD Kategori Prov';
        //     exit();
        // }
        // $kate_wlyh = $tmp2[0];
        // $idwil = $tmp2[1];
        $idwil    = $_GET['provid'];
        $select_u = "SELECT W.* FROM `tbl_user` W WHERE W.id='$user' ";
        $list_u   = $this->db->query($select_u);
        foreach ($list_u->result() as $u) {
            $nama = $u->name;
        }
        //$user
        $select = "SELECT W.id,W.iduser,W.idwilayah, P.nama_provinsi, U.userid
                    FROM `tbl_user_wilayah` W
                    JOIN `provinsi` P ON W.idwilayah = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE W.iduser='$user' AND W.idwilayah='$idwil'";

        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namaprov = $d->nama_provinsi;
        }

        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Nilai');

        $this->excel->getActiveSheet()->getStyle('B115')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );
        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2024");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");

        $this->excel->getActiveSheet()->mergeCells('A2:K2');

        //                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:L187');

        $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
        $this->excel->getActiveSheet()->mergeCells('A4:B4');
        $this->excel->getActiveSheet()->setCellValue('C4', ":");
        $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
        $this->excel->getActiveSheet()->mergeCells('A5:B5');
        $this->excel->getActiveSheet()->setCellValue('C5', ":");
        $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
        $this->excel->getActiveSheet()->setCellValue('D5', "$namaprov");
        $this->excel->getActiveSheet()->mergeCells('A2:B2');
        $this->excel->getActiveSheet()->mergeCells('A3:B3');



        $this->excel->getActiveSheet()->setCellValue("A10", "NO");
        $this->excel->getActiveSheet()->mergeCells('A10:A11');
        $this->excel->getActiveSheet()->setCellValue("B10", "KRITERIA");
        $this->excel->getActiveSheet()->mergeCells('B10:B11');

        $this->excel->getActiveSheet()->setCellValue("C10", "INDIKATOR");
        $this->excel->getActiveSheet()->mergeCells('C10:D11');
        $this->excel->getActiveSheet()->setCellValue("E10", "ITEM");
        $this->excel->getActiveSheet()->mergeCells('E10:F11');
        $this->excel->getActiveSheet()->setCellValue("G10", "NILAI");
        $this->excel->getActiveSheet()->mergeCells('G10:G11');
        $this->excel->getActiveSheet()->setCellValue("H10", "KEUNGGULAN DAERAH");
        $this->excel->getActiveSheet()->mergeCells('H10:H11');
        $this->excel->getActiveSheet()->setCellValue("I10", "REKOMENDASI");
        $this->excel->getActiveSheet()->mergeCells('I10:I11');
        $this->excel->getActiveSheet()->setCellValue("J10", "SKOR");
        $this->excel->getActiveSheet()->mergeCells('J10:J11');
        $this->excel->getActiveSheet()->setCellValue("K10", "BOBOT");
        $this->excel->getActiveSheet()->mergeCells('K10:K11');
        $this->excel->getActiveSheet()->setCellValue("L10", "NILAI TERBOBOT");
        $this->excel->getActiveSheet()->mergeCells('L10:L11');
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue("A187", "TOTAL");



        $this->excel->getActiveSheet()->mergeCells('A12:A71');
        $this->excel->getActiveSheet()->mergeCells('A72:A110');
        $this->excel->getActiveSheet()->mergeCells('A111:A127');
        $this->excel->getActiveSheet()->mergeCells('A128:A159');
        $this->excel->getActiveSheet()->mergeCells('A160:A186');

        $this->excel->getActiveSheet()->mergeCells('B12:B71');
        $this->excel->getActiveSheet()->mergeCells('B72:B110');
        $this->excel->getActiveSheet()->mergeCells('B111:B127');
        $this->excel->getActiveSheet()->mergeCells('B128:B159');
        $this->excel->getActiveSheet()->mergeCells('B160:B186');

        $this->excel->getActiveSheet()->mergeCells('C12:C21');
        $this->excel->getActiveSheet()->mergeCells('C22:C26');
        $this->excel->getActiveSheet()->mergeCells('C27:C33');
        $this->excel->getActiveSheet()->mergeCells('C34:C45');
        $this->excel->getActiveSheet()->mergeCells('C46:C52');
        $this->excel->getActiveSheet()->mergeCells('C53:C60');
        $this->excel->getActiveSheet()->mergeCells('C61:C71');
        $this->excel->getActiveSheet()->mergeCells('C72:C81');
        $this->excel->getActiveSheet()->mergeCells('C82:C84');
        $this->excel->getActiveSheet()->mergeCells('C85:C88');
        $this->excel->getActiveSheet()->mergeCells('C89:C95');
        $this->excel->getActiveSheet()->mergeCells('C96:C100');
        $this->excel->getActiveSheet()->mergeCells('C101:C104');
        $this->excel->getActiveSheet()->mergeCells('C105:C110');
        $this->excel->getActiveSheet()->mergeCells('C111:C115');
        $this->excel->getActiveSheet()->mergeCells('C116:C118');
        $this->excel->getActiveSheet()->mergeCells('C119:C123');
        $this->excel->getActiveSheet()->mergeCells('C124:C127');
        $this->excel->getActiveSheet()->mergeCells('C128:C133');
        $this->excel->getActiveSheet()->mergeCells('C134:C145');
        $this->excel->getActiveSheet()->mergeCells('C146:C153');
        $this->excel->getActiveSheet()->mergeCells('C154:C159');
        $this->excel->getActiveSheet()->mergeCells('C160:C172');
        $this->excel->getActiveSheet()->mergeCells('C173:C186');

        $this->excel->getActiveSheet()->mergeCells('D12:D21');
        $this->excel->getActiveSheet()->mergeCells('D22:D26');
        $this->excel->getActiveSheet()->mergeCells('D27:D33');
        $this->excel->getActiveSheet()->mergeCells('D34:D45');
        $this->excel->getActiveSheet()->mergeCells('D46:D52');
        $this->excel->getActiveSheet()->mergeCells('D53:D60');
        $this->excel->getActiveSheet()->mergeCells('D61:D71');
        $this->excel->getActiveSheet()->mergeCells('D72:D81');
        $this->excel->getActiveSheet()->mergeCells('D82:D84');
        $this->excel->getActiveSheet()->mergeCells('D85:D88');
        $this->excel->getActiveSheet()->mergeCells('D89:D95');
        $this->excel->getActiveSheet()->mergeCells('D96:D100');
        $this->excel->getActiveSheet()->mergeCells('D101:D104');
        $this->excel->getActiveSheet()->mergeCells('D105:D110');
        $this->excel->getActiveSheet()->mergeCells('D111:D115');
        $this->excel->getActiveSheet()->mergeCells('D116:D118');
        $this->excel->getActiveSheet()->mergeCells('D119:D123');
        $this->excel->getActiveSheet()->mergeCells('D124:D127');
        $this->excel->getActiveSheet()->mergeCells('D128:D133');
        $this->excel->getActiveSheet()->mergeCells('D134:D145');
        $this->excel->getActiveSheet()->mergeCells('D146:D153');
        $this->excel->getActiveSheet()->mergeCells('D154:D159');
        $this->excel->getActiveSheet()->mergeCells('D160:D172');
        $this->excel->getActiveSheet()->mergeCells('D173:D186');

        $this->excel->getActiveSheet()->mergeCells('H12:H71');
        $this->excel->getActiveSheet()->mergeCells('H72:H159');
        $this->excel->getActiveSheet()->mergeCells('H160:H186');

        $this->excel->getActiveSheet()->mergeCells('I12:I71');
        $this->excel->getActiveSheet()->mergeCells('I72:I159');
        $this->excel->getActiveSheet()->mergeCells('I160:I186');


        $this->excel->getActiveSheet()->mergeCells('A187:K187');

        //list indikator skor ORDER BY IND.`nourut`,IT.subindiid, IT.`nourut`
        $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
                                FROM `r_mdl1_item` IT
                                JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                                JOIN `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                                JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                                LEFT JOIN `t_mdl1_resume_prov` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
                                LEFT JOIN(
                                        SELECT I.`id` iditem,II.`skor`
                                        FROM `t_mdl1_skor_prov` SK
                                        JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                        JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                        WHERE SK.`mapid`='$nilai'
                                ) SKOR ON SKOR.iditem=IT.`id`
                                ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC";

        $list_data  = $this->db->query($status_sql);
        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 12;
        $nol = '';
        foreach ($list_data->result() as $value) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skor);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, '');
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100);
            //                $this->excel->getActiveSheet()->getColumnDimension("F")->setWrapText(true);
            $index_excelColumn = 0;
            $row++;
        }

        $this->excel->getActiveSheet()->mergeCells('J12:J21'); //$this->excel->getActiveSheet()->mergeCells('J12:J20');
        $this->excel->getActiveSheet()->setCellValue("J12", "=10*SUM(G12:G21)/COUNT(E12:E21))");
        $this->excel->getActiveSheet()->mergeCells('J22:J26'); //$this->excel->getActiveSheet()->mergeCells('J21:J27');
        $this->excel->getActiveSheet()->setCellValue("J22", "=10*SUM(G22:G26)/COUNT(E22:E26))");
        $this->excel->getActiveSheet()->mergeCells('J27:J33'); //$this->excel->getActiveSheet()->mergeCells('J28:J38');
        $this->excel->getActiveSheet()->setCellValue("J27", "=10*SUM(G27:G33)/COUNT(E27:E33))");
        $this->excel->getActiveSheet()->mergeCells('J34:J45'); //$this->excel->getActiveSheet()->mergeCells('J39:J53');
        $this->excel->getActiveSheet()->setCellValue("J34", "=10*SUM(G34:G45)/COUNT(E34:E45))");
        $this->excel->getActiveSheet()->mergeCells('J46:J52'); //$this->excel->getActiveSheet()->mergeCells('J54:J61');
        $this->excel->getActiveSheet()->setCellValue("J46", "=10*SUM(G46:G52)/COUNT(E46:E52))");
        $this->excel->getActiveSheet()->mergeCells('J53:J60');
        $this->excel->getActiveSheet()->setCellValue("J53", "=10*SUM(G53:G60)/COUNT(E53:E60))");
        $this->excel->getActiveSheet()->mergeCells('J61:J71');
        $this->excel->getActiveSheet()->setCellValue("J61", "=10*SUM(G61:G71)/COUNT(E61:E71))");
        $this->excel->getActiveSheet()->mergeCells('J72:J81');
        $this->excel->getActiveSheet()->setCellValue("J72", "=10*SUM(G72:G81)/COUNT(E72:E81))");
        $this->excel->getActiveSheet()->mergeCells('J82:J84');
        $this->excel->getActiveSheet()->setCellValue("J82", "=10*SUM(G82:G84)/COUNT(E82:E84))");
        $this->excel->getActiveSheet()->mergeCells('J85:J88');
        $this->excel->getActiveSheet()->setCellValue("J85", "=10*SUM(G85:G88)/COUNT(E85:E88))");
        $this->excel->getActiveSheet()->mergeCells('J89:J95');
        $this->excel->getActiveSheet()->setCellValue("J89", "=10*SUM(G89:G95)/COUNT(E89:E95))");
        $this->excel->getActiveSheet()->mergeCells('J96:J100');
        $this->excel->getActiveSheet()->setCellValue("J96", "=10*SUM(G96:G100)/COUNT(E96:E100))");
        $this->excel->getActiveSheet()->mergeCells('J101:J104');
        $this->excel->getActiveSheet()->setCellValue("J101", "=10*SUM(G101:G104)/COUNT(E101:E104))");
        $this->excel->getActiveSheet()->mergeCells('J105:J110');
        $this->excel->getActiveSheet()->setCellValue("J105", "=10*SUM(G105:G110)/COUNT(E105:E110))");
        $this->excel->getActiveSheet()->mergeCells('J111:J115');
        $this->excel->getActiveSheet()->setCellValue("J111", "=10*SUM(G111:G115)/COUNT(E111:E115))");
        $this->excel->getActiveSheet()->mergeCells('J116:J118');
        $this->excel->getActiveSheet()->setCellValue("J116", "=10*SUM(G116:G118)/COUNT(E116:E118))");
        $this->excel->getActiveSheet()->mergeCells('J119:J123');
        $this->excel->getActiveSheet()->setCellValue("J119", "=10*SUM(G119:G123)/COUNT(E119:E123))");
        $this->excel->getActiveSheet()->mergeCells('J124:J127');
        $this->excel->getActiveSheet()->setCellValue("J124", "=10*SUM(G124:G127)/COUNT(E124:E127))");
        $this->excel->getActiveSheet()->mergeCells('J128:J133');
        $this->excel->getActiveSheet()->setCellValue("J128", "=10*SUM(G128:G133)/COUNT(E128:E133))");
        $this->excel->getActiveSheet()->mergeCells('J134:J145');
        $this->excel->getActiveSheet()->setCellValue("J134", "=10*SUM(G134:G145)/COUNT(E134:E145))");
        $this->excel->getActiveSheet()->mergeCells('J146:J153');
        $this->excel->getActiveSheet()->setCellValue("J146", "=10*SUM(G146:G153)/COUNT(E146:E153))");
        $this->excel->getActiveSheet()->mergeCells('J154:J159');
        $this->excel->getActiveSheet()->setCellValue("J154", "=10*SUM(G154:G159)/COUNT(E154:E159))");
        $this->excel->getActiveSheet()->mergeCells('J160:J172');
        $this->excel->getActiveSheet()->setCellValue("J160", "=10*SUM(G160:G172)/COUNT(E160:E172))");
        $this->excel->getActiveSheet()->mergeCells('J173:J186');
        $this->excel->getActiveSheet()->setCellValue("J173", "=10*SUM(G173:G186)/COUNT(E173:E186))");
        //                $this->excel->getActiveSheet()->mergeCells('J157:J172');
        //                $this->excel->getActiveSheet()->setCellValue("J157", "=10*SUM(G157:G172)/COUNT(E157:E172))");
        $this->excel->getActiveSheet()->getStyle('J12:J186')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        // $this->excel->getActiveSheet()->mergeCells('C145:C148');
        // $this->excel->getActiveSheet()->mergeCells('C149:C152');

        $this->excel->getActiveSheet()->mergeCells('K12:K21');
        $this->excel->getActiveSheet()->mergeCells('K22:K26');
        $this->excel->getActiveSheet()->mergeCells('K27:K33');
        $this->excel->getActiveSheet()->mergeCells('K34:K45');
        $this->excel->getActiveSheet()->mergeCells('K46:K52');
        $this->excel->getActiveSheet()->mergeCells('K53:K60');
        $this->excel->getActiveSheet()->mergeCells('K61:K71');
        $this->excel->getActiveSheet()->mergeCells('K72:K81');
        $this->excel->getActiveSheet()->mergeCells('K82:K84');
        $this->excel->getActiveSheet()->mergeCells('K85:K88');
        $this->excel->getActiveSheet()->mergeCells('K89:K95');
        $this->excel->getActiveSheet()->mergeCells('K96:K100');
        $this->excel->getActiveSheet()->mergeCells('K101:K104');
        $this->excel->getActiveSheet()->mergeCells('K105:K110');
        $this->excel->getActiveSheet()->mergeCells('K111:K115');
        $this->excel->getActiveSheet()->mergeCells('K116:K118');
        $this->excel->getActiveSheet()->mergeCells('K119:K123');
        $this->excel->getActiveSheet()->mergeCells('K124:K127');
        $this->excel->getActiveSheet()->mergeCells('K128:K133');
        $this->excel->getActiveSheet()->mergeCells('K134:K145');
        $this->excel->getActiveSheet()->mergeCells('K146:K153');
        $this->excel->getActiveSheet()->mergeCells('K154:K159');
        $this->excel->getActiveSheet()->mergeCells('K160:K172');
        $this->excel->getActiveSheet()->mergeCells('K173:K186');

        $this->excel->getActiveSheet()->mergeCells('L12:L21');
        $this->excel->getActiveSheet()->setCellValue("L12", "=J12*K12");
        $this->excel->getActiveSheet()->mergeCells('L22:L26');
        $this->excel->getActiveSheet()->setCellValue("L22", "=J22*K22");
        $this->excel->getActiveSheet()->mergeCells('L27:L33');
        $this->excel->getActiveSheet()->setCellValue("L27", "=J27*K27");
        $this->excel->getActiveSheet()->mergeCells('L34:L45');
        $this->excel->getActiveSheet()->setCellValue("L34", "=J34*K34");
        $this->excel->getActiveSheet()->mergeCells('L46:L52');
        $this->excel->getActiveSheet()->setCellValue("L46", "=J46*K46");
        $this->excel->getActiveSheet()->mergeCells('L53:L60');
        $this->excel->getActiveSheet()->setCellValue("L53", "=J53*K53");
        $this->excel->getActiveSheet()->mergeCells('L61:L71');
        $this->excel->getActiveSheet()->setCellValue("L61", "=J61*K61");
        $this->excel->getActiveSheet()->mergeCells('L72:L81');
        $this->excel->getActiveSheet()->setCellValue("L72", "=J72*K72");
        $this->excel->getActiveSheet()->mergeCells('L82:L84');
        $this->excel->getActiveSheet()->setCellValue("L82", "=J82*K82");
        $this->excel->getActiveSheet()->mergeCells('L85:L88');
        $this->excel->getActiveSheet()->setCellValue("L85", "=J85*K85");
        $this->excel->getActiveSheet()->mergeCells('L89:L95');
        $this->excel->getActiveSheet()->setCellValue("L89", "=J89*K89");
        $this->excel->getActiveSheet()->mergeCells('L96:L100');
        $this->excel->getActiveSheet()->setCellValue("L96", "=J96*K96");
        $this->excel->getActiveSheet()->mergeCells('L101:L104');
        $this->excel->getActiveSheet()->setCellValue("L101", "=J101*K101");
        $this->excel->getActiveSheet()->mergeCells('L105:L110');
        $this->excel->getActiveSheet()->setCellValue("L105", "=J105*K105");
        $this->excel->getActiveSheet()->mergeCells('L111:L115');
        $this->excel->getActiveSheet()->setCellValue("L111", "=J111*K111");
        $this->excel->getActiveSheet()->mergeCells('L116:L118');
        $this->excel->getActiveSheet()->setCellValue("L116", "=J116*K116");
        $this->excel->getActiveSheet()->mergeCells('L119:L123');
        $this->excel->getActiveSheet()->setCellValue("L119", "=J119*K119");
        $this->excel->getActiveSheet()->mergeCells('L124:L127');
        $this->excel->getActiveSheet()->setCellValue("L124", "=J124*K124");
        $this->excel->getActiveSheet()->mergeCells('L128:L133');
        $this->excel->getActiveSheet()->setCellValue("L128", "=J128*K128");
        $this->excel->getActiveSheet()->mergeCells('L134:L145');
        $this->excel->getActiveSheet()->setCellValue("L134", "=J134*K134");
        $this->excel->getActiveSheet()->mergeCells('L146:L153');
        $this->excel->getActiveSheet()->setCellValue("L146", "=J146*K146");
        $this->excel->getActiveSheet()->mergeCells('L154:L159');
        $this->excel->getActiveSheet()->setCellValue("L154", "=J154*K154");
        $this->excel->getActiveSheet()->mergeCells('L160:L172');
        $this->excel->getActiveSheet()->setCellValue("L160", "=J160*K160");
        $this->excel->getActiveSheet()->mergeCells('L173:L186');
        $this->excel->getActiveSheet()->setCellValue("L173", "=J173*K173");

        $this->excel->getActiveSheet()->getStyle('L12:L186')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("55");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("80");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth("20");

        $this->excel->getActiveSheet()->setCellValue("L187", "=SUM(L12:L186)");

        $this->excel->getActiveSheet()->getStyle('G12:G186')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J12:L186')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A187:L187')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D12:I186')->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->getStyle('D12:F202'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
        //$this->excel->getActiveSheet()->getStyle('H12:F172'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 

        //$this->excel->getActiveSheet()->getStyle('B12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('A12:A186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B12:B186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('C12:C186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('D12:D186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('E12:E186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('H12:H186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('I12:I186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('J12:J186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('K12:K186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('l12:l186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        //font
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setName('CMIIW');
        $this->excel->getActiveSheet()->getStyle('A10:A11')->getFont()->setName('CMIIW');
        //$this->excel->getActiveSheet()->getStyle('A203')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A187:L187')->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A187')->getFont()->setSize(18);
        $this->excel->getActiveSheet()->getStyle('L187')->getFont()->setSize(18);



        $this->excel->getActiveSheet()->setShowGridlines(False);
        //                $this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul1_" . $user_d . "_" . $namaprov . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_penilaian_tpt_by_user()
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap User');

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "USERID");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA");
        $this->excel->getActiveSheet()->setCellValue("D1", "NAMA PROVINSI");
        $this->excel->getActiveSheet()->setCellValue("E1", "PERSENTASE PENILAIAN");
        $this->excel->getActiveSheet()->setCellValue("F1", "LEMBAR PERNYATAAN");

        //---------------isi disini--------------------

        $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(id) FROM r_mdl1_item) * 100), 2) AS persentase_penilaian,
                CASE
                    WHEN sttment.id != 'null' THEN 'Sudah upload'
                    ELSE 'Belum upload'
                END AS lembar_pernyataan
                FROM
                (
                    SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi 
                    FROM `tbl_user_wilayah` wil
                    JOIN tbl_user us ON wil.iduser = us.id
                    JOIN provinsi pro ON wil.idwilayah = pro.id  
                ) t1
                LEFT JOIN t_mdl1_skor_prov skor ON t1.id = skor.mapid
                LEFT JOIN t_mdl1_sttment_prov sttment ON t1.id = sttment.mapid
                WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                GROUP BY t1.id
                ORDER BY t1.userid";
        $list_data = $this->db->query($sql);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;
        foreach ($list_data->result() as $list) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->userid);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->name);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_provinsi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->persentase_penilaian);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->lembar_pernyataan);
            $index_excelColumn = 0;
            $no++;
            $row++;
        }

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("27");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_peniaian_tpt_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_resume_tpt_by_user()
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Resume User');

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "USERID");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA");
        $this->excel->getActiveSheet()->setCellValue("D1", "NAMA PROVINSI");
        $this->excel->getActiveSheet()->setCellValue("E1", "ASPEK");
        $this->excel->getActiveSheet()->setCellValue("F1", "KESIMPULAN");
        $this->excel->getActiveSheet()->setCellValue("G1", "SARAN");

        //---------------isi disini--------------------

        $sql = "SELECT user.userid AS iduser, user.name AS nama_user, resume_prov.mapid AS mapid, wil.idwilayah AS idwilayah, prov.id AS idprovinsi, prov.nama_provinsi AS nama_provinsi, 
                aspek.id AS idaspek, aspek.nama AS nama_aspek, resume_prov.ksmplan AS kesimpulan, resume_prov.saran AS saran
                FROM t_mdl1_resume_prov resume_prov
                JOIN tbl_user_wilayah wil ON resume_prov.mapid = wil.id
                JOIN tbl_user user ON wil.iduser = user.id
                JOIN r_mdl1_aspek aspek ON resume_prov.aspekid = aspek.id
                JOIN provinsi prov ON wil.idwilayah = prov.id
                ORDER BY iduser, mapid ASC";
        $list_data = $this->db->query($sql);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;
        foreach ($list_data->result() as $list) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->iduser);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_user);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_provinsi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_aspek);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->kesimpulan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->saran);
            $index_excelColumn = 0;
            $no++;
            $row++;
        }

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("27");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_resume_tpt_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
