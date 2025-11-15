@extends('user.layout.app')

@section('content')
<div class="container py-5">
    <div class="bg-white shadow-lg rounded p-5">

        <h2 class="text-primary mb-4 text-center">Frequently Asked Questions</h2>

        <div class="accordion" id="faqAccordion">

            <!-- FAQ 1 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse1">
                        What products does Pure Aqua Tech offer?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We offer RO water purifiers, filters, membranes, motor pumps, housings, and full water
                        treatment solutions including AMC and installation services.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse2">
                        Do you provide installation?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes! Installation is done by certified Pure Aqua Tech technicians. You will be contacted after placing your order.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse3">
                        How often should I service my RO purifier?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        RO purifiers generally require servicing every 3–6 months depending on water quality and usage.
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="faq4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse4">
                        Do you support Cash on Delivery?
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, COD is available for selected locations. You can check availability during checkout.
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="faq5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse5">
                        How can I track my order or service?
                    </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can track your orders & services from the user dashboard under "My Orders" and
                        "My Services".
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
