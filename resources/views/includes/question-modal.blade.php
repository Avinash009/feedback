<div class="modal" id="question-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title"><?php echo empty($question->id) ? "Create question" : "Edit question" ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <?php $id = empty($question->id) ? "-1" : $question->id ?>
            <form id="question-form" action="{{route('question.create',['id'=>$project_id,'question_id' =>$id])}}">
                <div class="modal-body">

                    <div class="form-group">
                        {{ csrf_field() }}
                        <label for="question">Question:</label>
                        <input type="text" class="form-control question" name="question" placeholder="rate the taste" value="<?php echo empty($question->question) ? "" : $question->question ?>">
                        <span class="question-error"></span>
                    </div>
                    <div class="row">
                        <!--<div class="col-md-12">-->
                        <div class="col">
                            <div class="d-inline">
                                <div class="options-info">Add Your Options</div>
                                <div class="form-group options">
                                    <div class="options-text">
                                        <?php if (!empty($question_options)): ?>
                                            @foreach($question_options as $option)
                                            <div class='option mb-2'><input type='text' value="<?php echo $option->option ?>" name='options[]'><p class='fa fa-times-circle del-option'></p></div>
                                            @endforeach
                                        <?php endif; ?>
                                    </div>
                                    <div class="add-options">
                                        <p class="fa fa-plus fa-lg add-q-options"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-inline">
                                <div class="perseptions-info">Add Your Perseptions</div>
                                <div class="form-group perseptions">
                                    <div class="perseptions-text">
                                        <?php if (!empty($perseptions)): ?>
                                            @foreach($perseptions as $perseption)
                                            <div class='perseption mb-2'><input type='text' value='<?php echo $perseption->perseption ?>' name='perseptions[]'><p class='fa fa-times-circle del-perseption'></p></div>
                                            @endforeach
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="add-perseption">
                                    <p class="fa fa-plus fa-lg add-q-perseptions"></p>
                                </div>
                            </div>
                        </div>
                        <!--</div>-->


                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <span class='bottom-message-success'></span>
                    <span class='bottom-message-error'></span>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
