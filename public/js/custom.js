$(document).ready(function () {
    
    $('#project-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url:config.urls.create_project_url,
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
