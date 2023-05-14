<?php
include("./includes/header.php");
?>
<?php
$records = array(
    "0" => array("Parvez", "PHP", "12"),
    "1" => array("Devid", "Java", "34"),
    "2" => array("Ajay", "Nodejs", "22")
);
array_push($records,array("Tonmoy", "Nodejs", "22"));

print_r($records[0]);
if(is_array($records)){
    foreach ($records as $row) {
        $fieldVal1 = mysqli_real_escape_string($conn, $row[0]);
        $fieldVal2 = mysqli_real_escape_string($conn, $row[1]);
        $fieldVal3 = mysqli_real_escape_string($conn, $row[2]);
        $query ="INSERT INTO programming_lang (field1, field2, field3) VALUES ( '". $fieldVal1."','".$fieldVal2."','".$fieldVal3."' )";
        mysqli_query($conn, $query);
    }
}

?>
<?php
include("./includes/footer.php");
?>