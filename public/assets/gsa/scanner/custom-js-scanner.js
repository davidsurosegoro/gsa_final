var x  		= document.getElementById("myAudio");  
var scanner = new Instascan.Scanner({ 
    video 			: document.getElementById('preview'), 
    scanPeriod 		: 5, 
    mirror 		 	: false,
    refractoryPeriod: 1000,
}); 
		
Instascan.Camera.getCameras().then(function (cameras){
    if(cameras.length>0){
        scanner.start(cameras[0]);
        $('[name="options"]').on('change',function(){
            if($(this).val()==1){
                if(cameras[0]!=""){
                    scanner.start(cameras[0]);
                }else{
                    alert('No Front camera found!');
                }
            }else if($(this).val()==2){
                if(cameras[1]!=""){
                    scanner.start(cameras[1]);
                }else{
                    alert('No Back camera found!');
                }
            }
        });
    }else{
        console.error('No cameras found.');
        alert('No cameras found.');
    }
}).catch(function(e){
    console.error(e);
    alert(e);
});

function toastnew(type , message){
    if(type==1){
        $("#myToast").css('background-color', '#a4e0a4');
        $('.tittletoast').html('SUCCESS')
    }
    else if(type==2){ 
        $("#myToast").css('background-color', '#e0a4a4');
        $('.tittletoast').html('ERROR')
    }
    else if(type==3){ 
        $("#myToast").css('background-color', '#a4c3e0');
        $('.tittletoast').html('info')
    }
    else if(type==4){ 
        $("#myToast").css('background-color', '#f5f482');
        $('.tittletoast').html('warning')
    }
    $("#myToast").toast('show');
    $(".toastsuccess").html(message)
}