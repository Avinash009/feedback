<div class="modal" id="project-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create project</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form id="project-form" action="" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        {{ csrf_field() }}
                        <label for="project-name">Project name:</label>
                        <input type="text" class="form-control" name="projectName" placeholder="Food">
                        <span class="error"></span>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <span class='success'></span>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>