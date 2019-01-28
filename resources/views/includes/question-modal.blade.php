<div class="modal" id="question-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create question</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form id="project-form" action="" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        {{ csrf_field() }}
                        <label for="question">Question:</label>
                        <input type="text" class="form-control" name="question" placeholder="rate the taste">
                        <span class="error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="options-info">Add Your Options</div>
                            <div class="form-group options">
                                <div class="options-text">
                                </div>
                                <div class="add-options">
                                    <p class="fa fa-plus  add-q-options">op</p> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="perseptions-info">Add Your Perseptions</div>
                            <div class="form-group perseptions">
                                <div class="perseptions-text">
                                </div>
                            </div>
                            <div class="add-perseption">
                                    <p class="fa fa-plus  add-q-perseptions">pre</p> 
                            </div>
                        </div>
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
