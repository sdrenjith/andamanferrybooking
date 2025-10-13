@extends('layouts.app')
@section('content')
<style>
    body {
      text-align: center;
      padding: 20px 0;
      background: #EBF0F5;
    }
    h1 {
      color: #d9534f;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-weight: 900;
      font-size: 40px;
      margin-bottom: 10px;
    }
    p {
      color: #404F5E;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-size: 20px;
      margin: 0;
    }
    .crossmark {
      color: #d9534f;
      font-size: 100px;
      line-height: 200px;
    }
    .card {
      background: white;
      padding: 40px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 120px 0px 65px 0px;
    }
</style>

<div class="card">
    <div style="border-radius:200px; height:200px; width:200px; background: #FFF5F5; margin:0 auto;">
        <i class="crossmark">✕</i>
    </div>
    <h1>Payment Failed</h1>
    
    <p>Your payment could not be processed.</p>
    
    @if(isset($transaction_id))
        <p class="mt-2"><strong>Transaction ID:</strong> {{ $transaction_id }}</p>
    @endif
    
    <div class="mt-4" style="font-size: 16px; color: #666;">
        <p>Don't worry, no amount has been deducted from your account.</p>
        <p>If any amount was deducted, it will be refunded within 5-7 business days.</p>
    </div>
    
    <div class="mt-5">
        <a href="{{ url('/') }}" class="btn btn-primary">
            <i class="fas fa-redo"></i> Try Again
        </a>
        <a href="{{ route('home') }}" class="btn btn-secondary ml-2">
            <i class="fas fa-home"></i> Go to Home
        </a>
    </div>
    
    <div class="mt-4" style="font-size: 14px; color: #666;">
        <p>For any queries regarding this transaction, please contact our support team with the transaction ID.</p>
    </div>
</div>

@endsection