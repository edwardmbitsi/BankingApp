const moreBtn = document.querySelector(".btn-more");
const more = document.querySelector(".more");

moreBtn.addEventListener("click", () => {
  more.classList.toggle("active");
});

var modal = document.getElementById("editModal");

var btn = document.getElementById("editProfileBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function downloadCSV() {
  var table = document.getElementById("transaction-table");
  var rows = table.getElementsByTagName("tr");
  var csvContent = "data:text/csv;charset=utf-8,";

  for (var i = 0; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName("td");
      var row = [];

      for (var j = 0; j < cells.length; j++) {
          row.push(cells[j].innerText);
      }

      csvContent += row.join(",") + "\n";
  }

  var encodedURI = encodeURI(csvContent);
  var link = document.createElement("a");
  link.setAttribute("href", encodedURI);
  link.setAttribute("download", "transactions.csv");
  document.body.appendChild(link);

  link.click();
  document.body.removeChild(link);
}