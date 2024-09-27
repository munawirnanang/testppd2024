<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-25 09:52:39 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 10:06:06 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 10:06:15 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 10:13:28 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 10:13:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 10:20:46 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 10:20:55 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 10:21:07 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 10:26:48 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 10:26:56 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 10:33:00 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 10:33:46 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-25 10:33:46 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-25 10:33:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-25 10:33:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-25 10:50:45 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 10:50:52 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 10:51:16 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 11:08:27 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 11:08:40 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2024\application\controllers\Home.php 58
ERROR - 2024-09-25 11:08:40 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2024\application\controllers\Home.php 61
ERROR - 2024-09-25 11:08:41 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 11:08:41 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 11:10:20 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 11:10:20 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 11:10:51 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
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
                                    WHERE W.`iduser`='786'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='786'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='786'
ERROR - 2024-09-25 11:10:51 --> tptd3 PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-25 11:15:48 --> 404 Page Not Found: Attachments/bahandukung
ERROR - 2024-09-25 11:15:56 --> 404 Page Not Found: PPD7_bahan_dukung/d_bahan
ERROR - 2024-09-25 13:02:31 --> 404 Page Not Found: PPD7_bahan_dukung/d_bahan
ERROR - 2024-09-25 13:02:36 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 13:47:43 --> Severity: Notice --> Undefined variable: idmap C:\xampp 5.6\htdocs\ppd2024\application\controllers\PPD1_M_Bahan_dukung_daerah.php 346
ERROR - 2024-09-25 13:47:43 --> Severity: error --> Exception: Invalid ID Map C:\xampp 5.6\htdocs\ppd2024\application\controllers\PPD1_M_Bahan_dukung_daerah.php 347
ERROR - 2024-09-25 13:48:07 --> Severity: Notice --> Undefined variable: filename C:\xampp 5.6\htdocs\ppd2024\application\controllers\PPD1_M_Bahan_dukung_daerah.php 394
ERROR - 2024-09-25 13:51:30 --> Severity: Notice --> Undefined variable: filename C:\xampp 5.6\htdocs\ppd2024\application\controllers\PPD1_M_Bahan_dukung_daerah.php 394
ERROR - 2024-09-25 14:03:08 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 14:03:31 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 14:03:53 --> 404 Page Not Found: Attachments/bahandukung
ERROR - 2024-09-25 14:04:04 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 14:04:24 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 14:04:24 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 14:04:33 --> 404 Page Not Found: PPD7_bahan_dukung/d_bahan
ERROR - 2024-09-25 14:18:35 --> 404 Page Not Found: Attachments/bahandukung
ERROR - 2024-09-25 14:18:38 --> 404 Page Not Found: Attachments/bahandukung
ERROR - 2024-09-25 14:27:09 --> 404 Page Not Found: Package/css
ERROR - 2024-09-25 14:27:29 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 14:28:34 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 14:29:12 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 14:29:12 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-25 14:30:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 14:30:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 14:30:39 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-25 14:36:20 --> 404 Page Not Found: Attachments/bahandukung
