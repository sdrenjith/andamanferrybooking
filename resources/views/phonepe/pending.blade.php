@extends('layouts.app')

@section('content')

<style>
    body {
      text-align: center;
      padding: 20px 0;
      background: #EBF0F5;
    }

    h1 {
      color: #F0AD4E;
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

    .spinner {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #F0AD4E;
      border-radius: 50%;
      width: 100px;
      height: 100px;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .card {
      background: white;
      padding: 40px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 2 auto;
    }
</style>

<div class="card">
  <div class="spinner"></div>
  <h1>Payment Pending</h1>
  <p>Your payment is being processed.<br />
  Transaction ID: {{ $transaction_id }}</p>
  <p class="mt-2 text-muted">Please wait while we confirm your payment...</p>
  <p class="mt-3 text-info">This page will auto-refresh in <span id="countdown">30</span> seconds</p>
  <div class="mt-5">
    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
  </div>
</div>

<script>
let countdown = 30;
const countdownElement = document.getElementById('countdown');

setInterval(() => {
    countdown--;
    countdownElement.textContent = countdown;
    
    if (countdown <= 0) {
        window.location.reload();
    }
}, 1000);
</script>

@endsection
