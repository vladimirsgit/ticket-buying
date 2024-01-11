if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
        function success(position) {
            fetchSunData(position.coords.latitude, position.coords.longitude);
            setInterval(() => {
                fetchSunData(position.coords.latitude, position.coords.longitude);
            }, 5000);
        },
        function error(error_message) {
            // for when getting location fails
            console.error('An error has occured while retrieving location', error_message)
        }
    );
} else {
    console.log('geolocation is not enabled on this browser')
}


function fetchSunData(lat, long){
    fetch(`http://localhost:8080/tickets/parse_sun_data.php?lat=${lat}&long=${long}`).then(response => response.text())
        .then(html => {

        let sundiv = document.getElementById('sun-div');
        sundiv.innerHTML = html;

        let table = sundiv.querySelector('table');

        table.removeAttribute('class');

        table.className = 'table table-hover table-striped table-bordered table-dark';

        }).catch(error => {
            console.error('Error: ', error);
    })
}