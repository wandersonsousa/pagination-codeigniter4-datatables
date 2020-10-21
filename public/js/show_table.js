$(document).ready(function () {
    $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url":  window.location.href + "home/json",
            "dataType": "json",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "body" }
        ]

    });
});