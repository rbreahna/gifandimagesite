 //--------------------
      // GET USER MEDIA CODE
      //--------------------
          navigator.getUserMedia = (navigator.getUserMedia ||
                             navigator.webkitGetUserMedia ||
                             navigator.mozGetUserMedia ||
                             navigator.msGetUserMedia || 
                             navigator.mediaDevices.getUserMedia||
                             navigator.oGetUserMedia);

      //var video;
      var webcamStream;
      var cam_on ="0";
     var video;
      function startWebcam() {
        if (navigator.getUserMedia) 
        {
          video = document.querySelector('#video');
           navigator.getUserMedia ({video: true}, handleVideo, videoError);

              // successCallback
              function handleVideo (localMediaStream) 
              {
                  
                 video.src = window.URL.createObjectURL(localMediaStream);
                 webcamStream = localMediaStream;
                 if (webcamStream!="")
                 {
                   cam_on ="1";
                  temp = document.getElementById("upload_overlay");
                  temp.innerHTML = "<img id='image_overlay2'></img>";
                  ctx.drawImage(video, 0,0, canvas.width, canvas.height);
                 }
              }

              // errorCallback
              function videoError (err) 
              {
                 console.log("The following error occured: " + err);
              }
      
        } 

        else {
           console.log("getUserMedia not supported");
        }  
      }

      function stopWebcam() {
          if (typeof webcamStream !== 'undefined') {
    // the variable is defined
          webcamStream.getVideoTracks()[0].stop();
          cam_on = "0";

        }
          
      }
      //---------------------
      // TAKE A SNAPSHOT CODE
      //---------------------
      var canvas, ctx;

      function init() {
        // Get the canvas and obtain a context for
        // drawing in it
        canvas = document.getElementById("myCanvas");
        ctx = canvas.getContext('2d');
      }



function preview()
{
       preview = document.getElementById("preview");
        var xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.onreadystatechange = function() 
       {
            if (this.readyState == 4 && this.status == 200) 
          {

        preview.innerHTML = this.responseText;
              
            }
        };
        xmlhttp1.open("POST", "preview.php", true);
        xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp1.send("refresh=1");
}

      var src = "./alpha/insect.png";
      var alpha = new Image();
      alpha.src = src;


      function snapshot()
    {
      selector = document.getElementById("selector");
      if(selection!="")
      {
         // Draws current image from the video element into the canvas
         if (upload == "" || cam_on =="1")
         {
        ctx.drawImage(video, 0,0, canvas.width, canvas.height);
         var data = canvas.toDataURL('image/png');
         }
         else if (upload != "" || cam_on =="0")
         {
          ctx.drawImage(upload, 0,0, canvas.width, canvas.height);
         var data = canvas.toDataURL('image/png');;
      }

    if (data.length == 0 )
    { 
        return;
    } 
    else 
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
       {
            if (this.readyState == 4 && this.status == 200) 
          {
              preview = document.getElementById("preview");
        var xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.onreadystatechange = function() 
       {
            if (this.readyState == 4 && this.status == 200) 
          {
        preview.innerHTML = this.responseText; 
            }
        };
        xmlhttp1.open("POST", "preview.php", true);
        xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp1.send("refresh=1");
          }
        };
        xmlhttp.open("POST", "saveimage.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("image_data="+data+"&super="+selection+"&upload="+upload);
        }

        overlay2 = document.getElementById("overlay2");
          if (selection == "")
          {

          }
          else if (selection == "image1")
          overlay2.innerHTML = "<img class='image_overlay' src = './alpha/insect.png'></img>";
        else if (selection == "image2")
          overlay2.innerHTML = "<img class='image_overlay' src = './alpha/insect2.png'></img>";
        else if (selection == "image3")
          overlay2.innerHTML = "<img class='image_overlay' src = './alpha/Curtain.png'></img>";
        else if (selection == "image4")
          overlay2.innerHTML = "<img class='image_overlay' src = './alpha/1.png'></img>";
        else if (selection == "image5")
          overlay2.innerHTML = "<img class='image_overlay' src = './alpha/11.png'></img>";
        else if (selection == "image6")
          overlay2.innerHTML = "<img class='image_overlay' src = './alpha/3.png'></img>";
        else if (selection == "image7")
          overlay2.innerHTML = "<img class='image_overlay' src = './alpha/14.png'></img>";
      }
      else
      {
        overlay.innerHTML = "<p class='alert'>Please Select Overlay</p>";
      }
      }


