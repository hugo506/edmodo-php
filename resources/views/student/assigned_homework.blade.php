
@extends('layouts.app')

@section('content')

    

    <div class="panel-body">
    
    <h3>My Assignments</h3>
    
    @if (count($student->assignedHomework) > 0)
    
        <div class="panel panel-default">
        
            <div class="panel-heading">
                Current Homework
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
                        @foreach ($student->assignedHomework as $homework)
                            <tr>
                                <td class="table-text">
                                    <div>
                                    	<a href="{{ url('student/homework_details/'.$homework->id) }}" class="navbar-link">{{ $homework->title }}</a>					
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