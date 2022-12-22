@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Confirm Purchase') }}</div>

                    <div class="card-body">

                        <form action="{{route('pay')}}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" name="payment_method" id="payment_method" value="" />
                            <input type="hidden" name="order_id"  value="{{$order->id}}" />
                            <div class="col-md-6">
                                <div id="card-element"></div>
                                <button id="payment-button" type="button" class="btn btn-primary btn-sm  mt-3">Pay ${{$order->product->price}}</button>
                            </div>

                            @if(session('error'))

                               <div class="alert alert-danger mt-4">
                                   {{session('error')}}
                               </div>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{config('services.stripe.publishable_key')}}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount("#card-element");

        $("#payment-button").on("click",function(){
            $("#payment-button").attr("disabled",true);
            stripe
                .confirmCardSetup('{{$paymentIntent->client_secret}}', {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: '{{auth()->user()->name}}',
                        },
                    },
                })
                .then(function(result) {
                   if(result.error){

                   }else{
                        $("#payment_method").val(result.setupIntent.payment_method);
                        $("#payment-form").submit();
                   }
                });
        });


    </script>
@endsection
