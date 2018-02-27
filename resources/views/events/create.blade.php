@extends ('layout')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">

					<h1>Create an Event</h1>

					<hr>

					<form class="form-horizontal" role="form" method="POST" action="/events">
						{{ csrf_field() }}

						<div class="form-group row">
							<label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

							<div class="col-md-6">
								<input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}"  autofocus>

								@if ($errors->has('title'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

							<div class="col-md-6">
								<textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}"></textarea> 

								@if ($errors->has('description'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

							<div class="col-md-6">
								<input id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" value="{{ old('category') }}" >

								@if ($errors->has('category'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('category') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="date" class="col-md-4 col-form-label text-md-right">Date</label>

							<div class="col-md-6">
								<input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" >

								@if ($errors->has('date'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('date') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

							<div class="col-md-6">
								<input id="price" type="integer" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" >

								@if ($errors->has('price'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('price') }}</strong>
								</span>
								@endif
							</div>
						</div>



						<div class="form-group row">
							<label for="ages" class="col-md-4 col-form-label text-md-right">Age Range</label>

							<div class="col-md-6">
								<input id="ages" type="text" class="form-control{{ $errors->has('ages') ? ' is-invalid' : '' }}" name="ages" >

								@if ($errors->has('ages'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('ages') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="availability" class="col-md-4 col-form-label text-md-right">Availability</label>

							<div class="col-md-6">
								<input id="availability" type="number" class="form-control{{ $errors->has('availability') ? ' is-invalid' : '' }}" name="availability" value="{{ old('availability') }}" >

								@if ($errors->has('availability'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('availability') }}</strong>
								</span>
								@endif
							</div>
						</div>


						<div class="form-group row">
							<label for="city" class="col-md-4 col-form-label text-md-right">City</label>

							<div class="col-md-6">
								<input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" >

								@if ($errors->has('city'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('city') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

							<div class="col-md-6">
								<input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" >

								@if ($errors->has('address'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="number" class="col-md-4 col-form-label text-md-right">Number</label>

							<div class="col-md-6">
								<input id="number" type="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" value="{{ old('number') }}" >

								@if ($errors->has('number'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('number') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="zip" class="col-md-4 col-form-label text-md-right">Zip Code</label>

							<div class="col-md-6">
								<input id="zip" type="text" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip" value="{{ old('zip') }}" >

								@if ($errors->has('zip'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('zip') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection