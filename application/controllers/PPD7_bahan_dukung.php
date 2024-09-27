<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Penilaian Modul 1 oleh TPTD Provinsi
* author : MMA
 * date : 19 Sep 2024
*/
class PPD7_bahan_dukung extends CI_Controller
{
    var $view_dir   = "ppd7/PPD7_bahan_dukung/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd7/PPD7_bahan_dukung/ppd7.js";
    var $allowed    = array("PPD7");

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library("Excel");
        $this->load->library('zip');
    }


    public function index()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session expired, please login", 2);
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //common properties
                $this->js_init    = "main";
                $this->js_tedit    = "main";
                $this->js_path    = "assets/js/ppd7/PPD7_bahan_dukung/bahan_dukung.js?v=" . now("Asia/Jakarta");


                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_bahan_tptd", $data_page, TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init . ".init();",
                    //"js_tedit"    =>  $this->js_tedit.".tble();",
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

    /*
     * list data Bahan Dokumen
     * author :  MMA
     * date : 20 sep 2024
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
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }

                $group = $this->session->userdata(SESSION_LOGIN)->group;
                $satker = $this->session->userdata(SESSION_LOGIN)->satker;

                // $sql = "SELECT K.`id`,K.`nama_kabupaten`,P.`id` provid,P.`nama_provinsi` FROM `kabupaten` K JOIN `provinsi` P ON P.id_kode= K.`prov_id` WHERE P.id=?";
                $sql = "SELECT P.* FROM provinsi P WHERE P.id=?";
                $bind = array($satker);
                $list_data = $this->db->query($sql, $bind);
                if ($list_data->num_rows() == 0)
                    throw new Exception("Data Kabupaten/Kota tidak ditemukan!", 0);
                $provid     = $list_data->row()->id; //nama provinsi

                $link = base_url() . "attachments/bahandukung/";
                $sql = "SELECT * FROM (
                                SELECT '1' kate ,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                                FROM `t_doc` D  
                                JOIN `t_doc_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                WHERE U.id=? AND D.isactive = 'Y') AS a
                                UNION
                                SELECT * FROM (
                                SELECT '2' kate ,PK.id mapid, PK.judul, PK.tautan,PK.cr_by, PK.cr_dt
                                FROM `t_dok_pkk` PK 
                                WHERE PK.provid =? AND PK.isactive = 'Y') AS b
                        ORDER BY kate, mapid ASC";

                $bind = array($group, $provid);
                $list_data = $this->db->query($sql, $bind);

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL #1!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";

                $no = 1;
                $lnk = 'https';
                foreach ($list_data->result() as $v) {
                    $val_link = base_url("attachments/bahandukung/" . $v->tautan);
                    $idcomb = $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->judul . "'";
                    //$downl= $link.$v->tautan;
                    //                    if(substr($v->tautan,0, 5)=='https'){
                    //                        $link=$v->tautan;
                    //                    }
                    //                    else {
                    //                        $tautan= substr($v->tautan, 4);
                    //                        $link = $lnk.$tautan;
                    //                    }

                    if (substr($v->tautan, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                    } elseif (substr($v->tautan, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                    } elseif (substr($v->tautan, -3) == 'pdf') {
                        $rename = $v->judul . ".pdf";
                    } elseif (substr($v->tautan, -3) == 'xls') {
                        $rename = $v->judul . ".xls";
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $rename = $v->judul . ".xlsx";
                    } elseif (substr($v->tautan, -3) == 'doc') {
                        $rename = $v->judul . ".doc";
                    } elseif (substr($v->tautan, -4) == 'docx') {
                        $rename = $v->judul . ".docx";
                    } elseif (substr($v->tautan, -3) == 'png') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->tautan, -3) == 'PNG') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->tautan, -3) == 'jpg') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -3) == 'JPG') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->tautan, -4) == 'jfif') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    }

                    // $str.="<tr class='bg-secondary' title='Dokumen'>";
                    $str .= "<tr class='' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black' title='Dokumen'>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $no++ . "</td>";
                    // $str.="<td  class='text-uppercase'>".wordwrap($v->judul,50,"<br/>")."</td>";
                    $str .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $v->judul . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $v->cr_by . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $v->cr_dt . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='btn btn-xs text-primary' title='Unduh Data'><i class='fas fa-download'></i></a></td>";
                    $str .= "</tr>";
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
}
