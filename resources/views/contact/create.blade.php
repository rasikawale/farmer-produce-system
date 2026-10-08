@extends('layouts.app')

@section('content')

<section class="py-5 bg-light">
    <div class="container">

        <!-- Page Heading -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold">Contact Admin</h2>
                <p class="text-muted">
                    Have a question or issue? Send a message and our admin will respond.
                </p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="row justify-content-center">
            <div class="col-lg-7">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card border-0 shadow rounded-4">
                    <div class="card-body p-5">

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf

                            <!-- Subject -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text"
                                       name="subject"
                                       class="form-control rounded-pill @error('subject') is-invalid @enderror"
                                       placeholder="Enter subject"
                                       required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea name="message"
                                          rows="5"
                                          class="form-control rounded-3 @error('message') is-invalid @enderror"
                                          placeholder="Write your message here..."
                                          required></textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <button type="submit"
                                    class="btn btn-success w-100 rounded-pill py-2">
                                <i class="fas fa-paper-plane me-2"></i>
                                Send Message
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
