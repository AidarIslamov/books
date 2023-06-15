$(document).ready(function() {
    console.log('ready')
    $('#report-datatable').DataTable({
        order: [[2, 'desc']],
    });
})