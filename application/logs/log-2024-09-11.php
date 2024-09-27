<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-11 13:24:14 --> 404 Page Not Found: Package/css
ERROR - 2024-09-11 13:24:57 --> 404 Page Not Found: Package/css
ERROR - 2024-09-11 13:25:03 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-11 13:25:03 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-11 13:25:08 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
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
                                    WHERE W.`iduser`='781'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='781'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='781'
ERROR - 2024-09-11 13:25:08 --> tptd PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-11 13:25:11 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_daerah_tpt`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_daerah_tpt` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='781'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='781'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='781'
ERROR - 2024-09-11 13:25:11 --> tptd PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-11 13:26:47 --> 404 Page Not Found: Package/css
ERROR - 2024-09-11 13:27:01 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-11 13:28:50 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-11 13:28:55 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-11 13:30:57 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-11 13:31:17 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-11 13:35:15 --> 404 Page Not Found: Package/css
ERROR - 2024-09-11 14:28:11 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 14:28:11 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 14:33:42 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 14:33:42 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:27:14 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:27:14 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:28:16 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:28:16 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:28:20 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:28:20 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:31:01 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:31:01 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:32:14 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:32:14 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:52:42 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:52:42 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:53:44 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:53:44 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:53:48 --> Severity: Notice --> Undefined variable: list_kk C:\xampp 5.6\htdocs\ppd2024\application\views\admin\users\index_tpt_daerah.php 487
ERROR - 2024-09-11 15:53:48 --> Severity: Error --> Call to a member function result() on null C:\xampp 5.6\htdocs\ppd2024\application\views\admin\users\index_tpt_daerah.php 487
ERROR - 2024-09-11 15:53:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:53:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:53:58 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-11 15:53:58 --> 404 Page Not Found: Assets/libs
