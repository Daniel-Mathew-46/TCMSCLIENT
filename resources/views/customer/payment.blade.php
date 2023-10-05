@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
          <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
          <h2 class="card-title mb-3">Customer Utility Payment</h2>
          {{-- <form accept-charset="UTF-8" action="/" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="post"> --}}
            {!! Form::open(['method' => 'POST','route' => ['debts.store']]) !!}
            <div class='form-row mb-2'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Meter Number</label>
                {!! Form::select('meters_id', collect($meters)->pluck('meter_number', 'id'), null, array('class' => 'form-control')) !!}
              </div>
            </div>
            {{-- <div class='form-row mb-2'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Utility Provider:</label>
                <input autocomplete='off' class='form-control' size='20' type='text'>
              </div>
            </div> --}}
            <div class='form-row mb-2'>
              <div class='col-xs-4 form-group expiration required mb-3'>
                <label class='control-label'>Mobile No:</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-xs-4 form-group cvc required mb-3'>
                <label class='control-label'>Amount</label>
                <input autocomplete='off' class='form-control' placeholder='Amount' size='4' type='text'>
              </div>
            </div>
            <div class='form-row mb-3'>
              <div class='col-md-12 form-group'>
                <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
              </div>
            </div>
          {{-- </form> --}}
          {!! Form::close() !!}
        </div>
        <div class='col-md-4'></div>
    </div>
</div>
@endsection