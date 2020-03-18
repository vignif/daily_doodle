<?
//check common time slots between more persons
//var_dump($tempArray[2]);
//foreach ($tempArray as $key => $value) {
//echo $key;
//}
$tempArray = $data_arr->data;

$sameDate = false;
$solutionExist = false;

$from = array();
$to = array();
if (count($tempArray) >0){
  foreach ($tempArray as $key => $value) {
    $date0 = $tempArray[$key]["date"]; //date to compare first date available
    break;
  }
}
if (count($tempArray) > 0){
  foreach ($tempArray as $key => $v ) {
    //$v = get_object_vars($value);
    if ($date0 == $v["date"] ){
      //continue
      $sameDate = true;
    }
    else {
      //not possible to match
      $sameDate = false;
      $solutionExist = false;

      break;
    }
  }

  if ($sameDate == true){
    foreach ($tempArray as $v) {
      $from[] = $v['from'];
      $to[] = $v['to'];
    }
    $fromMax = max($from);
    $toMin = min($to);
    if ($fromMax < $toMin){
      $solutionExist = true;
    }
  }
}
?>
