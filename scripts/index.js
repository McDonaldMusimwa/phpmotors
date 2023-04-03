const dateModified = new Date();
const shortendate = new Intl.DateTimeFormat("en-US", {
  dateStyle: "full",
}).format(dateModified);
document.getElementById("date").innerText = shortendate;

//footer data

let array = ["Vongi", "firstname ", ["firstname"]];
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}


/* the function to deliver reviews template*/
function buildReviewList(data) { 
  let reviewDisplay = document.getElementById("reviewDisplay"); 
  

  // Set up the table body 
  let dataTable = '<tbody>'; 
  // Iterate over all vehicles in the array and put each in a row 
  data.forEach(function (element) { 
   //console.log(element.invId + ", " + element.invModel); 
   dataTable += `<tr><td>${element.reviewTxt} ${element.reviewDate}</td>`; 
   dataTable += `<td><a href='/phpmotors/reviews?action=edit-Review&invId=${element.reviewId}' title='Click to modify'>Modify</a></td>`; 
   dataTable += `<td><a href='/phpmotors/reviews?action=delete-Review&invId=${element.reviewId}' title='Click to delete'>Delete</a></td></tr>`; 
  }) 
  dataTable += '</tbody>'; 
  // Display the contents in the Vehicle Management view 
  reviewDisplay.innerHTML = dataTable; 
 }

 //'use strict';
/*Hamburger menu Js*/
function toggleMenu() {
  document.getElementById("myLinks").classList.toggle("open");
  document.getElementById("humburgerBtn").classList.toggle("open");
}

const openmenu = document.getElementById("humburgerBtn");
openmenu.onclick = toggleMenu;