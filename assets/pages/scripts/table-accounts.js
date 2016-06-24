var TableDatatablesAjax = function () {

    var initPickers = function () {
        //init date pickers
        $(".from_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('.to_date').datepicker('setStartDate', startDate);
        }).on('clearDate', function (selected) {
            $('.to_date').datepicker('setStartDate', null);
        });

        $(".to_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            $('.from_date').datepicker('setEndDate', endDate);
        }).on('clearDate', function (selected) {
            $('.from_date').datepicker('setEndDate', null);
        });
    }

    var handleRecords = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#accounts"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
                token_name = response.token_name;
                token = response.token;
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": base_url+"accounts/list_data", // ajax source
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
                "columnDefs": [
                    { 'orderable': false, 'targets': [0, 8] },
                    {  className: "text-center", "targets": [ 2,3,4,5 ] }
                    
                  ],
                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},

                buttons: [
                    { extend: 'print', className: 'btn default',
                      exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                                     }
                    },

                    { extend: 'pdf', className: 'btn default', 
                      download: 'open',
                      exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                                     }
                    },

                    { extend: 'excel', className: 'btn default',
                      exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                                     }},
                    { extend: 'csv', className: 'btn default' },

                    {
                        text: 'Reload',
                        className: 'btn default',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload();
                        }
                    }
                ],
            }
        });

          $('#accounts tbody').on('click', 'a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');

            switch(this.name) {
                case "view":
                    window.location = url;
                    break;
                case "edit":
                    window.location = url;
                    break;
                case "delete":
                    bootbox.confirm({ size: 'small', message: "Are you sure?", callback: function(result) {
                        
                        if (result) {
                             $.get(url, function(data) { 
                             }).success(function() {  
                                        notifyU('success','User account deleted.','');
                                        grid.getDataTable().ajax.reload(); 
                                 })

                                .error(function() {
                                    notifyU('error','Something went wrong.','');
                                });
                        }
                    }
                }); 
                    break; 
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        //grid.setAjaxParam("customActionType", "group_action");
        //grid.getDataTable().ajax.reload();
        //grid.clearAjaxParams();

        // handle datatable custom tools
        $('#datatable_ajax_tools > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            initPickers();
            handleRecords();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesAjax.init();
});