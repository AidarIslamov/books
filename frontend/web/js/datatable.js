$(document).ready(function () {
    const onlyMyFilter = $('#only_my')

    const table = $('#data-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        stateSave: true,
        stateDuration: 60 * 60 * 24,
        pageLength: 25,
        ajax: {
            url: `book/list-data-table`,
            type: 'POST',
            data: function (data) {
                if(onlyMyFilter.length) {
                    data.only_my = onlyMyFilter.is(':checked')
                }

            }
        },
        columns: [
            { data: 'id', title: '' }, // 0
            { data: 'image_name', title: 'Image' }, // 1
            { data: 'title', title: 'Title' }, // 2
            { data: 'isbn', title: 'ISBN' }, // 3
            { data: 'year', title: 'Year' }, // 4
            { data: 'description', title: 'About', width: '25%' }, // 5
            { data: 'author', title: 'Autors', searchable: false, orderable: false }, // 6
            { data: null, searchable: false, orderable: false } // 7
        ],
        columnDefs: [
            {
                target: 1,
                className: 'text-center',
                render: function (data, type, row, meta) {
                    if(data) {
                        return `<img class="book_image" src="${URL_image_path + data}" alt="${row.title}">`
                    }
                    return null;
                }
            },
            {
                target: 6,
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
            },
            {
                target: 7,
                // visible: window.hasOwnProperty('USER'),
                render: function (data, type, row, meta) {
                    if(window.hasOwnProperty('USER')) {
                        if(row.author.find(o => o.id === window.USER.id)) {
                            return (
                                `<a href='${URL_edit_book}/${row.id}' >Edit</a> <br> <a href='${URL_edit_book}/${row.id}' class="delete_book_btn" >Delete</a>`
                            )
                        }
                    }
                    else {
                        return `<a href='book/subscribe/${row.id}' >Subscribe</a> <br><a href="${URL_book_read_path}/${row.id} " >Read</a>`
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


    // Begin book delete
    $(document).on('click', '.delete_book_btn', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        if(confirm('You sure?')) {
            $.ajax({
                url,
                method: 'DELETE'
            }).then(()=>{
                table.table().draw();
            })
        }

    })
    // END book delete

})