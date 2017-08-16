 function multiplesnapshot(foldername)
    {
      //selector = document.getElementById("selector");
      if(selection!="")
      {
         // Draws current image from the video element into the canvas
         if (upload == "" || cam_on =="1")
         {
        ctx.drawImage(video, 0,0, canvas.width, canvas.height);
         var data = canvas.toDataURL('image/png');
         }
        
    if (data.length == 0 )
    { 
        return;
    } 
    else 
    {
    	  //alert(foldername);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
       {
            if (this.readyState == 4 && this.status == 200) 
          {
              //alert(this.responseText);
          }
        };
        xmlhttp.open("POST", "savegifs.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("image_data="+data+"&super="+selection+"&folder="+foldername);
        }

        overlay2 = document.getElementById("overlay2");
        overlay2.innerHTML = "<img class='image_overlay' src = './alpha/wait.gif'></img>";
      
       }
  
      else
      {
        overlay.innerHTML = "<p class='alert'>Please Select Overlay</p>";
      }
   }



function callNTimes(n, time, fn) {
  function callFn() {
    if (--n < 0) return;
    fn();
    setTimeout(callFn, time);
  }
  setTimeout(callFn, time);
}


function request_gif_creation(foldername){

var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.onreadystatechange = function() 
       {
            if (this.readyState == 4 && this.status == 200) 
          {
            // alert(this.responseText);
            overlay2.innerHTML = "<img class='image_overlay' src = '"+this.responseText+"'></img>";
          }
        };
        xmlhttp3.open("POST", "togif.php", true);
        xmlhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp3.send("folder="+foldername);


}


function refresh_preview(){
preview = document.getElementById("preview");
 var xmlhttp4 = new XMLHttpRequest();
        xmlhttp4.onreadystatechange = function() 
       {
            if (this.readyState == 4 && this.status == 200) 
          {
        preview.innerHTML = this.responseText; 
            }
        };
        xmlhttp4.open("POST", "preview.php", true);
        xmlhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp4.send("refresh=1");
}


function makegif()
{
	if (cam_on == "1")
	{
		var foldername ="creation" + Math.random().toString(16).slice(2);

		callNTimes(48, 42, function() 
		{ 
			multiplesnapshot(foldername);
		});

		setTimeout(function () 
		{
			request_gif_creation(foldername);
		}, 6000);

		setTimeout(function () 
		{
			refresh_preview();
		}, 7000);

	}

}


