window.onload = () => {
    getVisitorData();
    setInterval(getVisitorData, 1000);
}


function getVisitorData(){
    fetch('https://ticketastic.store/analytics.php').then(response => response.json())
        .then(response => {
            let visitDiv = document.getElementById('analytics');

            visitDiv.innerHTML = 'Visitors: ' + response.uniqueVisitors + '<br>Total visits: ' + response.totalVisits;

        }).catch(error => {
        console.error(error);
    })
}
