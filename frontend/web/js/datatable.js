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
            { data: 'author', title: 'Autors' } // 5
        ],
        columnDefs: [
            {
                target: 5,
                render: function (data, type, row, meta) {
                    if(data) {
                        let authors = '';
                        data.forEach((user) => {
                            authors += user.username + '<br>'
                        })
                        return authors;
                    }
                    return null;
                }
            }
        ],
        order: [[0, 'ASC']],
        dom: 'lrtip',
        bPaginate:true,
        bLengthChange: true,
        bInfo : true,
    })

    // Begin filters
    const filterForm = $('#table_filter');
    let state = table.state.loaded();
    if (state && state.columns) {
        $.each(state.columns, function (i, val) {
            let input = $('[data-col-index="' + i + '"]');

            input.val(val.search.search);
        });
    }

    filterForm.submit(function (e) {
        e.preventDefault();

        let params = {};

        $('[data-col-index]').each(function () {
            let i = $(this).data('col-index');

            if (params[i]) {
                params[i] += '|' + $(this).val();
            } else {
                params[i] = $(this).val();
            }
        });

        $.each(params, function (i, val) {
            table.column(i).search(val ? val : '', false, false);
        });

        table.table().draw();
    });

    filterForm.bind('reset', function () {
        setTimeout(function () {
            $('[data-col-index]').each(function () {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            table.state.clear();
            table.table().draw();
        }, 1);
    });
    // END filters


})