<?php
require_once('func.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "giri_db";
$username = "root";
$password = "";

$conn = connect_db($host, $dbname, $username, $password);

$response['data'] = array();
$start = isset($_GET['start']) ? $_GET['start'] : 0;
$length = isset($_GET['length']) ? $_GET['length'] : 10;
$term = isset($_GET['search']) ? $_GET['search']['value'] : '';

$columns = $_GET['columns'];
$order_idx = $_GET['order'][0]['column'];
$order = $columns[$order_idx]['data'];
$order_dir = $_GET['order'][0]['dir'];
//$response['orderby'] = isset($order) ? $columns[$order[0]['column']]['data'] : 'created_at';

$sql = "SELECT so_id, so_trans_id, so_cust_po, so_no, so_tgl_order, so_tgl_butuh, 
    so_cust_kode, cust_nama, so_ket, so_stat
    FROM sls_so_ta sls_so
    INNER JOIN sls_customers_ma customer_ma
    ON sls_so.so_cust_kode = customer_ma.cust_kode ";
if ($term != '') {
    $sql .= "WHERE (cust_nama LIKE '%{$term}%' OR so_no LIKE '%{$term}%')";
}
$sql .= "ORDER BY {$order} {$order_dir} LIMIT :start, :length";

$statement = $conn->prepare($sql);
$statement->execute(['start' => $start, 'length' => $length]);
$sls_order = $statement->fetchAll();
$trans_ids = [];
foreach ($sls_order as $row) 
{
    array_push($trans_ids, $row['so_trans_id']);
} 

$trans_id_criteria = implode("','", $trans_ids);
$sls_order_dtl_query = "SELECT 
so_detail.so_dtl_trans_id AS so_trans_id, produk_ma.prod_nama AS nama_produk, so_detail.so_dtl_prod_qty AS qty, 
pack_ma.pack_nama AS satuan, so_detail.so_dtl_prod_harga AS harga, so_detail.so_dtl_ket AS ket_dtl
FROM sls_so_detil_ta so_detail
INNER JOIN invt_produk_ma produk_ma
ON so_detail.so_dtl_prod_kode = produk_ma.prod_kode
lEFT JOIN invt_produk_pack_ma pack_ma
ON so_detail.so_dtl_prod_pack = pack_ma.pack_kode
WHERE so_detail.so_dtl_trans_id IN ('". $trans_id_criteria ."')";

$sls_dtl_statement = $conn->query($sls_order_dtl_query);
$sls_dtl_order = $sls_dtl_statement->fetchAll();
foreach ($sls_order as $row) { 
    $filtered_so_dtl_order = array_filter($sls_dtl_order, function($dtl_order) use ($row) {
        return $dtl_order['so_trans_id'] == $row['so_trans_id'];
    });
    foreach ($filtered_so_dtl_order as $filtered_row) {
        $row['nama_produk'] = $filtered_row['nama_produk'];
        $row['qty'] = $filtered_row['qty'];
        $row['satuan'] = $filtered_row['satuan']; 
        $row['harga'] = $filtered_row['harga'];
        $row['ket_dtl'] = $filtered_row['ket_dtl'];
        array_push($response['data'], $row);
    }
} 
//$response['data'] = $all_sls_order;
$counter = $conn->query("SELECT COUNT(*) AS total_rows FROM sls_so_ta")->fetch();

$response['draw'] = isset($_GET['draw']) ? $_GET['draw'] : 1;
$response['recordsTotal'] = $counter['total_rows'];
$response['recordsFiltered'] = $counter['total_rows'];

echo json_encode($response);
?>