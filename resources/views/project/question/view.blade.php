@extends('layouts.app')
@section('content')
<?php print_r($project_id);?>
@endsection
@section('scripts')
<script>
    var project_id = '{{$project_id}}';
    
    function getAllQuestions()
    {
        $.ajax({
            url:'',
            type:'GET',
            success:function(response){
                console.log(response);
            }
        });
    }
</script>
@endsection
  