accounting.settings = {
    currency: {
        symbol : "Rp",
        format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
        decimal : ",",  // decimal point separator
        thousand: ".",  // thousands separator
        precision : 2   // decimal places
    },
    number: {
        precision : 0,  // default precision on numbers is 0
        thousand: ".",
        decimal : ","
    }
}        

$('document').ready(function(){      
    var base_uri = window.location.origin;
    var sls_order = $('#table_sls_order').DataTable({
         /** 
        "initComplete": function(settings, json) {
            console.info('init completed');
            settings.dom =  'Bfrtip',
            settings.buttons =  [
                {
                    text: 'My button',
                    action: function ( e, dt, node, config ) {
                        alert( 'Button activated' );
                    }
                }
            ]            
        },   **/
        "dom": 'lBrtip',
        "buttons": [
            {
                extend: "excel",
                text: "Excel",
                action: function(e, dt, node, config) {
                    //put here link export to excel
                    alert('Not supperted yet');
                    return false;
                }
            },
            {
                extend: "pdf",
                text: "PDF",
                action: function(e, dt, node, config) {
                    //put here link export to pdf
                    alert('Not supperted yet');
                    return false;
                }
            },
            {
                extend: "print",
                text: "Print",
                action: function(e, dt, node, config) {
                    //put here link print
                    alert('Not supperted yet');
                    return false;
                }
            }            
        ],           
        "order": [[1, 'desc']],
        "processing": true,
        "serverSide": true,
        "ajax" : base_uri + "/get_data.php",  
        "columns"     : [  
            { 
                "orderable": false,
                "data" : "so_cust_po"
            },  
            { "data" : "so_no"},  
            { "data" : "so_tgl_order"},  
            { "data" : "so_tgl_butuh"}, 
            { 
                "orderable": false,
                "data" : "cust_nama"
            },
            { 
                "orderable": false,
                "data" : "so_ket"
            },
            { 
                "orderable": false,
                "data" : "so_stat"
            },
            { 
                "orderable": false,
                "data" : "nama_produk"
            },
            { 
                "orderable": false,
                "data" : "qty"
            },
            { 
                "orderable": false,
                "data" : "satuan"
            },
            { 
                "orderable": false,
                "data" : "harga",
                "render": function(data) {
                    return accounting.formatMoney(data);
                }
            },
            { 
                "orderable": false,
                "data" : "ket_dtl"
            },
            {
                "orderable": false,
                "data": "so_id",
                "render": function(data, type, row) {   
                    var link = "<a title=\"view order\" href='" + base_uri +
                        "edit?id=" + data + "'>edit</a> |";
                    link += " <a href='"+ base_uri +"delete?id="+ data +"' title='edit order'>hapus</a>";
                    if (row.status == 'draft') {
                        link += " <a href=\"#\" title=\"delete order\" class=\"btn btn-danger btn-doctor-delete\" data-id=\""+ data + "\"><i class=\"fa fa-times\"></i></a>";
                    }
                    return link;
                },        
            },    

         ]
    }); 

    $('#form-search').on( 'keyup', function () {
        sls_order.search( this.value ).draw();
    } );    
});
