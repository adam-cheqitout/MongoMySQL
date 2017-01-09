const ajax_request = (collection, method, restraints, sort, callback) =>{
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../responder.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = (e) => {
    if (e.target.readyState == 4 && e.target.status == 200) {
      callback(e.target.response);
    }
  };
  let req = `collection=${collection}&restraints=${JSON.stringify(restraints)}&sort=${JSON.stringify(sort)}`;
  xhttp.send(req);
}
