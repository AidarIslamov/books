$(document).ready(function () {
    const table = $('#data-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        stateSave: true,
        stateDuration: 60 * 60 * 24,
        pageLength: 25,
        ajax: {
            url: `book/list`,
            type: 'POST',
            data: function (data) {

            }
        },
        columns: [
            { data: 'id', title: '' }, // 0
            { data: 'title', title: 'Title' }, // 1
            { data: 'isbn', title: 'ISBN' }, // 2
            { data: 'year', title: 'Year' }, // 3
            { data: 'description', title: 'About', width: '25%' }, // 4
            // { data: 'autors', title: 'Autors' } // 5
        ],
        order: [[0, 'ASC']],
        dom: 'lrtip',
        bPaginate:true,
        bLengthChange: true,
        bInfo : true,
    })


})