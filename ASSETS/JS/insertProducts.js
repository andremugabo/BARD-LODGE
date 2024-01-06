function getCategory(category) {
  if (window.XMLHttpRequest) {
    //check the browsers version

    request = new XMLHttpRequest(); //check the browsers version(modern browsers)
  } else {
    request = new ActiveXObject("microsft.XMLHTTP"); //check the browsers version(old browsers)
  }

  request.onreadystatechange = function () {
    //check the resquest has been successfuly
    // let i=false;

    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("category").innerHTML = this.responseText;
    }
  };
  request.open("GET", "getCategory.php?cat=" + category, true);
  request.send();
}
function getProduct(product) {
  if (window.XMLHttpRequest) {
    //check the browsers version

    request = new XMLHttpRequest(); //check the browsers version(modern browsers)
  } else {
    request = new ActiveXObject("microsft.XMLHTTP"); //check the browsers version(old browsers)
  }

  request.onreadystatechange = function () {
    //check the resquest has been successfuly
    // let i=false;

    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product").innerHTML = this.responseText;
    }
  };
  request.open("GET", "getCategory.php?prod=" + product, true);
  request.send();
}
