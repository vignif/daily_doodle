<?

global $debug;
$debug = false;

class File{
/*
RESPONSABILITIES:
open and close file
encode and decode to php array the content of the file
open -> decode
work on decoded array
encode -> save -> close
*/
  public $filename = "db.json";
  public $json_decoded;
  public $debug=false;
  function __construct(){
    //return a decoded version of the file in construct
    $json_encoded = file_get_contents($this->filename);
    $this->json_decoded = json_decode($json_encoded,true); //obtain a decoded array
  }
  function update($data){ //$data is still an array, must be encoded before saving
    $data_encoded = json_encode($data,JSON_FORCE_OBJECT);
    if (file_put_contents($this->filename,$data_encoded)){
      if ($this->debug){echo "file saved";}
    }
  }
  function size(){
    print count($this->json_decoded);
  }
}



class Json_Obj{

  /*
  RESPONSABILITIES:
  store and manipulate values inside the json php variable array
  */
  public $data;
  private $N;
  public $debug =false;
  function __construct($data){
    $this->data = $data;
    $this->N = count($data);
  }
  function add($new_data){
    if($this->debug){echo "</br>add new element </br>";}
    array_push($this->data,$new_data);
    // return $this->data;
  }

  function remove($id){
    if($this->debug){echo "<br>remove element in id $id<br>";}
    unset($this->data[$id]);
    return $this->data;
  }

  function delete_all(){
    for ($i=0; $i < $this->N; $i++){
      if($this->debug){ echo $i;}
      $this->remove($i);
    }
  }





  function show(){

    echo "</br>SHOW<br>";
    print "the array has size ";
    echo count($this->data);
    echo "<br>";
    foreach ($this->data as $key => $value) {
      print_r($value);
      echo "<br>";
    }
    echo "<br>";
  }

}

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

/**
*
* Get times as option-list.
*
* @return string List of times
*/
function get_times( $default , $interval = '+30 minutes' ) {
  $output = '';
  $current = strtotime( '00:00' );
  $end = strtotime( '23:59' );
  while( $current <= $end ) {
      $time = date( 'H:i', $current );
      $sel = ( $time == $default ) ? ' selected' : '';

      $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
      $current = strtotime( $interval, $current );
  }
  return $output;
}

function print_response(){

  echo $_POST["name"],"\n";
  echo $_POST["email"],"\n";
  echo $_POST["date"],"\n";
  echo $_POST["from"],"\n";
  echo $_POST["to"],"\n";
}

$file = new File();
$data = $file->json_decoded; //store array
$data_arr = new Json_Obj($data); //create instance of Json_Obj with data from file

//run all updates
if (isset($_POST['delAll'])){
    $data_arr->delete_all();
    $del= true;
}

if (isset($_POST['delete'])){
  $id = $_POST['delete'];
  $data_arr->remove($id);
  $del= true;
}

if (isset($_POST['insert'])) {
  $arr = array(
    'name'     => $_POST['name'],
    'email'    => $_POST['email'],
    'date'    => $_POST['date'],
    'from' => $_POST['from'],
    'to'    => $_POST['to']
  );
  $data_arr->add($arr);
  //insert to file
      $insert = true;
}
if (isset($insert) || isset($del)){
  $file->update($data_arr->data);
}
$file = new File();
$data = $file->json_decoded; //store array
$data_arr = new Json_Obj($data); //create instance of Json_Obj with data from file

?>
