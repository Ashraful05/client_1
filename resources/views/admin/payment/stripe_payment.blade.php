@extends('admin.master')
@section('main_content')
    {{--    <div class="row">--}}
    {{--        <h1>Payment Form</h1>--}}

    {{--        @if(session('success'))--}}
    {{--            <div style="color: green;">--}}
    {{--                {{ session('success') }}--}}
    {{--            </div>--}}
    {{--        @endif--}}

    {{--       <div class="row col-lg-8">--}}
    {{--           <form action="{{ route('stripe.payment') }}" method="POST">--}}
    {{--               @csrf--}}
    {{--               <div class="form-control">--}}
    {{--                   <label for="name">Name:</label>--}}
    {{--                   <input type="text" name="name" id="name" required>--}}
    {{--               </div>--}}
    {{--               <div class="form-control">--}}
    {{--                   <label for="email">Email:</label>--}}
    {{--                   <input type="email" name="email" id="email" required>--}}
    {{--               </div>--}}
    {{--               <div class="form-control">--}}
    {{--                   <label for="amount">Amount:</label>--}}
    {{--                   <input type="number" name="amount" id="amount" step="0.01" required>--}}
    {{--               </div>--}}
    {{--               <div class="form-control">--}}
    {{--                   <label for="amount">Amount:</label>--}}
    {{--                   <input type="number" name="amount" id="amount" step="0.01" required>--}}
    {{--                   <label for="payment_method">Payment Method:</label>--}}
    {{--                   <select name="payment_method" id="payment_method" required>--}}
    {{--                       <option value="credit_card">Credit Card</option>--}}
    {{--                       <option value="paypal">PayPal</option>--}}
    {{--                       <option value="bank_transfer">Bank Transfer</option>--}}
    {{--                   </select>--}}
    {{--               </div>--}}
    {{--               <div class="form-control">--}}
    {{--                   <button type="submit">Submit Payment</button>--}}
    {{--               </div>--}}
    {{--           </form>--}}
    {{--       </div>--}}
    {{--    </div>--}}



    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase text-center">Payment Form</h6>
            <hr/>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary text-center">Stripe Payment</h5>
                    </div>
                    <hr>
                    <form action="{{ route('stripe.payment') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="inputFirstName">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAmount" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" id="inputAmount">
                        </div>
                        <div class="col-md-6">
                            <label for="payment_method" class="form-label">Payment Method:</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="credit_card">Credit Card</option>
                                <option value="stripe">Stripe</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary form-control">Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
