@extends('layouts.app')
@section('content')
<div class="project-view">
    <div class="create-project-top text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#project-modal">
            Create project
        </button>
    </div>
    <div class="card empty-projects d-none">
        <div class="card-body">
            <div class="text-center message">

            </div>
        </div> 
    </div> 
    <div class="row projects-list">
        @include('includes.loader')
    </div>
</div>
@include('includes.project-modal')
@endsection
@section('scripts')
<script type="text/html" id="project-cards">
    <div class="column">
        <i class="fa fa-times-circle delete-project" data-project_id="{id}"></i>
        <div class="card">
            <div><i class="fas fa-edit edit-project" data-project_id="{id}"></i></div>
            <div><a href="{all_questions_url}"><i class="fas fa-check-square all-questions"></a></i></div>
            <a href="/project/{id}">
                <h3>{project_name}</h3>
                <p>{created_at}</p>
            </a>
        </div>
    </div>
</script>
<script>
    var projects_empty = $('.empty-projects');
    var projects_list = $('.projects-list');
    var edit_project = $('.edit-project');
    var loader = $('.loader');
    var all_questions = $('.all-questions');
    function getProjects()
    {
        var built_html = '';
        $.ajax({
            url: "{{route('projects.list')}}",
            type: "GET",
            success: function (response) {
                var count = Object.keys(response.projects).length;
                if (count < 1)
                {
                    projects_empty.removeClass('d-none');
                    projects_empty.find('.message').html("<span>You have not created any projects yet.</span>");
                    loader.hide();
                    return;

                } else
                {
                    projects_empty.hide();
                    
                    $.each(response.projects, function () {
                        var project_cards_html = $('#project-cards').html();
                        project_cards_html = project_cards_html.replace(/{id}/g, this.id);
                        project_cards_html = project_cards_html.replace("{project_name}", this.name);
                        project_cards_html = project_cards_html.replace("{created_at}", this.created_at);
                        project_cards_html = project_cards_html.replace("{all_questions_url}", "/project/"+this.id+"/questions/all");
                        built_html += project_cards_html;
                    });
                    projects_list.html(built_html);
                    loader.hide();
                    
                    $('.edit-project').on('click',function(){
                        var project_id = $(this).data('project_id');
                        var project_modal = $("#project-modal");
                            project_modal.modal("show");
                            $(".project-modal-title").html("Edit Project");
                            $(".project-submit").html("Update");
                        var url = '{{ route("project.edit", ":id") }}';
                            url = url.replace(':id', project_id);
                            $.ajax({
                                url:url,
                                type:'GET',
                                data:$('#project-form').serialize(),
                                success:function(project){
                                    console.log(project);
                                    project_modal.find(".projectName").val(project.name);
                                    project_modal.find(".projectId").val(project.id);
                                },
                                error: function(response)
                                {
                                    console.log(response)
                                }
                            });
                    });
                    $('.delete-project').on("click", function(){
                        var project_id = $(this).data('project_id');
                        var url = '{{ route("project.delete", ":id") }}';
                            url = url.replace(':id', project_id);
                        console.log(project_id)
                        $.ajax({
                                url:url,
                                type:'POST',
                                data:{id:project_id, _token: '{{csrf_token()}}'},
                                success: function(reponse){
                                    console.log(reponse);
                                    //alert();
                                },
                                error: function(response)
                                {
                                    console.log(response)
                                }
                            });
                    });
//                    $('.all-questions').on('click',function(e){
//                        e.preventDefault();
//                        var project_id = $(this).data('project_id');
//                        var url = '{{ route("project.questions.all", ":id") }}';
//                            url = url.replace(':id', project_id);
//                            
//                        $.ajax({
//                          url:url,
//                          type:"GET",
//                          success:function(response)
//                          {
//                              console.log(response);
//                          }
//                        });
//                    });
                }
            }
        });
    }
    getProjects();
</script>
@endsection