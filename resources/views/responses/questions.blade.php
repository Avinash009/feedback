@extends('layouts.app')

@section('content')
<?php $questions = json_decode($questions);?>
@foreach($questions as $question)
   {{ $question }}
@endforeach
@endsection