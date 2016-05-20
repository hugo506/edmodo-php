@extends('layouts.app')

@section('content')

    <div class="panel-body">

        <form action="{{ url('login') }}" method="POST" class="form-horizontal">
      
      		{{ csrf_field() }}
      		
            <div class="form-group">
                <label class="col-sm-3 control-label">Username</label>

                <div class="col-sm-6">
                    <input type="text" name="username" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                    	Login
                    </button>
                </div>
            </div>
        </form>
    </div>
    
@endsection