$(document).ready(function() {
    loadTickets();

    function loadTickets() {
        $.ajax({
            url: "get_tickets.php",
            type: "GET",
            success: function(response) {
                $("#tickets-container").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Ошибка при загрузке заявок: " + error);
            }
        });
    }
});