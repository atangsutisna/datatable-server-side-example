$('document').ready(function(){  
    var base_uri = window.location.origin;
     $('#table_sls_order').DataTable({
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
                "data" : "harga"
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
});
