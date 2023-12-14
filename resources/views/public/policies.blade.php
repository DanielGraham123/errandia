@extends('public.layout')
@section('section')
    <section class="faq-box-contain section-b-space">
        <div class="container">
            {{-- <div class="">
                <div class="faq-contain">
                    <h2>Our Terms & Policies</h2>
                    <p></p>
                </div>
            </div> --}}

            <div class="">
                <div class="">
                    <div class="" id="accordionExample">
                            <div class="">
                                <h2 class="accordion-header">
                                    <h2 class="heading text-secondary" >
                                        {{ $policy->title ?? "Policy Item" }}
                                    </h2>
                                </h2>
                                <div class="" style="">
                                    <div class="">
                                        {!! $policy->content !!} </p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection