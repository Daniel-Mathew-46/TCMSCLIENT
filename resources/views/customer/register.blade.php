@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container mt-5 mb-5 d-flex justify-content-center">
                <div class="card px-1 py-4">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(array('route' => 'customers.store','method'=>'POST')) !!}
                    <div class="card-body">
                        <h2 class="card-title mb-3">Customer Registration</h2>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Utility Provider:</label> 
                                    {!! Form::select('utility_provider', collect($providers)->pluck('provider_name', 'id'), null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Mobile No:</label> 
                                    {!! Form::text('mobile', null, array('placeholder' => 'Mobile Number','class' => 'form-control')) !!} 
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Address:</label> 
                                    {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>

                        <small class="agree-text">By clicking Register, you agree to our Terms & Conditions.</small>
                        <div class="row">
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-block confirm-button">Register</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection