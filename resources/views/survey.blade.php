@extends('layouts.main')

@section('main')
    @php($color = ['primary', 'success', 'warning', 'danger', 'primary', 'success', 'warning', 'danger'])
    <section class="main container">
        <div class="box box-detail">
            <div class="box-header">
                <h2>{{$post->title}}</h2>
            </div>
            <div class="box-content text-center">
                <p>{{$post->description}}</p>
            </div>

            <ol type="A" class="d-flex justify-content-center align-content-center">
                @foreach($post->result as $key => $value)
                    <li class="mx-4">
                            <span class="badge badge-{{$color[$key]}}">
                                {{sizeof($post->results) > 0 ? round($value/($post->questions()->count()*sizeof($post->results)) * 100, 2): 0}}
                                %
                            </span>
                    </li>
                @endforeach
            </ol>

            <div class="box-question">
                <form action="{{route("save")}}" method="post">
                    @csrf
                    <input type="text" class="d-none" name="post_id" value="{{$post->id}}">
                    <input type="text" class="d-none" name="slug" value="{{$post->slug}}">
                    <ol>
                        @foreach($post->questions as $question)
                            <li class="font-weight-bold">
                                {{$question->content}}
                                <ol type="A" class="font-weight-normal">
                                    @foreach(explode(',', $question->answers) as $key=>$answer)
                                        <li>
                                            <input value="{{$key}}" id="{{'answers'.$question->id.'_'.$key}}"
                                                   class="form-check-input"
                                                   type="radio"
                                                   name="_{{$question->id}}" required>
                                            <span class="badge badge-{{$color[$key]}}">
                                                {{array_sum($question->result) > 0 ? round($question->result[$key]/array_sum($question->result) * 100, 2) : 0}}
                                                %
                                            </span>
                                            <label for="{{'answers'.$question->id.'_'.$key}}">{{$answer}}</label>
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        @endforeach
                    </ol>
                    <button class="btn btn-outline-primary float-right">Chốt đáp án</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>

        <div class="box-footer container mt-2">
            <div>
                <h2>{{$post->title}}</h2>
            </div>
        </div>
    </section>
@endsection