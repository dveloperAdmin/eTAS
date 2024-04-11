displayClock();

function displayClock() {
  var display = new Date().toLocaleTimeString();
  var today = new Date();

  var date =
    today.getDate() +
    " - " +
    today.toLocaleString("en-us", { month: "short" }) +
    " - " +
    today.toLocaleString("en-us", { year: "numeric" });

  $("#clock_span").html(display);
  $("#date_span").html(date);

  setTimeout(displayClock, 1000);
}
