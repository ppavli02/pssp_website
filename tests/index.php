<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        
        <title>Demography</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>       
        
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.5/summernote.min.js"></script>
        
        <script src="_/libs/bootstrap-slider/dist/bootstrap-slider.min.js"></script>
        <script src="_/libs/bootstrap/loading/dist/spin.js"></script>
        <script src="_/libs/bootstrap/loading/dist/ladda.min.js"></script>
        <script src="_/libs/bootstrap/sweetalert/lib/sweet-alert.min.js"></script>
        <script src="_/libs/bootstrap/fileinput/js/fileinput.min.js"></script>
        <script src="_/js/demographics.js" type="text/javascript"></script>
        <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Q4goEGgtL02AA7wa-ZJEKc14qrAoSmU">
        </script>
        
        <script src="_/js/facebook-login.js" type="text/javascript"></script>
        <script src="_/js/infobubble.js"></script>
        <script src="_/js/jquery.slimscroll.min.js"></script>
        <script src="_/libs/bootstrap/tags/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" charset="utf8" src="_/libs/smooth-scroll/src/jquery.smooth-scroll.js"></script>

        
        <link rel="icon" type="image/ico" href="_/img/favicon.ico">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.5/summernote.min.css">
        
        <link href="_/libs/bootstrap-slider/css/bootstrap-slider.css" rel="stylesheet">
        <link href="_/libs/bootstrap/loading/dist/ladda-themeless.min.css" rel="stylesheet">
        <link href="_/libs/bootstrap/fileinput/css/fileinput.min.css" rel="stylesheet">
        <link href="_/libs/bootstrap/sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="_/css/reset.css" rel="stylesheet">
        <link href="_/libs/bootstrap/tags/bootstrap-tagsinput.css" rel="stylesheet">
        
        <link rel="apple-touch-icon" href="_/img/apple-icon-114x114-precomposed.png" />
    </head>

    <body>  
        <?php include 'components/navbar.php' ?>
        <div id="timeline-embed"></div>
        
        <!--This is the main container of the map-->
        <div id="map-canvas"></div>	
        
        <!--The main includes for the components-->
        <?php include 'components/marker-modal.php' ?>
        <?php include 'components/login-modal.php' ?>
        <?php include 'components/marker-view.php' ?>
        <?php include 'components/forms/sign-up-form.php' ?>
        <?php include 'components/forms/fill-in-form.php' ?>
        <?php include 'components/forms/change-password-form.php' ?>
        <?php include 'components/forms/edit-profile-form.php' ?>
        <?php include 'components/footer.php' ?>
        <?php include 'timeline/timeline_modal.php'?>
        
        <!--Setting the flag if logged in-->
        <?php 
            if(isset($_SESSION['logged_in'])){
                echo "<script>flag=true;</script>";
            }else{
                echo "<script>flag=false;</script>";
            }
        ?>
        
        <script type="text/javascript">
            var notificationTimer;
            timeline_enabled=true;
            
            $(window).load(function(){
                $(document).ready(function(){
                    var login_error=0;
                        <?php 
                            if(isset($_SESSION['errorLogin'] )){
                                $_SESSION['errorLogin']=null;
                                echo 1;
                            }
                            else{
                                $_SESSION['errorLogin']=null;
                                echo 0;
                            }
                        ?>

                        if(login_error==1){
                            swal({
                              title: "Error!",
                              text: "You have typed wrong email or password.",
                              type: "error",
                              showCancelButton: false,
                              confirmButtonClass: "btn-default",
                              confirmButtonText: "Got it!",
                              closeOnConfirm: true
                            });
                        }

                    $('#Log_Button').on('click',function(){
                        if(!flag){
                            $('#login-modal').modal('toggle');
                            $('#Log_Button').attr('data-toggle', ""); 
                           }
                        else{
                             $('#Log_Button').attr('data-toggle', "dropdown");  
                            }
                    });

                    $('#LogOut_Button').on('click',function(){
                        $.ajax({
                            url: "members/login/logout.php",
                            type: "POST",
                            async: false,
                            cache: false,
                            success: function(data){
                                flag=false;
                                window.location="index.php";
                            },
                            contentType: false,
                            processData: false
                        });	
                    });


                    //Initialize article's editor
                    $('#summernote').summernote({
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline']],
                            ['font', ['strikethrough']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['misc',['codeview']]
                        ]
                    });

                    function loadNotifications(){
                        $("#notification-list").html("");
                        $.ajax({
                            url: "notifications/notifications.php",
                            type: "POST",
                            async: false,
                            cache: false,
                            success: function(data){
 
                                var notificationsJSON;
                                var index;
                                var unseen = 0;
                                
                                if(data==""){
                                    index=0;
                                }
                                else{
                                    notificationsJSON=JSON.parse(data);
                                    index=Object.keys(notificationsJSON).length;
                                }
                                
                                if(index>0){
                                    
                                    $('#notification-dropdown').attr('data-toggle',"dropdown");
                                    
                                    jQuery.each(notificationsJSON, function(key,value) {
                
                                        if(value.seen==false){
                                            unseen++;
                                            $("#notification-list").append(
                                                '<li >'+
                                                    '<a class="unseen" href="#">'+
                                                        '<p><b>'+value.member+'</b> commented on '+value.eventTitle+'</p>'+
                                                        '<p>'+value.datePosted+'</p><p class="secret-input">'+value.eventID+'</p>'+
                                                        '<div class="secret-input">'+value.id+'</div>'+
                                                    '</a>'+
                                                '</li>'
                                            );
                                        }else{
                                           $("#notification-list").append(
                                                '<li >'+
                                                    '<a class="seen" href="#">'+
                                                        '<p><b>'+value.member+'</b> commented on '+value.eventTitle+'</p>'+
                                                        '<p>'+value.datePosted+' <i class="fa fa-check-square-o"></i></p><p class="secret-input">'+value.eventID+'</p>'+
                                                    '</a>'+
                                                '</li>'
                                            ); 
                                        }
                                        index-=1;
                                        if(index!=0)
                                            $("#notification-list").append('<li class="divider"></li>');
                                    });
                                    
                                    if(unseen>0){
                                        $('#notification-badge').text(unseen);
                                    }else{
                                        $('#notification-badge').text("");
                                    }
                                }
                            }
                        });
                    }
                    
                    if(flag){
                        $('#sign-up-btn').hide();
                        var checkNotificationVariable = loadNotifications();
                        //setInterval(loadNotifications, 10000);
                    }
                                        
                    $("#notification-list").on('click','a',function(){
                        var notificationEvent = $("p[class='secret-input']",this ).text();
                        var notificationID = $("div[class='secret-input']",this ).text();
                        var eventJSON;
                        
                         $.ajax({
                            url: "markers/phpsqlajax_getcontents.php",
                            type: "POST",
                            data: {
                                eventID:notificationEvent
                            },
                            async: false,
                            success: function (data) {
                                eventJSON = JSON.parse(data);
                            }
                        });
                        
                        cur_event = notificationEvent;
        
                        $.ajax({
                            url: "markers/phpsqlajax_load_comment.php",
                            type: "POST",
                            data: {
                                eventID:cur_event
                            },
                            success: function (data) {
                                cur_comments = JSON.parse(data);
                                loadComments();
                            },
                            async: false
                        });

                        $.ajax({
                            url: "markers/phpsqlajax_views.php",
                            type: "POST",
                            data: {
                                eventID:notificationEvent
                            },
                            async: false
                        });

                        $('#marker-header').html('<a href="#">'+eventJSON.user+'</a>'+'<p>'+eventJSON.datePosted+'</p>'+
                                                 '<div>Views: '+eventJSON.views+'</div><div>Likes: '+eventJSON.likes+'</div>');
                        $('#marker-body').html( '<h1 class="modal-title"><center>'+eventJSON.title+'</center></h1>'+
                                                '<center><p>'+eventJSON.eventDate+'</p></center>'+
                                                '<br>'+eventJSON.content);

                        $('#marker-view').modal('toggle');
                        $('#marker-view').on('hide.bs.modal', function () {            
                            map.setZoom(10);
                            $("#comment-list").html("");
                            document.getElementById("comment-input").value = "";
                        });
                        
                        cur_JSON=eventJSON;
                        if($(this).hasClass("unseen")){
                             $.ajax({
                                url: "notifications/update-notifications.php",
                                type: "POST",
                                data: {
                                    notificationID:notificationID
                                }, 
                                 success: function (data) {
                                   loadNotifications();
                                },
                                async: false
                            });
                        }
                    });
                });
            });
        </script>
<!--
        <script src="_/js/timeline.js"></script>
        <link href="_/css/timeline.css" rel="stylesheet">
-->
<!--        <script src="_/libs/timelinejs/build/js/storyjs-embed.js"></script>-->
        <script src="_/js/googleMaps.js" type="text/javascript"></script>
        <script src="_/js/search-functions.js" type="text/javascript"></script>
        <script>
            setTimeout(function() {
                  $( "#timeline-embed" ).css('display','none');  
                  $( "#timeline-embed" ).css('z-index','100000');
            }, 4000);
        </script>
    </body>
</html>