function updatepenerima(){
    $.ajax({
        method  :'POST',
        url     :'{{ url('awb/updatediterima') }}',
        data    :{
            kode            : $('#kodeawb_penerima').val(),
            diterima_oleh   : $('#diterima_oleh').val(),
            '_token'        : "{{ csrf_token() }}" 
        },
        success:function(data){ 
            if(data.statussuccess)  {
                toastr.success( data.statussuccess) 
                $('#modalpenerima').modal('hide');
                $('#diterima_oleh'      ).val('')
            }   
                setTimeout(function(){ scanner.start() }, 800); 
        }
    }) 
}