@extends('admin.client.client_app')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form action="{{url('update_evalution_rating')}}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Assessment</label>
									<input type="hidden" name="id" id="id" class="form-control" placeholder="Assessment" value="{{$data->id}}">
									<input type="text" name="assessment" id="Assessment" class="form-control" placeholder="Assessment" value="{{$data->assessment}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Rating</label>
									<input type="text" name="rating" id="rating" class="form-control" placeholder="Rating" value="{{$data->rating}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Background Color</label>
									<input type="text" name="color" id="color" class="form-control" placeholder="Background Color" value="{{$data->color}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Text Color</label>
									<input type="text" name="text_color" id="text_color" class="form-control" placeholder="Text Color" value="{{$data->text_color}}">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<a href="{{ url('evaluation_rate') }}" class="btn btn-secondary mt-3 ml-2 float-right" style="padding: 6px 30px;border-radius:30px;font-size:18px;"><b>Cancel</b></a>
									<input type="submit" class="buton mt-3 float-right" value="Update" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection