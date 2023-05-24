<?php 

class Event {
    public $id;
    public $price;
    public $type;
    public $numOfGuests;
    public $date;
    public $restaurant;

    public function __construct($id = null, $price = null, $type = null, $numOfGuests=null, $date = null, $restaurant)
    {
        $this->id = $id;
        $this->price = $price;
        $this->type = $type;
        $this->numOfGuests=$numOfGuests;
        $this->date = $date;
        $this->restaurant = $restaurant;
    }

	public static function getAllEvents($db,$condition){
		$query="SELECT * FROM event e JOIN restaurant r  ON e.restaurantId=r.id".$condition;
		$query=trim($query);
        $result=$db->query($query) or die($db->error);
        $array=[];
        while($res = $result->fetch_assoc()){
			$restaurant=new Restaurant($res['restaurantId'],$res['password'],$res['name']);
			$event=new Event(99,$res['price'],$res['type'],$res['numOfGuests'],$res['date'],$restaurant);
            array_push($array,$event);
            }
        return $array;
    }

    public function AddEvent($data,$db){
		if($data['price'] === '' || $data['type'] === '' || $data['numOfGuests']==='' || $data['date'] === ''){
            echo '<script>alert("Some filds are empty!")</script>';
		}else{
            $restaurantId = isset($data['restaurantId']) && is_numeric($data['restaurantId']) ? intval($data['restaurantId']) : null;
        if ($restaurantId === null) {
            echo '<script>alert("Invalid restaurant ID!")</script>';
        } else {

    $save=$db->query("INSERT INTO event(price, type, numOfGuests, date,  restaurantId) VALUES ('".$data['price']."','".$data['type']."','".$data['numOfGuests']."','".$data['date']."','".$data['restaurantId']."')");
    
    if($save){
        echo '<script>alert("Event added succsecfully!")</script>';
    }else{
        echo '<script>alert("ERROR, event is not added!")</script>';
    }
    
    }
		}
	}
    }


?>

