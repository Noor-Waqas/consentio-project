@extends('admin.client.client_app')
@section('content')
@section('page_title')
  {{ __('EVAUATION RATING') }}
@endsection
<div class="row">
  <div class="col-12">
  <div class="card">
    <div class="card-table">
   
      <div class="table-responsive cust-table-width">
      	

        <table class="table fixed_header manage-assessments-table" id="forms-table">
          <thead class="back_blue">
            <tr>
              
              <th style="vertical-align: middle;" scope="col" col-span="2" >Assessment</th>
              <th style="vertical-align: middle;" scope="col" col-span="2" >Rating</th>
              <th style="vertical-align: middle;" scope="col" col-span="2" >Background Color</th>
              <th style="vertical-align: middle;" scope="col" col-span="2" >Text Color</th>
              <th style="vertical-align: middle;" scope="col" col-span="2" >Action</th>

            </tr>
          </thead>
          <tbody>
            	@foreach($data as $val)
            	<tr>
            		<td>{{$val->assessment}}</td>
            		<td>{{$val->rating}}</td>
            		<td>{{$val->color}}</td>
            		<td>{{$val->text_color}}</td>
                <td><a href="{{url('edit-evalution/'.$val->id)}}" class="btn btn-primary">Edit</a></td>
            	</tr>
            	@endforeach
          </tbody>
        </table>
         
      </div>
      </div>
    </div>
  </div>
</div> 
 <script>
    $(document).ready(function(){
        $('#forms-table').DataTable({
                "order": []
        });

        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    })
</script> 
@endsection