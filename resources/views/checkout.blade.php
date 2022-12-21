@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Confirm Purchase') }}</div>

                    <div class="card-body">

                        <form action="{{route('pay')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <div id="card-element"></div>
                                <button type="submit" class="btn btn-primary btn-sm mt-3">Pay ${{$order->product->price}}</button>
                            </div>

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
        console.log('cardElement',cardElement)
        cardElement.mount("#card-element")



    </script>
@endsection
