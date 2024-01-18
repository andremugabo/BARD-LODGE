function getSCategory(sCategory) {
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
      document.getElementById("sCategory").innerHTML = this.responseText;
    }
  };
  request.open("GET", "getCategory.php?cat=" + sCategory, true);
  request.send();
}
function getSProduct(sProduct) {
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
      document.getElementById("sProduct").innerHTML = this.responseText;
    }
  };
  request.open("GET", "getCategory.php?prod=" + sProduct, true);
  request.send();
}
