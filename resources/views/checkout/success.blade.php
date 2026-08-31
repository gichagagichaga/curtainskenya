@extends('layouts.public')
@section('title', 'Order Received | Curtains Kenya')
@section('content')
<section class="bg-[#faf8f5]"><div class="mx-auto max-w-3xl px-6 py-24 text-center lg:px-8"><p class="text-xs font-semibold tracking-[0.25em] text-[#8a6a4a] uppercase">Thank you</p><h1 class="mt-3 font-serif text-4xl text-[#29231e] sm:text-5xl">Your order is received.</h1><p class="mt-6 text-lg leading-8 text-[#665b52]">Your order number is <span class="font-semibold text-[#29231e]">{{ $order->order_number }}</span>. Our team will contact you to confirm delivery and payment.</p><a href="{{ route('shop.index') }}" class="mt-9 inline-flex bg-[#29231e] px-6 py-3 text-sm font-medium tracking-[0.14em] text-white uppercase">Continue shopping</a></div></section>
@endsection
