@extends('layouts.main')

@section('main')
    <section class="main container">
        <div class="box box-detail">
            <div class="box-header">
                <h2>{{$post->title}}</h2>
            </div>
            <div class="box-content text-center">
                <p>{{$post->description}}</p>

                @if (session('message'))
                    <p class="text-center text-success">{{session('message')}}</p>
                @elseif(is_null($result))
                    <form action="" method="post">
                        @csrf
                        <button class="btn btn-sm btn-warning">Khảo sát</button>
                    </form>
                @else
                    <p class="text-center text-success font-weight-bold">Đã thực hiện khảo sát.</p>
                @endif
            </div>

            @if(!is_null($result))
                <div class="box-question">
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
                                                   name="_{{$question->id}}"
                                                   @if($result["_".$question->id] == $key)checked @else disabled @endif
                                            >
                                            <label for="{{'answers'.$question->id.'_'.$key}}">{{$answer}}</label>
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        @endforeach
                    </ol>
                </div>
                <p class="text-center text-success font-weight-bold">Đã thực hiện khảo sát.</p>
            @endif
            <div class="box-footer container mt-2">
                <div>
                    <h2>{{$post->title}}</h2>
                </div>
            </div>
        </div>
    </section>
@endsection