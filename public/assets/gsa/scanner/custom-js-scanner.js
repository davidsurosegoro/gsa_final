// var x  		= document.getElementById("myAudio");  
// var scanner = new Instascan.Scanner({ 
//     video 			: document.getElementById('preview'), 
//     scanPeriod 		: 5, 
//     mirror 		 	: false,
//     refractoryPeriod: 1000,
// }); 
		
// Instascan.Camera.getCameras().then(function (cameras){
//     if(cameras.length>0){
//         scanner.start(cameras[0]);
//         $('[name="options"]').on('change',function(){
//             if($(this).val()==1){
//                 if(cameras[0]!=""){
//                     scanner.start(cameras[0]);
//                 }else{
//                     alert('No Front camera found!');
//                 }
//             }else if($(this).val()==2){
//                 if(cameras[1]!=""){
//                     scanner.start(cameras[1]);
//                 }else{
//                     alert('No Back camera found!');
//                 }
//             }
//         });
//     }else{
//         console.error('No cameras found.');
//         alert('No cameras found.');
//     }
// }).catch(function(e){
//     console.error(e);
//     alert(e);
// });

// function toastnew(type , message){
//     if(type==1){
//         $("#myToast").css('background-color', '#a4e0a4');
//         $('.tittletoast').html('SUCCESS')
//     }
//     else if(type==2){ 
//         $("#myToast").css('background-color', '#e0a4a4');
//         $('.tittletoast').html('ERROR')
//     }
//     else if(type==3){ 
//         $("#myToast").css('background-color', '#a4c3e0');
//         $('.tittletoast').html('info')
//     }
//     else if(type==4){ 
//         $("#myToast").css('background-color', '#f5f482');
//         $('.tittletoast').html('warning')
//     }
//     $("#myToast").toast('show');
//     $(".toastsuccess").html(message)
// }



var xs      		= document.getElementById("myAudio");  
const video         = document.getElementById('qr-video');
const camHasCamera  = document.getElementById('cam-has-camera');
const camList       = document.getElementById('cam-list');
const camHasFlash   = document.getElementById('cam-has-flash');
const flashToggle   = document.getElementById('flash-toggle');
const flashState    = document.getElementById('flash-state');
const camQrResult   = document.getElementById('cam-qr-result');  

    // ####### Web Cam Scanning #######

    const scanner = new QrScanner(video, result => setResult(camQrResult, result), error => {
        camQrResult.textContent = error;
        camQrResult.style.color = 'inherit';
    });

    const updateFlashAvailability = () => {
        scanner.hasFlash().then(hasFlash => {
            camHasFlash.textContent = hasFlash;
            flashToggle.style.display = hasFlash ? 'inline-block' : 'none';
        });
    };

    scanner.start().then(() => {
        updateFlashAvailability();
        // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
        // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
        // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
        // start the scanner earlier.
        QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
            const option = document.createElement('option');
            option.value = camera.id;
            option.text = camera.label;
            camList.add(option);
        }));
    });

    QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

    // for debugging
    window.scanner = scanner;
 

    camList.addEventListener('change', event => {
        scanner.setCamera(event.target.value).then(updateFlashAvailability);
    });

    flashToggle.addEventListener('click', () => {
        scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off');
    });

    document.getElementById('start-button').addEventListener('click', () => {
        scanner.start();
    });

    document.getElementById('stop-button').addEventListener('click', () => {
        scanner.stop();
    });

    // ####### File Scanning #######
 