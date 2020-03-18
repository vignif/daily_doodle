<?
require("classes.php");
//open file and decode json
$file = new File();
// print_r( $file->json_decoded);
$data = $file->json_decoded; //store array


show_decoded($data);
$toadd["name"] = "CARLO";
$toadd["gender"] = "male";

$data_arr = new Json_Obj($data);
$data_arr->add($toadd); //instance of Json_Obj class


$data_arr->show();
$id=4;
$data_arr->remove($id);

$data_arr->show();

$file->save($data_arr->data);


show_decoded($data_arr->data);


function show_decoded($data_arr){
  echo "</br>SHOW<br>";
  print "the array has size ";
  echo count($data_arr);
  echo "<br>";
  foreach ($data_arr as $key => $value) {
    print_r($value);
    echo "<br>";
  }
  echo "<br>";
}



//
// $JSON = '[{"name":"Jonathan Suh","gender":"male"},{"name":"William Philbin","gender":"male"},{"name":"Allison McKinnery","gender":"female"}]';
//
// file_put_contents("try.json", $JSON);
//
//
// $toadd["name"] = "Francesco";
// $toadd["gender"] = "male";
//
// $data = json_decode($JSON,true);
// array_push($data,$toadd);
//
// $data = json_encode($data); //encode
// file_put_contents("try.json", $data);
//
//
//
//
// class File{
//   public $filename = "try.json";
//   public $obj_arr;
//   function update_file($jsonData){
//     file_put_contents($this->filename, $jsonData);
//   }
//   function get_obj_arr(){
//     $inp = file_get_contents($this->filename);
//     $this->obj_arr = json_decode($inp, true); //decode as array
//     return $this->obj_arr;
//   }
// }

// //
// $data = new Data($JSON);
// //$data = new Data();
// $data->add_to_json($toadd); //add data to json object
// $data->del_from_json(2); //deleted element at index 2 of array
// //$data->show();
// // print_r($data->obj_arr);
// echo "<br>";
//
//
// $f = new File();
// $f->update_file($data->obj_arr);
// $a = $f->get_obj_arr();
// // print_r($a);
// echo "<br>";


//
// $data1 = new Data();
// $f1 = new File();
// $arr = $f1->get_obj_arr();
// echo "<br>";
// print_r($arr);
// echo "<br>";
// $data1->add_to_json($arr);
// $data1->show();
// echo "<br>";
// print_r($data1->obj_arr[0]);


//
// $data = new Data($JSON);
//
// $data->add_to_json($toadd);
// $data->show();
// echo "<br>";
// $add1["name"]="ciccio";
// $add1["gender"]="female";
// $data->add_to_json($add1);
// $data->show();
// //adding element to json object works!
//
// $f = new File();
// $f->update_file($data->obj_arr);


// echo "Test file json routine<br>";
//
// $f = new File();
// $data = new Data();
// //the file has data, fetch it.
// $arr = $f->get_obj_arr(); //associative array
// $data->add_to_json($arr); //added to json object
//
//
// $data->show();
//
// $add1["name"]="ciccio";
// $add1["gender"]="male";
//
// $data->add_to_json($add1);
// $data->show();
//
// $f->update_file($data->obj_arr);

?>
