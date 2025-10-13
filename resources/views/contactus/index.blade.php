@extends('layouts.app')
@section('title', 'Contact Us – Andaman Ferry Online Booking Support')
@section('meta_title', 'Contact Us | Andaman Ferry Online Booking Support')
@section('meta_description', 'Need help with your Andaman ferry booking? Contact our support team for assistance with reservations, cancellations, rescheduling, and travel queries.')

@section('content')
<main class="contact-modern-bg py-5">
    <div class="container">
        <div class="row justify-content-center align-items-stretch g-4">
            <div class="col-12 col-lg-7 d-flex align-items-stretch">
                <form class="glass-card-modern p-4 w-100" id="contactus_form" name="contactus_form" method="POST" action="{{ url('contact-us-save') }}">
                    @csrf
                    <div class="mb-4 text-center">
                        <h2 class="fw-bold mb-1">Contact Us</h2>
                        <p class="text-muted mb-0">We'd love to hear from you! Fill out the form and our team will get back to you soon.</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label-modern">Your Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-modern" id="name" placeholder="Enter your name">
                        <span class="text-danger d-none error-msg" id="name_error">This field is required.</span>
                    </div>
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label-modern">Your Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control form-control-modern" id="email" placeholder="Enter your email">
                        <span class="text-danger d-none error-msg" id="email_error">This field is required.</span>
                    </div>
                        <div class="col-12 col-md-6">
                            <label for="mobile" class="form-label-modern">Your Mobile<span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control form-control-modern" id="mobile" placeholder="Mobile No" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <span class="text-danger d-none error-msg" id="mobile_error">This field is required.</span>
                    </div>
                        <div class="col-12">
                            <label for="message" class="form-label-modern">Your Message</label>
                            <textarea name="message" id="message" class="form-control form-control-modern" placeholder="Write your message here..." rows="4"></textarea>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button class="btn btn-modern-primary px-5 py-2 fw-bold" type="submit" id="send_btn" name="send_btn">Send Message</button>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger mt-3">{{$errors->first()}}</div>
                    @endif
                    @if (Session::has('msg'))
                        <div class="alert alert-success mt-3">
                            <ul class="mb-0"><li>{!! Session::get('msg') !!}</li></ul>
                        </div>
                    @endif
                </form>
            </div>
            <div class="col-12 col-lg-5 d-flex align-items-stretch">
                <div class="glass-card-modern p-4 w-100 d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold mb-2 text-center">Contact Information</h3>
                        <p class="text-center text-muted mb-4">Available 24/7</p>
                        
                        <div class="mb-4 d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill contact-icon-modern me-3 mt-1"></i>
                            <div>
                                <div class="fw-semibold mb-1">Address</div>
                                <div class="text-muted">1st floor, Premnagar Muthoot Finance Building<br>Port Blair, Andaman and Nicobar Island<br>PIN - 744102</div>
                            </div>
                        </div>
                        
                        <div class="mb-4 d-flex align-items-center">
                            <i class="bi bi-envelope-at-fill contact-icon-modern me-3"></i>
                            <div>
                                <div class="fw-semibold mb-1">Email</div>
                                <a href="mailto:andamanferrybookings@gmail.com" class="text-decoration-none text-dark">andamanferrybookings@gmail.com</a>
                            </div>
                        </div>
                        
                        <div class="mb-4 d-flex align-items-center">
                            <i class="bi bi-telephone-fill contact-icon-modern me-3"></i>
                            <div>
                                <div class="fw-semibold mb-1">Phone</div>
                                <a href="tel:+919679061419" class="text-decoration-none text-dark">+91 9679061419</a><br>
                                <a href="tel:+919933281206" class="text-decoration-none text-dark">+91 9933281206</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="https://www.facebook.com/profile.php?id=61551926759700" target="_blank" class="social-link-modern" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/andamanferrybooking" target="_blank" class="social-link-modern" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://wa.me/+919933281206" target="_blank" class="social-link-modern" title="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // alert();
    })
    $("#contactus_form").submit(function(e) {
        $(".error-msg").addClass('d-none');
        var name = $("#name").val();
        var email = $("#email").val();
        var mobile = $("#mobile").val();
        var message = $("#message").val();
        var error = 0;
        if ($.trim(name) == '') {
            $("#name_error").removeClass('d-none');
            error++;
        }
        if ($.trim(mobile) == '') {
            $("#mobile_error").removeClass('d-none');
            error++;
        } else {
            var filter = /^\d{10}$/;
            if (!filter.test(mobile)) {
                error++;
                $("#mobile_error").removeClass('d-none').text('Incorrect mobile number.');
            }
        }
        if ($.trim(email) == '') {
            $("#email_error").removeClass('d-none');
            error++;
        } else {
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (!testEmail.test(email)) {
                $("#email_error").removeClass('d-none').text('Invalid email format.');
                error++;
            }
        }
        if (error == 0) {
            $(this).submit();
        } else {
            return false;
        }
    });
</script>
@endpush