
navigator.permissions.query({name:'camera'}).then(function(result) {
    // alert(result.state);
    if (result.state === 'granted') { 
    } else if (result.state === 'prompt') { 
    } else if (result.state === 'denied') {
        // alert('Camera access denied!')
        $('#cameraaccessdenied').removeClass('d-none') 
    }
});