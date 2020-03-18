
n =  new Date();
y = n.getFullYear();
m = n.getMonth() +1;
d = n.getDate();
h = n.getHours();
mm = n.getMinutes();
document.getElementById("date").innerHTML = d + "/0" + m + "/" + y + "  " + h + ":" + mm;
