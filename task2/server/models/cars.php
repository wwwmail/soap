<?php

ini_set("soap.wsdl_cache_enabled", "0");
require_once 'db.php';

class Cars {

    /**
     * @soap
     * @return string
     */
    public function getCars() 
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT auto_info.id, brand.brand as title_brand, model.model as title_model  FROM auto_info "
                . "INNER JOIN model_to_brand ON auto_info.id = model_to_brand.id "
                . "INNER JOIN brand ON brand.id = model_to_brand.brand_id "
                . "INNER JOIN model ON model.id = model_to_brand.model_id");

        return json_encode($result->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @soap
     * @param MyServiceInput $inputParam
     * @return string
     */
    public function getCarById($id) 
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT auto_info.*, brand.brand as title_brand, model.model as title_model  FROM auto_info "
                . "INNER JOIN model_to_brand ON auto_info.id = model_to_brand.id "
                . "INNER JOIN brand ON brand.id = model_to_brand.brand_id "
                . "INNER JOIN model ON model.id = model_to_brand.model_id "
                . "WHERE auto_info.id = $id");

        return json_encode($result->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @soap
     * @param MyServiceInput $inputParam
     * @return string
     */
    public function getSearchCars($year = '', $brand = '') 
    {
        if (empty($year)) {
            return json_encode(array('error' => 'year is require fields'));
        }

        $db = DB::getInstance();
        $addSql = '';

        if (!empty($brand)) {
            $addSql = " AND brand.brand = '$brand'";
        }

        $result = $db->query("SELECT auto_info.*, brand.brand as title_brand, model.model as title_model  FROM auto_info "
                . "INNER JOIN model_to_brand ON auto_info.id = model_to_brand.id "
                . "INNER JOIN brand ON brand.id = model_to_brand.brand_id "
                . "INNER JOIN model ON model.id = model_to_brand.model_id "
                . "WHERE auto_info.year = $year " . $addSql);

        return json_encode($result->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @soap
     * @param MyServiceInput $inputParam
     * @return string
     */
    public function createOrder($auto_id, $first_name, $last_name, $payment) 
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO orders (auto_id, first_name, last_name, payment) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $auto_id);
        $stmt->bindParam(2, $first_name);
        $stmt->bindParam(3, $last_name);
        $stmt->bindParam(4, $payment);

        $stmt->execute();

        if (!$stmt->execute()) {
            echo "\nPDO::errorInfo():\n";
            print_r($db->errorInfo());
        }

        if ($stmt->execute() == true) {
            return json_encode(array('succes' => 'true'));
        } else {
            return json_encode(array('succes' => 'false'));
        }
    }

}
