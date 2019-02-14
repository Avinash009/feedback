@extends('layouts.app')

@section('content')
<?php  if(count($questions)> 0):?>
<div id="carouselExampleControls" class="carousel slide bg-secondary text-white text-center" data-interval="false" data-ride="carousel">
  <div class="carousel-inner">
    <?php $count = 0;?>
    @foreach($questions as $question)
    <?php $count++ ;?>
    <div class="carousel-item <?php if($count == 1) echo "active" ?>">
        <div class="question">
            <h3 data-question_id="{{$question['question']['question_data']['id']}}">{{$question['question']['question_data']['question']}}</h3>
        </div>
        <div class="answers">
            @foreach($question['question']['perseptions'] as $perseption)
            <div class="row">
                <div class="col-4" class="perseption" data-perseption_id="{{$perseption['perseption_id']}}">
                    <h3>{{$perseption['perseption']}}<h3>
                </div>
                <div class="col-8">
                    @foreach($question['question']['options'] as $option)
                    <button data-option_id="{{$option['option_id']}}">{{$option['option']}}</button>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php else: ?>
<h1 class="text-center">You have not created any questions yet to take feedback</h1>
<?php endif; ?>
@endsection