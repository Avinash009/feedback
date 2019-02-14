@extends('layouts.app')
@section('content')
<div class="question-view">
    <div class="create-question-top text-right">
        <button type="button" class="create-modal btn btn-primary" data-toggle="modal">
            Create question
        </button>
    </div>  
    <div class="card empty-questions d-none">
        <div class="card-body">
            <div class="text-center message">

            </div>
        </div> 
    </div> 
    <div class="row questions-list">
        @include('includes.loader')
    </div>
</div>
<div class="modal-section">

</div>
@endsection
@section('scripts')
<script type="text/html" id="question-cards">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="box-part text-center">
            <i class="fa fa-edit edit-question" data-question_id="{id}"></i>
            <i class="fa fa-times delete-question" data-question_id="{id}"></i>
            <div class="title">
                <a class="question-title" href="#">{question_name}</a>
            </div>
            <div class="question-description">
                <p class="question-date px-2">{created_at}</p>
            </div>
            <a href="#">Learn More</a>
        </div>
    </div>	 
</script>
<script>
    var project_id = '{{$project_id}}';
    var questions_empty = $('.empty-questions');
    var questions_list = $('.questions-list');
    var built_html = '';
    var loader = $('.loader');
    var question_form = $('#question-form');
    var create_modal = $('.create-modal');
    var edit_question = $('.edit-question');
    var i = -1;
    var p = -1;
    var max = 10;
//    $('.project-id').val(project_id);
    getAllQuestions();
    function getAllQuestions()
    {
        var url = '{{ route("questions.list", ":id") }}';
        url = url.replace(':id', project_id);
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                questions_list.html('');

                var count = Object.keys(response.questions).length;
                if (count < 1)
                {
                    console.log('sfgfgf');
                    questions_empty.removeClass('d-none');
                    questions_empty.find('.message').html("<span>You have not created any questions yet.</span>");
                    loader.hide();
                    return;
                } else
                {
                    questions_empty.hide();

                    $.each(response.questions, function () {
                        var question_cards_html = $('#question-cards').html();
                        question_cards_html = question_cards_html.replace("{question_name}", this.question);
                        question_cards_html = question_cards_html.replace("{created_at}", this.created_at);
                        question_cards_html = question_cards_html.replace("{id}", this.id);
                        built_html += question_cards_html;
                    });
                    questions_list.html(built_html);
                    loader.hide();
                }
                console.log($('.edit-question'));
                $('.edit-question').on('click', function () {
                    editQuestion($(this).data('question_id'));
                });

            }
        });
    }
    create_modal.on('click', function (e) {
        e.preventDefault();
        var url = "{{ route('question.open.modal', [':id', ':question_id']) }}";
        url = url.replace(/:id/, project_id);
        url = url.replace(/:question_id/, -1);
        console.log(url);
        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                $('.modal-section').html(response);
                $('#question-modal').modal('show');
                $('#question-form').on('submit', function (e) {
                    e.preventDefault();
                    submitQuestionForm($(this).attr('action'), $(this).serialize(), $(this).find('.question-error'), $(this).find('.bottom-message-success'), $(this).find('.bottom-message-error'), $(this).closest('#question-modal').find('.close'));
                });

                $('.add-q-options').on("click", function (e) {
                    if (i < max)
                    {
                        i++;
                        var option = "<div class='option mb-2'><input type='text' name='options[]'><p class='fa fa-times-circle del-option'></p></div>";
                        $(".options-text").append(option);
                    }
                });
                $('.add-q-perseptions').on("click", function (e) {
                    if (p < max)
                    {
                        p++;

                        var perseption = "<div class='perseption mb-2'><input type='text' name='perseptions[]'><p class='fa fa-times-circle del-perseption'></p></div>";
                        $(".perseptions-text").append(perseption);
                    }
                });

                $('body').on("click", ".del-option", function () {
                    $(this).closest(".option").remove();
                    i--;

                });

                $('body').on("click", ".del-perseption", function () {
                    $(this).closest(".perseption").remove();
                    p--;

                });
            }
        });
    });

    function editQuestion(question_id)
    {
        var url = "{{route('question.open.modal',[':id', ':question_id'])}}";
        url = url.replace(/:id/, project_id);
        url = url.replace(/:question_id/, question_id);
        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                console.log(response);
                $('.modal-section').html(response);
                $('#question-modal').modal('show');
                $('#question-form').on('submit', function (e) {
                    e.preventDefault();

                    submitQuestionForm($(this).attr('action'), $(this).serialize(), $(this).find('.question-error'), $(this).find('.bottom-message-success'), $(this).find('.bottom-message-error'), $(this).closest('#question-modal').find('.close'));
                });

                $('.add-q-options').on("click", function (e) {
                    if (i < max)
                    {
                        i++;
                        var option = "<div class='option mb-2'><input type='text' name='options[]'><p class='fa fa-times-circle del-option'></p></div>";
                        $(".options-text").append(option);
                    }
                });
                $('.add-q-perseptions').on("click", function (e) {
                    if (p < max)
                    {
                        p++;

                        var perseption = "<div class='perseption mb-2'><input type='text' name='perseptions[]'><p class='fa fa-times-circle del-perseption'></p></div>";
                        $(".perseptions-text").append(perseption);
                    }
                });

                $('body').on("click", ".del-option", function () {
                    $(this).closest(".option").remove();
                    i--;

                });

                $('body').on("click", ".del-perseption", function () {
                    $(this).closest(".perseption").remove();
                    p--;

                });

            }
        });
    }

    function submitQuestionForm(url, data, question_element, bottom_success, bottom_error, close_element)
    {
        console.log(close_element);
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (response) {
                console.log(response);
                if (response.success != '')
                {
                    console.log(close_element);
                    bottom_success.html(response.success);
                    console.log(close_element);
                    setTimeout(function () {
                        close_element.click();
                        location.reload();
                    }, 1000);

                } else
                {
                    if (response.errors.question != '')
                    {
                        question_element.html(response.errors.question);
                    }
                    if (response.options != '')
                    {
                        bottom_error.html(response.options);
                    }
                    if (response.perseptions != '')
                    {
                        bottom_error.html(response.perseptions);
                    }
                }


            }
        });
    }
</script>
@endsection
