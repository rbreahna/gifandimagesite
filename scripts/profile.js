function delete_image(image_id)
{
        var xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.onreadystatechange = function() 
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
        xmlhttp1.open("POST", "deleteimage.php", true);
        xmlhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp1.send("id="+image_id);
}


function reset_style()
{
   old_border = document.getElementsByClassName("overlay_image");
   var i;
for (i = 0; i < old_border.length; i++) 
{
    old_border[i].style.border = "1px solid black";
}

}

var upload ="";
function myFunction(){
    var x = document.getElementById("myFile");
    upload_overlay = document.getElementById("upload_overlay");
    var txt = "";
    if ('files' in x) {
        if (x.files.length == 0) {
            txt = "Select file.";
        } else {
               
                var file = x.files[0];
                if ('name' in file) {
                    txt += "Name: " + file.name + "<br>";
                }
                if ('size' in file) {
                  if((file.size/(1024*1024)).toFixed(2) > 3)
                  {
                    x = "";
                    file = "";
                    txt = "File must be smaller than 3MB";
                  }

                  else
                    txt += "Size: " + (file.size/(1024*1024)).toFixed(2) + " MB <br>";
                }

        }
    } 
    else {
        if (x.value == "") {
            txt += "Select file.";
        } else {
            txt += "The files property is not supported by your browser!";
            txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
        }
    }
    document.getElementById("demo").innerHTML = txt;
    if (typeof file !== 'undefined')
    {
    src = window.URL.createObjectURL(file);
upload_overlay.innerHTML = "<img id='image_overlay2' src ="+src+"></img>";
}

  stopWebcam();

upload = document.getElementById("image_overlay2");
window.URL.revokeObjectURL(file);
}

var selection = "";

function changealpha(image)
{
if (image != '')
{
          overlay = document.getElementById("overlay");
         
          if (image == "default")
          {
             overlay.innerHTML = "";
          }
          else if (image == "image1")
          {
            reset_style()
          image_border = document.getElementById("1");
          image_border.style.border = "3px solid red";
          overlay.innerHTML = "<img class='image_overlay' src = './alpha/insect.png'></img>";
           }
        else if (image == "image2")
        {
          reset_style()
          image_border = document.getElementById("2");
          image_border.style.border = "3px solid red";
          overlay.innerHTML = "<img class='image_overlay' src = './alpha/insect2.png'></img>";
        }
        else if (image == "image3")
        {
          reset_style()
          image_border = document.getElementById("3");
          image_border.style.border = "3px solid red";
          overlay.innerHTML = "<img class='image_overlay' src = './alpha/Curtain.png'></img>";
        }
         else if (image == "image4")
        {
          reset_style()
          image_border = document.getElementById("4");
          image_border.style.border = "3px solid red";
          overlay.innerHTML = "<img class='image_overlay' src = './alpha/1.png'></img>";
        }
         else if (image == "image5")
        {
          reset_style()
          image_border = document.getElementById("5");
          image_border.style.border = "3px solid red";
          overlay.innerHTML = "<img class='image_overlay' src = './alpha/11.png'></img>";
        }
        else if (image == "image6")
        {
          reset_style()
          image_border = document.getElementById("6");
          image_border.style.border = "3px solid red";
          overlay.innerHTML = "<img class='image_overlay' src = './alpha/3.png'></img>";
        }
        else if (image == "image7")
        {
          reset_style()
          image_border = document.getElementById("7");
          image_border.style.border = "3px solid red";
          overlay.innerHTML = "<img class='image_overlay' src = './alpha/14.png'></img>";
        }
}
selection =  image;
}