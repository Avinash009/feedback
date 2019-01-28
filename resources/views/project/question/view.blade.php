@extends('layouts.app')
@section('content')
<div class="question-view">
    <div class="create-question-top text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#question-modal">
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
@include('includes.question-modal')
@endsection
@section('scripts')
<script type="text/html" id="question-cards">
        <div class="column">
            <a href="">
            <div class="card">
                <h3>{question_name}</h3>
                <p>{created_at}</p>
            </div>
            </a>
        </div>
</script>
<script>
    var project_id = '{{$project_id}}';
    var questions_empty = $('.empty-questions');
    var questions_list = $('.questions-list');
    var built_html = '';
    var loader = $('.loader');
    getAllQuestions();
    function getAllQuestions()
    {
        var url = '{{ route("questions.list", ":id") }}';
        url = url.replace(':id', project_id);
        $.ajax({
            url:url,
            type:'GET',
            success:function(response){
                var count = Object.keys(response.questions).length;
                if(count < 1)
                {
                    console.log('sfgfgf');
                    questions_empty.removeClass('d-none');
                    questions_empty.find('.message').html("<span>You have not created any questions yet.</span>");
                    loader.hide();
                    return;
                }
                else
                {
                    projects_empty.hide();

                    $.each(response.questions, function () {
                        var question_cards_html = $('#question-cards').html();
                        question_cards_html = question_cards_html.replace("{question_name}", this.name);
                        question_cards_html = question_cards_html.replace("{created_at}", this.created_at);
                        built_html += question_cards_html;
                    });
                    questions_list.html(built_html);
                    loader.hide();
                }
            }
        });
        var i = 0;
        var max = 10;
        $(".add-q-options").on("click", function(){
            i++;
            if(i > max)
            {
                return;
            }
            var option = "<div class='option'><input type='text' name='options["+i+"]'></div><br>";
            $(".options-text").append(option);
        })
    }
</script>
@endsection
  