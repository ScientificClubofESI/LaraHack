$('#Hackers').DataTable(
    {
        responsive: true,
        dom: "<'ui stackable grid'" +
            "<'row'" +
            "<'eight wide column' B>" +
            "<'right aligned eight wide column'f>" +
            ">" +
            "<'row dt-table'" +
            "<'sixteen wide column'tr>" +
            ">" +
            "<'row'" +
            "<'seven wide column'i>" +
            "<'right aligned nine wide column'p>" +
            ">" +
            ">",
        buttons: [
            'csv', 'excel'
        ],
    }
)
