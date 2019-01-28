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
        <div class="card">
            <i class="fas fa-edit edit-project" data-project_id="{id}"></i>
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
    var edit_project = $('edit-project');
    var built_html = '';
    var loader = $('.loader');
    function getProjects()
    {
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
                        built_html += project_cards_html;
                    });
                    projects_list.html(built_html);
                    loader.hide();
                    
                    $('.edit-project').on('click',function(){
                        editProject($(this).data('project_id'));
                    });
                }
            }
        });
    }
    getProjects();
    function editProject(project_id)
    {
        var url = '{{ route("project.edit", ":id") }}';
        url = url.replace(':id', project_id);
        $.ajax({
            url:url,
            type:'GET',
            success:function(response){
                console.log(response);
            }
        });
    }
</script>
@endsection