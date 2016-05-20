
@extends('layouts.app')

@section('content')

    
    <div class="panel-body">
    
    <h3>{{ $homework->title }}</h3>
    
    <h4>{{ $homework->question }}</h4>
    
    @if (count($homework->studentAnswers) > 0)
    
        <div class="panel panel-default">
        
            <div class="panel-heading">
                Latest Student Submissions
            </div>

                <table class="table table-striped">

                    <!-- Table Headings -->
                    <thead>
                    	<tr>
	                        <th>Student Username</th>
	                        <th>Latest Answer</th>
                        <tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($homework->studentAnswers as $homeworkAnswer)
                            <tr>
                                <td class="table-text">
                                    <div>
                                    	<a 
                                    	href="{{ url('teacher/student_submissions/'.$homeworkAnswer['latest_answer']->homeworkId.'/'.$homeworkAnswer['student']->id) }}" 
                                    	class="navbar-link">{{ $homeworkAnswer['student']->user_name }}</a>					
									</div>
                                </td>

                                <td>
                                    <div>{{ $homeworkAnswer['latest_answer']->answer }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           
        </div>
    @endif    
    
    </div>


@endsection

