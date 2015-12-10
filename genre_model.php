<?php

include_once "a_model.php";

class Genre extends Model{

	function __construct(){
		$this->_table = "genre";
		$this->_fields = "genre";
		parent::__construct();
	}

	function add_one($array){
		$data = $array['data'];

    	$query = "INSERT INTO `$this->_db`.`$this->_table` (`$this->_fields`) VALUES (?)";

   		$stmt = mysqli_prepare($this->_c, $query);

        if ($stmt) {
            $count_i = count($data);
            for ($i=0; $i < $count_i; $i++) { 
                $count_j = count($data[$i]);
                for ($j=0; $j < $count_j; $j++) {
                    mysqli_stmt_bind_param($stmt, 's', $data[$i][$j]);
                    mysqli_stmt_execute($stmt);
                }
            }
            return printf("Rows inserted: %d\n", $count_i);  //mysqli_stmt_affected_rows($stmt));
    	    mysqli_stmt_close($stmt);
        }
        else return printf("Position do not added to the table $table :( %s\n", mysql_error());
}
}

// $data = array(
//     'data' => array(
//         array('Роман'),
//         array('Рассказ'),
//     )
// );

$new_genre = new Genre();
print_r($new_genre->add_one($data));
