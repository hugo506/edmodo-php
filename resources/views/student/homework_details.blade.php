
@extends('layouts.app')

@section('content')

    

    <div class="panel-body">
    
    <form action="{{ url('student/homework_submit') }}" method="POST" class="form-horizontal">
      
      		{{ csrf_field() }}
      		
      		<input type="hidden" name="homework_id" value="{{ $homework->id }}" />
      		      		
      		<h3>{{ $homework->title }}</h3>
    
		    <h4>{{ $homework->question }}</h4>
		    
		    <h4>My Answer:</h4>
		    
		    <div class="form-group">
		    	<textarea class="form-control" name="answer" rows="8"></textarea>
		    </div>
		    
		    <button type="submit" class="btn btn-default">
            	Submit
            </button>
                    
        </form>
        
    
    </div>


@endsection