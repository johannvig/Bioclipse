function searchTable(columnIndex,tableIndex) {
  var searchTerm = document.getElementsByClassName("search")[tableIndex].value.toLowerCase();
  var rows = document
    .getElementsByClassName("sortable-table")[tableIndex]
    .getElementsByTagName("tbody")[0]
    .getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var name = rows[i]
      .getElementsByTagName("td")
      [columnIndex].innerText.toLowerCase();
    if (name.includes(searchTerm)) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
}

function sortTable(columnIndex,tableIndex) {
  var body = document.getElementsByTagName("tbody")[tableIndex];
  var tr = body.getElementsByTagName("tr");
  var rows = [];
  for (var i = 0; i < tr.length; i++) {
    rows.push(tr[i]);
  }
  rows.sort(function (a, b) {
    var aVal = a.getElementsByTagName("td")[columnIndex].innerText;
    var bVal = b.getElementsByTagName("td")[columnIndex].innerText;
    if (isNaN(aVal) || isNaN(bVal)) {
      return aVal.localeCompare(bVal);
    } else {
      return aVal - bVal;
    }
  });
  for (var i = 0; i < rows.length; i++) {
    body.appendChild(rows[i]);
  }
}

var openedDropDown = null;

function showDropDown(dropDownId) {
  document.getElementById("dropDown" + dropDownId).classList.toggle("show");
  openedDropDown = "dropDown" + dropDownId;
}

window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
  if (event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      if (dropdowns[i].id != openedDropDown)
        dropdowns[i].classList.remove("show");
    }
  }
};

window.addEventListener("DOMContentLoaded", (event) => {
  var table = document.getElementsByClassName("sortable-table");
  var search = document.getElementsByClassName("search");
  for (var n = 0; n < table.length; n++) {
    var headers = table[n].getElementsByTagName("th");
    for (var i = 0; i < headers.length; i++) {
      headers[i].addEventListener(
        "click",
        (function (i,n) {
          return function () {
            sortTable(i,n);
          };
        })(i,n)
      );
    }
    search[n].setAttribute('size',search[n].getAttribute('placeholder').length);
  }
});