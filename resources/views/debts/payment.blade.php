@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
          <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
          <h2 class="card-title mb-3">Customer Utility Payment</h2>
          <form accept-charset="UTF-8" action="/" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="post">
                {{-- <div style="margin:0;padding:0;display:inline">
                <input name="utf8" type="hidden" value="✓" />
                <input name="_method" type="hidden" value="PUT" />
                <input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" />
            </div> --}}
            <div class='form-row mb-2'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Meter Number</label>
                <input class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row mb-2'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Utility Provider:</label>
                <input autocomplete='off' class='form-control' size='20' type='text'>
              </div>
            </div>
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
              <div class='col-md-12'>
                <div class='form-control total btn btn-info'>
                  Total:
                  <span class='amount'>Tsh.0</span>
                </div>
              </div>
            </div>
            <div class='form-row mb-3'>
              <div class='col-md-12 form-group'>
                <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
              </div>
            </div>
          </form>
        </div>
        <div class='col-md-4'></div>
    </div>
</div>
@endsection