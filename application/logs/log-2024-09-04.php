<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-04 09:48:48 --> 404 Page Not Found: Package/css
ERROR - 2024-09-04 10:20:41 --> 404 Page Not Found: Package/css
ERROR - 2024-09-04 10:20:49 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-04 10:20:50 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-04 10:21:00 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
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
ERROR - 2024-09-04 10:21:00 --> tptd PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-04 10:21:02 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
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
ERROR - 2024-09-04 10:21:02 --> tptd PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-04 10:21:04 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
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
ERROR - 2024-09-04 10:21:04 --> tptd PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-04 10:21:06 --> Query error: Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
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
ERROR - 2024-09-04 10:21:06 --> tptd PPD7_modul1 : Table 'peppd_ppd2024.tbl_user_daerah_tpt' doesn't exist
ERROR - 2024-09-04 10:21:13 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-04 10:21:13 --> 404 Page Not Found: Assets/js