<?php
class Restaurant
{
    public $id;
    public $name;
    public $password;

    public function __construct($id = null, $name = null, $password = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }

    public static function logIn($restaurant, mysqli $conn)
    {
        $name = $restaurant->name;
        $password = $restaurant->password;
        $query = "SELECT * FROM restaurant WHERE name='$restaurant->name' and password='$restaurant->password'";
      
        return $conn->query($query);
    }

    public function addRestaurant($data, $db)
    {
        if ($data['name'] === '' || $data['password'] === '') {
            echo '<script>alert("Polja ne smeju biti prazna!")</script>';
        } else {
            $save = $db->query("INSERT INTO Restaurant(name, password) VALUES ('".$data['name']."','".$data['password']."')") or die($db->error);
            if ($save) {
                echo '<script>alert("Uspešno ste dodali restoran!")</script>';
            } else {
                echo '<script>alert("Greška prilikom dodavanja restorana! Molimo Vas, pokušajte ponovo!")</script>';
            }
        }
    }

    public static function getAllRestaurants($db)
{
    $query = "SELECT id, name, password FROM restaurant";
    $result = $db->query($query);
    $array = [];
    while ($r = $result->fetch_assoc()) {
        $restaurant = new Restaurant($r['id'], $r['name'], $r['password']);
        array_push($array, $restaurant);
    }
    return $array;
}
}
?>
