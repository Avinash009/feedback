@extends('layouts.app')

@section("content")

<div class="project-view">

    <button type="button" class="btn btn-primary text-center ml-auto p-2" data-toggle="modal" data-target="#project-modal">
        Create project
    </button>
    @include('includes.project-modal')

</div>
<div class="projects-list">
    <?php foreach ($allProjects as $project) : ?>
        <p class="btn btn-info project-btn" data-project-id="{{$project->id}}">{{$project->name}}</p>
    <?php endforeach; ?>
</div>
@endsection
@section("scripts")
<script>
    $(function(){
        $(".project-btn").on("click", function(e){
            console.log()
            e.preventDefault();
                       var projectId = $(this).attr("data-project-id");
                       console.log(projectId);
//            var url = "{{route('questions.view',':id')}}";
//            url = url.replace(':id', projectId);
            $.ajax({
                url:'',
                type:"GET",
                success:function(response){
                    if(response.questions < 1)
                    {
                        location.href="{{route('questions.view')}}"
                    }
                }
            });
        })
    })
</script>
@endsection