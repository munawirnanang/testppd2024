var main = function(){
    controller = "PPD2_bahan_dukung_tpt";
    var datatable = function(){
        
        var table   = $("#dataUser");
        var t_bahan = $("#t_bahan");
       
       
       table.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            var lblkk     = _self.data("nmkk");
            $("#inp_wlyh").val(id);
            $(".lbl_hdr_katewlyh").html("").parent("tr").show();
            $(".lbl_hdr_nmwlyh").html(lblkk).parent("tr").show();
            g_bahan();
        });  
       
        function g_bahan(){
             loading.show();
             ajax_url = controller+"/g_bahan";
             ajax_data="id="+$("#inp_wlyh").val();
             ajax_data+="&"+csrf_name+"="+$("#csrf").val();
             jQuery.ajax({
                 type: "POST",
                 url: base_url+ajax_url,
                 dataType:"text",
                 data:ajax_data,
                 success:function(response){
                     var obj = null;
                     try
                     {
                         obj = $.parseJSON(response);  
                     }catch(e)
                     {}

                     if(obj)
                     {
                         $("#csrf").val(obj.csrf_hash);
                         if(obj.status === 1){
                             $("#t_bahan > tbody").html(obj.str);
                             $("._wrapper_wlyh").hide();
                             $("._wrapper_info").show();
                            //  $("._wrapper_bahan").show();
                             $("._wrapper_bahan").css("display", "block");
                             $(".list_kabko").fadeIn();
                             loading.hide();
                         }
                         else if(obj.status === 0){
                             loading.hide();
                             sweetAlert("Error", obj.msg, "error");
                         }
                         else if(obj.status === 2){
                             sweetAlert("Caution", obj.msg, "warning");
                             window.setTimeout(function(){
                                 window.location.href = base_url+"welcome";
                             }, 2000);
                         }

                     }
                     else{
                         sweetAlert("Caution", response, "error");
                         loading.hide();
                         window.setTimeout(function(){
                             window.location.href = base_url+"welcome";
                         }, 2000);
                         return false;
                     }
                 },
                 error:function (xhr, ajaxOptions, thrownError){
                     loading.hide(); 
                     alert(thrownError);
                     return false;
                 }
             });
         }g_bahan();
         
         $("#btnShwMdlSindiAdd").click(function(){
             window.open(base_url+controller+"/d_bahan?wl="); 
          
        });
        
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();