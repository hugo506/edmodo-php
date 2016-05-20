
@extends('layouts.app')

@section('content')

    

    <div class="panel-body">
    
    <h3>Homework</h3>
    
    @if (count($teacher->createdHomework) > 0)
    
        <div class="panel panel-default">
        
            <div class="panel-heading">
                Available Student Homework
            </div>

                <table class="table table-striped">

                    <!-- Table Headings -->
                    <thead>
                    	<tr>
	                        <th>Title</th>
	                        <th>Due Date</th>
                        <tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($teacher->createdHomework as $homework)
                            <tr>
                                <td class="table-text">
                                    <div>
                                    	<a href="{{ url('teacher/homework_submissions/'.$homework->id) }}" class="navbar-link">{{ $homework->title }}</a>					
									</div>
                                </td>

                                <td>
                                    <div>{{ $homework->due_date }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           
        </div>
    @endif
    
    </div>


@endsection