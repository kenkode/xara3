@extends('layouts.main')
{{ HTML::script('media/jquery-1.12.0.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
$('#d').hide();
$('#action').change(function(){
if($(this).val() == "Suspension"){
    $('#d').show();
}else{
    $('#d').hide();
}

});
});
</script>

@section('content')

<div class="row">
	<div class="col-lg-12">
  <h3>New Promotion/ Demotion</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('promotions') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
                        <label for="username">Employee <span style="color:red">*</span></label>
                        <select name="employee" class="form-control">
                           <option></option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"> {{ $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name }}</option>
                            @endforeach
                        </select>
                
                    </div>     

        <div class="form-group">
            <label for="username">Reason<span style="color:red">*</span> </label>
            <textarea class="form-control" name="reason" id="reason">{{{ Input::old('reason') }}}</textarea>
        </div>

        <div class="form-group">
                        <label for="username">Type <span style="color:red">*</span></label>
                        <select name="type" id="type" class="form-control forml">
                            <option></option>
                            <option value="Promotion">Promotion</option>
                            <option value="Demotion">Demotion</option>
                        </select>
                
                    </div>

        <div class="form-group">
                        <label for="username">Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control allowancedate" readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{{ Input::old('date') }}}">
                        </div>
        </div>

        <script type="text/javascript">
$(function(){ 

$('.allowancedate').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-60y',
    autoclose: true
});
});

</script>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop