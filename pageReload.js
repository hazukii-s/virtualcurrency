//page refresh voor huidig saldo te kunnen zien
$(document).ready(function () {
    setInterval(reload, 10000);

    function reload() {
        $('#saldo').load('index.php #saldo', function () {
            console.log("reloadddd");
        });
    }
});