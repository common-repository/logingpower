
// let tabName="defaultOpen";
// function openCity(evt, cityName) {
//   var i, tabcontent, tablinks;
//   tabcontent = document.getElementsByClassName("tabcontent");
//   for (i = 0; i < tabcontent.length; i++) {
//     tabcontent[i].style.display = "none";
//   }
//   tablinks = document.getElementsByClassName("tablinks");
//   for (i = 0; i < tablinks.length; i++) {
//     tablinks[i].className = tablinks[i].className.replace(" active", "");
//   }
//   document.getElementById(cityName).style.display = "block";
//   evt.currentTarget.className += " active";
// }
// var tabNameG;
// tabNameG="Login";
function openTab(tabName,elmnt,color) {
  
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(tabName).style.display = "block";
  elmnt.style.backgroundColor = color;
  
//   elmnt.setAttribute("id", tabName);
// tabNameG=tabName;
}
document.addEventListener("DOMContentLoaded", function(event) {
  
  // alert(tabNameG );
  // document.getElementById(tabNameG).click()
    document.getElementById("defaultOpen").click();
 });
// // Get the element with id="defaultOpen" and click on it




