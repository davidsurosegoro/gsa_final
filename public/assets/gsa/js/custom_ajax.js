
$(document) .ajaxStart(function () {
    $('#loading').removeClass('d-none')
    console.log('start')
})          .ajaxStop(function () {
    $('#loading').addClass('d-none')
    console.log('stop')
}); 
navigator.permissions.query({name:'camera'}).then(function(result) {
    // alert(result.state);
    if (result.state === 'granted') { 
    } else if (result.state === 'prompt') { 
    } else if (result.state === 'denied') {
        // alert('Camera access denied!')
        $('#cameraaccessdenied').removeClass('d-none') 
    }
});