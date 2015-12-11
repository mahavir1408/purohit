function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}
function MakeRequest(str)
{


  var xmlHttp = getXMLHttp();
 
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
	//	alert('xmlHttp.responseText');
      HandleResponse(xmlHttp.responseText);
    }
  }
	//var group = document.getElementById("GroupName").value;
	//var queryString = "?age=" + age ;
    xmlHttp.open("GET", "select_cost.php?service="+str, true);
  
  xmlHttp.send(null);
}

function HandleResponse(response)
{
//alert(response);
  document.getElementById('ResponseDiv').value = response;
 
}
