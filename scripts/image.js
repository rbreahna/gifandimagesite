function likecounter(image_id)
 {
    if (image_id.length == 0)
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
                if (this.responseText == '1')
                document.getElementById("likes").innerHTML = this.responseText +' '+'Like';
                else
                document.getElementById("likes").innerHTML = this.responseText +' '+'Likes';
            }
        };
        xmlhttp.open("GET", "countlikes.php?image_id=" + image_id, true);
        xmlhttp.send();
    }
}



function showstatus(image_id)
 {
    if (image_id.length == 0)
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
                if (this.responseText == 1)
                document.getElementById("upvote").innerHTML = 'Unlike';
                else if (this.responseText == 0)
                document.getElementById("upvote").innerHTML = 'Like';
            }
        };
        xmlhttp.open("GET", "showstatus.php?image_id=" + image_id, true);
        xmlhttp.send();
    }
}

function upvote(image_id)
 {
    if (image_id.length == 0)
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
                if (this.responseText == 1)
                document.getElementById("upvote").innerHTML = 'Unlike';
                else if (this.responseText == 0)
                document.getElementById("upvote").innerHTML = 'Like';
           // alert (this.responseText)
            }
        };
        xmlhttp.open("GET", "upvote.php?image_id=" + image_id + "&action=1", true);
        xmlhttp.send();
    }
}

function new_comment(image_id)
{
var comment = document.getElementById("comment").value;
var parent = document.getElementById("parent");
    if (image_id.length == 0 || comment.length == 0)
    { 
        return;
    } 
    else 
    {
      
        document.getElementById("comment").value = "";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
       {
            if (this.readyState == 4 && this.status == 200) 
          {

         parent.innerHTML = this.responseText;

          var xmlhttp_c = new XMLHttpRequest();
           xmlhttp_c.onreadystatechange = function()
           {
                 if (this.readyState == 4 && this.status == 200) 
                        {}
            };

        xmlhttp_c.open("POST", "comment_mail.php", true);
        xmlhttp_c.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp_c.send("image_id="+image_id);
              
            }
        };


        xmlhttp.open("POST", "get_comments.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("comment="+comment+"&image_id="+image_id);
    }
}