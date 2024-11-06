    var main = function(){
        controller = "index.php/P_indikator";
        var datatable = function(){
            var table = $("#tblPro");
            var datatable = table.DataTable({
                 "processing": true,
                 "serverSide": true,
                 "ajax":{
                     url :base_url+controller+"/pro_datatable", // json datasource
                     type: "post",  // method  , by default get
                     error: function(){  // error handling
                             $(".employee-grid-error").html("");
                             $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                             $("#employee-grid_processing").css("display","none");
                     },
                     data: function(d){
                     },
                     "dataSrc": function ( json ) {
                         //$("#ttl_qty").val(json.ttl_qty);
                         return json.data;
                     }

                 },
                 "columnDefs": [                  
                     { "targets": 3, "orderable": false },
                     { "width": "8px", "targets": 3}
                 ],
                 "initComplete": function(settings, json) {
     //                console.log(settings);
                 },
                 paging: true,

            });
            mapboxgl.accessToken = 'pk.eyJ1IjoiZnJhbnNhbGFtb25kYSIsImEiOiJja2NlZ2xtMjkwMzgxMzJubm9paGJ5dmMyIn0.QJc2VJF6md9CaTilCmgYag';
            
            
            $(".plhpro").click(function(e){  $('#mdlPro').modal('show'); });
            $("#mdlPro").on('click', '#save_popup', function(e){
                var pro_id="";
                var idpro = $('.checkbox:checked').data("id");  
                $("#inp_proid").val(idpro);

                var   pro_list = "";
                console.log(pro_list=$('.checkbox:checked').map(function() {
                    return this.value;
                }).get().join('|'));
                $("#inp_pro").val(pro_list);
                $("#inp_kab").val("");
                $("#map").val("");
                peta();
                satu();
               // duabelas();empatbelas();lima();empat();tigabelas();tujuh();
                $('#pe_pro').show('');
                $('#pe_kab').show('');
//                $('#tk_pro').show('');
//                $('#tk_radar').show('');
//                $('#tk_kab').show('');
//                
//                $('#jpm_pro').show('');
//                $('#jpm_radar').show('');
//                $('#jpm_kab').show('');
            });
            $(".nosatu").click(function(e){  
                $('#pe_pro_p').show('');
                $('#pe_pro_d').hide('');
                $('#pe_pro_g').hide('');
            });
            
            $(".nodua").click(function(e){  
                $('#pe_pro_p').hide('');
                $('#pe_pro_d').show('');
                $('#pe_pro_g').show('');
//                $('#pe_pro').show('');
//                $('#pe_kab').show('');
            });
            
            function peta(){
                url = controller+"/peta";
                var provinsi = $("#inp_pro");
                var kabupaten = $("#inp_kab");
                data1 = "provinsi="+$("#inp_pro").val()+"&kabupaten="+$("#inp_kab").val();
                
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:data1, //Form variables
                    success:function(response){
                        var obj = jQuery.parseJSON(response);
                        var prp = obj.prop;
                        var data2 =obj.js_geo;
                        //alert(data2);
                        
                        var zoomThreshold = 4;
                        var map = new mapboxgl.Map({
                            container: 'map',
                            style: 'mapbox://styles/mapbox/streets-v11',
    //                        center: [109.390350, -7.303822 ],
                            center: [119.206479, -0.320152],
                            zoom: obj.js_zoom
                        });
                        
                        map.addControl(new mapboxgl.NavigationControl());
                            map.on('load', function () {
                                map.addSource('maine', {
                                    'type': 'geojson',
                                    'data': obj.js_geo
        //                                    'data': 'http://localhost/peppd/assets/js/geojson/indonesia-1100.geojson'
                                });
                                
     map.addLayer({
            'id': 'maine',
            'type': 'fill',
            'source': 'maine',
            'layout': {},
            'paint': {
            'fill-color': [
                'let',
                'density',
                ['/', ['get', 'population'], ['get', 'sq-km']],
                [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    4,
                   [
                        'interpolate',
                        ['linear'],
                        ['var', 'density'],
                        1,
                        ['to-color', '#a80707'],
                        2,
                        ['to-color', '#639407'],
                        3,
                        ['to-color', '#067d80'],
                        4,
                        ['to-color', '#021b6e'],
                        5,
                        ['to-color', '#fcfafa']
                    ]
//,
//                    10
//                    ,
//               [
//'interpolate',
//['linear'],
//['var', 'density'],
//274,
//['to-color', '#eff3ff'],
//1551,
//['to-color', '#08519c']
//]
                ]
            ],
            'fill-opacity': 0.7
            //'fill-opacity': '#a53b28'
            }
    });

                                // Add a layer showing the state polygons.
//                                map.addLayer({
//                                    'id': 'maine',
//                                    'type': 'fill',
//                                    'source': 'maine',
////                                    'maxzoom': zoomThreshold,
//   //                                 'filter': ['==', 'isCounty', true],
//                                    'paint': {
//                                        'fill-color': [
//                                            'interpolate',
//                                                ['linear'],
//                                                ['get', 'population'],
//                                                0,
//                                                '#F2F12D',
//                                                1,
//                                                '#EED322',
//                                                2,
//                                                '#E6B71E',
//                                                3,
//                                                '#DA9C20',
//                                                2500000,
//                                                '#CA8323',
//                                                5000000,
//                                                '#B86B25',
//                                                7500000,
//                                                '#A25626',
//                                                10000000,
//                                                '#8B4225',
//                                                25000000,
//                                                '#723122'
//                                        ],
//                                        'fill-opacity': 0.8
////                                    'fill-color': '#a53b28',
////                                    'fill-opacity': 0.8
//                                }
//                                });
//                                
  
                                

                                map.on('click', 'maine', function (e) {
                                    new mapboxgl.Popup()
                                    .setLngLat(e.lngLat)
                                    .setHTML(
                                        e.features[0].properties.NAME_2
                                    )

                                    .addTo(map);
                                });

                                var stateLegendEl = document.getElementById('state-legend');
                                var countyLegendEl = document.getElementById('county-legend');
       
                            });

                        $('div#form_nsl a[name="n_nsl"]').html(obj.nasional);
                        $('div#form_nsl a[name="n_thn"]').html(obj.tahun_a);
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                         loading.hide(); 
                         alert(thrownError);
                     }
                });
            }peta();
            
            function satu(){
                url = controller+"/pertumbuhan_ekomomi";
                var provinsi = $("#inp_pro");
                var kabupaten = $("#inp_kab");
                data = "provinsi="+$("#inp_pro").val()+"&kabupaten="+$("#inp_kab").val();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:data, //Form variables
                    success:function(response){
                        var obj = jQuery.parseJSON(response);
                        var mm = Highcharts.chart('chart-container-1', {
                            chart: { type: 'line' },
                            title: { "text":obj.text, },
                            subtitle: { "text": obj.sumber, },
                            xAxis: { "categories":obj.categories, },
                            yAxis: {
                                title: { "text": obj.text2, }
                            },
                            plotOptions: {
                                line: {
                                    dataLabels: {
                                        enabled: true
                                    },
                                    enableMouseTracking: false
                                }
                            },
                            series:  obj.series
                        });
                        var pro = Highcharts.chart('chart-container-1-pro', {
                        chart: { type: 'column' },
                        title: { "text":obj.text_pro, },
                        //subtitle: { "text":obj.sumber, },
                        xAxis: { "categories":obj.categories_pro,
                            crosshair: true

                           },
                        yAxis: {
                            min: 0,
                            title: { "text":obj.text_pro, }
                        },
                        tooltip: {
                            headerFormat:'<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                         '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series:  obj.series_pro
                    });
                        var kab = Highcharts.chart('chart-container-1-kab', {
                            chart: { type: 'column' },
                            title: { "text":obj.text_kab, },
                            //subtitle: { "text":obj.sumber, },
                            xAxis: { "categories":obj.categories_kab,
                                crosshair: true

                               },
                            yAxis: {
                                min: 0,
                                title: { "text":obj.text_kab, }
                            },
                            tooltip: {
                                headerFormat:'<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                             '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series:  obj.series_kab
                        });
                       
                       $('form#form_ch p[name="ket"]').html(obj.ket);
                       $('form#form_pe p[name="perkpdrkp"]').html(obj.pe_rkpd_rkp);
                       $('form#form_pe p[name="maxpep"]').html(obj.max_pe_p);
                       $('form#form_pe_per p[name="per_pro"]').html(obj.pe_perbandingan_pro);
                       $('form#form_pe_perk p[name="per_kab"]').html(obj.pe_perbandingan_pro);
                       
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                         loading.hide(); 
                         alert(thrownError);
                     }
                });
            }satu();
            
        };

   
    return{
        init:function(){datatable();},
       // detail:function(){chart();},
    };
    }();