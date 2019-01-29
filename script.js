<script type="text/javascript">
  
  $(document).ready(function() {


      $('#login').submit(function(e){
        e.preventDefault();


        var username = $("#username").val();
        var password = $("#password").val();


        $.ajax({
            type: "POST",
            url: "submit.php",
            dataType: "json",
            data: {username:username, password:password },
            success : function(data){
                if (data.code == "200"){
                    sresult="Dear " + username + " <br>Your Certificate Status is ...";
                    document.getElementById("statusContent").innerHTML=sresult;
                } else {
                    $(".display-error").html("<ul>"+data.msg+"</ul>");
                    $(".display-error").css("display","block");
                    result="Check your Username or Password";
                    document.getElementById("statusContent").innerHTML=result;
                }
            }
        });


      });
  });
</script>