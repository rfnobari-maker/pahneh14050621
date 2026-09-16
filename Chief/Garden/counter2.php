<?php 
include('../../login/config.php');
class CityData {
    private $dbh;
    private $id_ostan;
    private $z_sal;

    public function __construct($dbh, $id_ostan, $z_sal) {
        $this->dbh = $dbh;
        $this->id_ostan = $id_ostan;
        $this->z_sal = $z_sal;
    }

    public function getCityData($id_city) {
        return array(
            'kol_mah' => $this->city_kol_mah($id_city),
            'sum_mah_tol_2' => $this->city_sum_mah_tol($id_city, '2'),
            'sum_mah_tol_1' => $this->city_sum_mah_tol($id_city, '1'),
            'nah_kesh_3' => $this->city_nah_kesh($id_city, '3'),
            'nah_kesh_2' => $this->city_nah_kesh($id_city, '2'),
            'nah_kesh_1' => $this->city_nah_kesh($id_city, '1'),
            'sum_tree' => $this->city_sum_tree($id_city),
            'sum_tree_gb' => $this->city_sum_tree_gb($id_city),
            'sum_tree_b' => $this->city_sum_tree_b($id_city),
            'sum_s_kesht' => $this->sum_s_kesht($id_city),
            'sum_s_kesht_gb' => $this->sum_s_kesht_gb($id_city),
            'sum_s_kesht_b' => $this->sum_s_kesht_b($id_city),
            'garden_count' => $this->Garden_count($id_city),
            'no_garden_gat_2' => $this->no_Garden_gat($id_city, '2'),
            'no_garden_gat_1' => $this->no_Garden_gat($id_city, '1'),
        );
    }

    public function getOstanData() {
        return array(
            'kol_mah' => $this->ostan_kol_mah(),
            'sum_mah_tol_2' => $this->ostan_sum_mah_tol('2'),
            'sum_mah_tol_1' => $this->ostan_sum_mah_tol('1'),
            'nah_kesh_3' => $this->ostan_nah_kesh('3'),
            'nah_kesh_2' => $this->ostan_nah_kesh('2'),
            'nah_kesh_1' => $this->ostan_nah_kesh('1'),
            'sum_tree' => $this->kol_sum_tree(),
            'sum_tree_gb' => $this->kol_sum_tree_gb(),
            'sum_tree_b' => $this->kol_sum_tree_b(),
            'sum_s_kesht' => $this->kol_sum_s_kesht(),
            'sum_s_kesht_gb' => $this->kol_sum_s_kesht_gb(),
            'sum_s_kesht_b' => $this->kol_sum_s_kesht_b(),
            'garden_count' => $this->kol_Garnd_count(),
            'no_garden_gat_2' => $this->kol_no_Garden_gat('2'),
            'no_garden_gat_1' => $this->kol_no_Garden_gat('1'),
        );
    }

    private function city_kol_mah($id_city) {
        return Num2Fa(round(city_kol_mah($this->id_ostan, $id_city, $this->z_sal) * 1, 1));
    }

    private function city_sum_mah_tol($id_city, $type) {
        return Num2Fa(round(city_sum_mah_tol($this->id_ostan, $id_city, $this->z_sal, $type) * 1, 1));
    }

    private function city_nah_kesh($id_city, $type) {
        return Num2Fa(city_nah_kesh($this->id_ostan, $id_city, $this->z_sal, $type));
    }

    private function city_sum_tree($id_city) {
        return Num2Fa(round(city_sum_tree($this->id_ostan, $id_city, $this->z_sal) / 1000, 1));
    }

    private function city_sum_tree_gb($id_city) {
        return Num2Fa(round(city_sum_tree_gb($this->id_ostan, $id_city, $this->z_sal) / 1000, 1));
    }

    private function city_sum_tree_b($id_city) {
        return Num2Fa(round(city_sum_tree_b($this->id_ostan, $id_city, $this->z_sal) / 1000, 1));
    }

    private function sum_s_kesht($id_city) {
        return Num2Fa(round(sum_s_kesht($this->id_ostan, $id_city, $this->z_sal), 1));
    }

    private function sum_s_kesht_gb($id_city) {
        return Num2Fa(round(sum_s_kesht_gb($this->id_ostan, $id_city, $this->z_sal), 1));
    }

    private function sum_s_kesht_b($id_city) {
        return Num2Fa(round(sum_s_kesht_b($this->id_ostan, $id_city, $this->z_sal), 1));
    }

    private function Garden_count($id_city) {
        return Num2Fa(Garden_count($this->id_ostan, $id_city, $this->z_sal));
    }

    private function no_Garden_gat($id_city, $type) {
        return Num2Fa(no_Garden_gat($this->id_ostan, $id_city, $this->z_sal, $type));
    }

    // استان
    private function ostan_kol_mah() {
        return Num2Fa(round(ostan_kol_mah($this->id_ostan, $this->z_sal) * 1, 1));
    }

    private function ostan_sum_mah_tol($type) {
        return Num2Fa(round(ostan_sum_mah_tol($this->id_ostan, $this->z_sal, $type) * 1, 1));
    }

    private function ostan_nah_kesh($type) {
        return Num2Fa(ostan_nah_kesh($this->id_ostan, $this->z_sal, $type));
    }

    private function kol_sum_tree() {
        return Num2Fa(round(kol_sum_tree($this->id_ostan, $this->z_sal) / 1000, 1));
    }

    private function kol_sum_tree_gb() {
        return Num2Fa(round(kol_sum_tree_gb($this->id_ostan, $this->z_sal) / 1000, 1));
    }

    private function kol_sum_tree_b() {
        return Num2Fa(round(kol_sum_tree_b($this->id_ostan, $this->z_sal) / 1000, 1));
    }

    private function kol_sum_s_kesht() {
        return Num2Fa(round(kol_sum_s_kesht($this->id_ostan, $this->z_sal), 1));
    }

    private function kol_sum_s_kesht_gb() {
        return Num2Fa(round(kol_sum_s_kesht_gb($this->id_ostan, $this->z_sal), 1));
    }

    private function kol_sum_s_kesht_b() {
        return Num2Fa(round(kol_sum_s_kesht_b($this->id_ostan, $this->z_sal), 1));
    }

    private function kol_Garnd_count() {
        return Num2Fa(kol_Garnd_count($this->id_ostan, $this->z_sal));
    }

    private function kol_no_Garden_gat($type) {
        return Num2Fa(kol_no_Garden_gat($type, $this->id_ostan, $this->z_sal));
    }
}

?>
