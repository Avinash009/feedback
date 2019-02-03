<div class="modal" id="project-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title project-modal-title">Create project</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form id="project-form" action="" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="hidden" class="projectId" name="projectId" value="-1">
                        
                        {{ csrf_field() }}
                        <label for="project-name">Project name:</label>
                        <input type="text" class="form-control projectName" name="projectName" placeholder="Food">
                        <span class="error"></span>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <span class='success'></span>
                    <button type="submit" class="btn btn-primary project-submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>