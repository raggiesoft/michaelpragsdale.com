@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="page-header">
            <h1>Contact Me</h1>
            <p class="lead">To ensure we make the best use of everyone's time, please review the following information before getting in touch.</p>
        </header>

        <div id="contact-flow-app">
            <div class="accordion">

                <details class="accordion-item" id="accordion-location">
                    <summary class="accordion-header">What locations are you considering?</summary>
                    <div class="accordion-content">
                        <p>I am actively seeking opportunities that are either <strong>fully remote</strong> (for companies that hire residents of Virginia, USA) or <strong>in-office</strong> for the following cities only:</p>
                        <ul id="location-list-display">
                            {{-- This list is dynamically populated by JavaScript --}}
                        </ul>
                    </div>
                </details>

                <details class="accordion-item" id="accordion-salary">
                    <summary class="accordion-header">What are your salary expectations?</summary>
                    <div class="accordion-content">
                        <p>My salary requirements are competitive for the region. To see if we are aligned, please use this quick tool:</p>
                        <div id="salary-checker-container" class="salary-checker-app" style="margin-top: 1.5rem;">
                            <div id="salary-result-container" style="margin-top: 1.5rem;" aria-live="polite"></div>
                        </div>
                    </div>
                </details>

                <details class="accordion-item" id="accordion-schedule">
                    <summary class="accordion-header">What's the best way to schedule an interview?</summary>
                    <div class="accordion-content">
                        <p>If the location and compensation for your opportunity align with the information above, the best and fastest way to get on my calendar is to book a time directly using my Calendly link.</p>
                        <p style="margin-top: 1.5rem;">
                            <a href="https://calendly.com/michaelpragsdale/interview-with-michael-ragsdale/" class="button button-success button-lg">
                                <i class="fa-duotone fa-calendar-days fa-fw"></i> Book an Interview Now
                            </a>
                        </p>
                    </div>
                </details>

                <details class="accordion-item" id="accordion-form">
                    <summary class="accordion-header">Prefer to send a direct message?</summary>
                    <div class="accordion-content">
                        <p>If you prefer to send a message first, please use the form below. I'll get back to you as soon as possible.</p>
                        <form id="contact-form" action="{{ url('contact') }}" method="POST" style="margin-top: 1.5rem;">
                            @csrf

                            {{-- Display Success or Error Messages --}}
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- Honeypot Field: Hidden from users, but not from bots --}}
                            <div class="form-group" style="display:none !important;" aria-hidden="true">
                                <label for="website">Website</label>
                                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email') <div class="form-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message') <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="button button-primary">
                                <i class="fa-duotone fa-paper-plane fa-fw"></i> Send Message
                            </button>
                        </form>
                    </div>
                </details>

            </div>
        </div>
    </div>
@endsection
