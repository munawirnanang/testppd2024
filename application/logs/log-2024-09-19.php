<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-19 11:35:09 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 13:31:58 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 13:46:09 --> Severity: Parsing Error --> syntax error, unexpected end of file, expecting function (T_FUNCTION) C:\xampp 5.6\htdocs\ppd2024\application\controllers\PPD1_M_Bahan_dukung_daerah.php 58
ERROR - 2024-09-19 13:49:07 --> Severity: Parsing Error --> syntax error, unexpected end of file, expecting function (T_FUNCTION) C:\xampp 5.6\htdocs\ppd2024\application\controllers\PPD1_M_Bahan_dukung_daerah.php 58
ERROR - 2024-09-19 13:49:11 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-19 13:49:11 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-19 13:49:23 --> Severity: Parsing Error --> syntax error, unexpected end of file, expecting function (T_FUNCTION) C:\xampp 5.6\htdocs\ppd2024\application\controllers\PPD1_M_Bahan_dukung_daerah.php 58
ERROR - 2024-09-19 13:49:25 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-19 13:49:25 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-19 14:06:54 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:07:35 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:08:10 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:09:09 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:09:52 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:09:52 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:09:52 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:09:52 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:09:52 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:10:12 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:11:46 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:12:00 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:12:00 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:12:00 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:12:00 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:12:00 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:12:55 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:13:05 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:15:37 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:16:40 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:16:40 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:16:40 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:16:53 --> 404 Page Not Found: Attachments/kabkota
ERROR - 2024-09-19 14:16:55 --> 404 Page Not Found: Attachments/kabkota
ERROR - 2024-09-19 14:18:23 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:18:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:18:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:18:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:18:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:18:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:19:27 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:19:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:19:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:19:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:21:14 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:21:20 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:21:20 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:21:31 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_daerah_tpt`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_daerah_tpt` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='788'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='788'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='788'
ERROR - 2024-09-19 14:21:31 --> tptdpapua PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-19 14:22:45 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:23:40 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:23:46 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:24:01 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:24:06 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:24:35 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:24:41 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:24:45 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:25:47 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:26:12 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:26:46 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:26:57 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:26:57 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:26:57 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:26:57 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:26:57 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:28:42 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:28:50 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:28:50 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:28:50 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:29:10 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:29:10 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:29:10 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:29:10 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:29:10 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:29:59 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:33:54 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:34:04 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:34:04 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:34:29 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:34:29 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:35:53 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:35:53 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:14 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:14 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:14 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:27 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:28 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:28 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:52 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:52:52 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:56:33 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:57:17 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 14:57:24 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:57:24 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:57:24 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 14:59:01 --> Severity: Notice --> Undefined index: satker_name C:\xampp 5.6\htdocs\ppd2024\application\views\admin\home\home_page_PPD7.php 70
ERROR - 2024-09-19 14:59:02 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:59:02 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 14:59:02 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 15:00:32 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 15:00:32 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 15:00:32 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 15:10:33 --> 404 Page Not Found: Package/css
ERROR - 2024-09-19 15:10:44 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 15:10:44 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 15:10:44 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 15:10:44 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 15:10:44 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-19 15:22:19 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 15:22:20 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-19 15:22:20 --> 404 Page Not Found: Assets/js
