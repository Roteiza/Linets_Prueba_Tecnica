<?php
require_once('Models/Home.php');

class HomeController
{
    public function Index()
    {
        require_once 'Views/Layouts/body.php';
    }

    public function CreateCsv()
    {
        $home = new Home();
        $sql = 'SELECT model,sku,price,name,attribute_color FROM master_products_configurable';
        
        $res = $home->queryExecute($sql);
        
        $delimiter = ",";
        $filename = "members_" . date('Y-m-d') . ".csv";
        
        //create a file pointer
        $f = fopen('php://memory', 'wr+');
        
        //set column headers
        $fields = array('model', 'sku', 'price', 'name', 'attribute_color');
        fputcsv($f, $fields, $delimiter);
        
        //output each row of the data, format line as csv and write to file pointer
        while($row = $res->fetchArray()){
            // $status = ($row['status'] == '1')?'Active':'Inactive';
            $lineData = array($row['model'], $row['sku'], $row['price'], $row['name'], $row['attribute_color']);
            fputcsv($f, $lineData, $delimiter);
        }
        
        //move back to beginning of file
        fseek($f, 0);
        
        //set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        
        //output all remaining data on a file pointer
        fpassthru($f);

        // header('Location: '.BASE_URL);
    }
}