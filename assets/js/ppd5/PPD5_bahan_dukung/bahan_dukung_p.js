var main = function(){
    controller = "PPD5_bahan_dukung";
    var datatable = function(){
        
        var table   = $("#dataUser");
        var t_bahan_dukung = $("#t_bahan_dukung");
       
       
      
       
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
                             $("#t_bahan_dukung > tbody").html(obj.str);
                             $("._wrapper_wlyh").hide();
                             $("._wrapper_info").show();
                             $("._wrapper_bahan").show();
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

           $("#btnDowDoc").click(function(){
            var id          = $("#inp_wlyh").val();
            window.open(base_url+controller+"/d_bahan?wl="+id); 
        });

    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();