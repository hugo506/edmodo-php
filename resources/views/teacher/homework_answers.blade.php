
@extends('layouts.app')

@section('content')

    
    <div class="panel-body">
    
    <h3>{{ $homework->title }}</h3>
    
    <h4>Question: {{ $homework->question }}</h4>
    
    <h4>Username: {{ $current_student->user_name }}</h4>
    
    @if (count($homework->studentAnswers) > 0)
    
        <div class="panel panel-default">
        
            <div class="panel-heading">
                Student Homework Answers
            </div>

                <table class="table table-striped">

                    <!-- Table Headings -->
                    <thead>
                    	<tr>
	                        <th>Answer ID</th>
	                        <th>Answer</th>
                        <tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($homework->studentAnswers[$current_student->id]['answers'] as $homeworkAnswer)
                            <tr>
                                <td>
                                    <div>{{ $homeworkAnswer->id }}</div>
                                </td>

                                <td>
                                    <div>{{ $homeworkAnswer->answer }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           
        </div>
    @endif    
    
    </div>


@endsection

