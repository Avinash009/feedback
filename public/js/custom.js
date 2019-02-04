$(document).ready(function () {
    
    $('#project-form').on('submit', function (e) {
        e.preventDefault();
        console.log($('.projectId').val());
        if($('.projectId').val() > 0)
        {
            url = config.urls.create_project_url.replace('-1', $('.projectId').val());
        }
        else
        {
            url = config.urls.create_project_url;
        }
        $.ajax({
            url:url,
            type:"POST",
            data:$(this).serialize(),
            success:function(response){
                if(response.success)
                {
                    $('#project-form').find('.success').html(response.success);
                    getProjects();
                }
                if(response.errors)
                {
                    $('#project-form').find('.error').html(response.errors.projectName);
                }
            }
        });
    });
}); 
