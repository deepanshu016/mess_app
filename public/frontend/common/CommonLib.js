const CommonLib = {
    ajaxForm:function(formData,method,url) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        return $.ajax({
            type: method,
            url: url,
            data:formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function() {;},
            success: function(d){;}
        });
    },
    notification:{
        success:function(message){
            return toastr.success(message, "Success", {
                closeButton: true,
                debug: false,
                newestOnTop: false,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "1000",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            });
        },
        error:function(message){
            return toastr.error(message, "Failure", {
                closeButton: true,
                debug: false,
                newestOnTop: false,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "1000",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            });
        },
        warning:function(message){
            return toastr.warning(message, "Info", {
                closeButton: true,
                debug: false,
                newestOnTop: false,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "1000",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            });
        },
    },
    sweetalert:{
        confirm:function(formData,method,url){
            swal({
                title: "Are you sure ?",
                text: "Data can't be reverted",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true
            }).then((result) => {
                if (result.value) {
                    CommonLib.ajaxForm(formData,method,url).then(d=>{
                        if(d.status === 200){
                            CommonLib.notification.success(d.msg);
                            window.location = d.url;
                        }
                    }).catch(e=>{
                        CommonLib.notification.error(e.errors);
                    });
                } else if (result.dismiss === 'cancel') {
                    CommonLib.notification.warning("Action Cancelled!!!");
                }
            })
        },
        success:function(){

        },
    },
    baseUrl:()=>{
        var base_url = window.location;
        console.log(base_url);
    },
    truncateString:(str, maxLength)=>{
        if (str.length > maxLength) {
            return str.substring(0, maxLength) + "...";
        }
        return str;
    }
}
