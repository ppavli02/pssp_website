<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../_/libs/bootstrap_switch/bootstrap-switch.js"></script>
    <link rel="stylesheet" type="text/css" href="../_/libs/bootstrap_switch/bootstrap-switch.css">
    <script>
        $(document).ready(function () {
            $("[name='my-checkbox']").bootstrapSwitch();
            $("#not_build").hide();

            $('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function (event, state) {
                if(!state){
                    $("#not_build").show();
                }else{
                    $("#not_build").hide();
                }
                console.log(this); // DOM element
                console.log(event); // jQuery event
                console.log(state); // true | false
            });


        });

        //        function isNumber(evt) {
        //            evt = (evt) ? evt : window.event;
        //            var charCode = (evt.which) ? evt.which : evt.keyCode;
        //            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        //                return false;
        //            }
        //            return true;
        //        }

    </script>
</head>
<body>

<div class="container">
    <h2>Modal Example</h2>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <!--                    <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 class="modal-title">What about the parameter file?</h4>
                </div>
                <div class="modal-body">
                    <p>At this point, it is better to define the source of parameters the network will get.</p>
                    <label for="use_parameter_file">Use the form to build the file?</label>
                    <div>
                        <input type="checkbox" name="my-checkbox" data-on-color="primary" data-off-color="warning"
                               checked>
                    </div>
                    <p></p>
                    <div id="not_build">
                        <label for="parameter_token">Code</label>
                        <div>
                            <input id="parameter_token" name="parameter_token" placeholder="Code goes here."
                                   class="form-control input-md" required="" type="text">
                        </div>
                        <p></p>
                        <p><b>Note:</b> If empty, the default file will be used.</p>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>

<!--<input id="parameter_token" name="parameter_token" placeholder="100"-->
<!--       class="form-control input-md" required="" type="text" onkeypress="return isNumber(event)">-->