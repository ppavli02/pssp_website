<div align="left" class="modal fade" id="chooseParameters" role="dialog">
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