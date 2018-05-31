function getChild(child){
  var url = 'getSub';
  var method = 'POST';
  var params = 'child='+child;
  showChild(url,method,params,child);
}

function showChild(url, method,params,child){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.onreadystatechange == 4){
      var res = xhr.responseText;
      document.getElementById(child).innerHTML = res;
      console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type", "application/x=www.form-urlencoded");
  xhr.send(params);
}
