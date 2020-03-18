
function delete_json(){
  var filename = 'db.json';

  $.getJSON(filename, function(json) {
    for (i = 0; i < json.length; i++) {
    delete json[i];
  }
  });
}

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  var id = btn.parentNode.parentNode.firstChild.nextElementSibling.innerHTML;
  row.parentNode.removeChild(row);
  var obj = require("./db.json");
  return id;

}

n =  new Date();
y = n.getFullYear();
m = n.getMonth() +1;
d = n.getDate();
h = n.getHours();
mm = n.getMinutes();
document.getElementById("date").innerHTML = d + "/" + m + "/" + y + "  " + h + ":" + mm;
