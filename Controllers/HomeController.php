<?php
require_once('Models/Home.php');

class HomeController
{
    public function Index()
    {
        require_once 'Views/Layouts/body.php';
    }

    /**
     * Recuperar los datos de la BD, generar y exportar un archivo CSV
     * @return file - CSV File
    */
    public function CreateCsv()
    {
        $home = new Home();
        
        $sql  = "SELECT model,sku,price,name, group_concat('sku=' || sku || ',' || 'color='||attribute_color, '|') AS attribute_color ";
        $sql .= "FROM master_products_configurable ";
        $sql .= "GROUP BY model";
        
        $res = $home->queryExecute($sql);
        
        $delimiter = ",";
        $filename  = "linets_output_" . date('Y-m-d') . ".csv";        

        // Crear archivo
        $f = fopen('php://memory', 'w');
        
        // Columnas cabecera
        $fields = array('sku', 'name', 'price', 'configurable_variatons');
        fputcsv($f, $fields, $delimiter);
                
        // Generar cada fila de datos y formatera como CSV
        while($row = $res->fetchArray()) {
            $lineData = array($row['model'], $row['name'], $row['price'], $row['attribute_color']);
            fputcsv($f, $lineData, $delimiter);
        }
        
        // Volver al inicio del archivo
        fseek($f, 0);
        
        // Definir encabezados para descargar el archivo en lugar de mostrarse
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        
        // Limpiar buffer de salida 
        ob_end_clean();
        
        // Generar todos los datos restantes en un puntero de archivo
        fpassthru($f);

        exit();
    }
}