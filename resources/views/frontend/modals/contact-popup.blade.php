{{-- resources/views/frontend/modals/contact-popup.blade.php --}}

<style>
  /* ══════════════════════════════════════
   CONTACT POPUP MODAL
══════════════════════════════════════ */
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(13, 10, 30, 0.75);
    backdrop-filter: blur(8px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .modal-overlay.show {
    opacity: 1;
    visibility: visible;
  }

  .modal-container {
    background: #ffffff;
    border-radius: 24px;
    max-width: 520px;
    width: 100%;
    position: relative;
    box-shadow: 0 24px 60px rgba(124, 58, 237, 0.2);
    transform: scale(0.9) translateY(20px);
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    max-height: 90vh;
    overflow-y: auto;
  }

  .modal-overlay.show .modal-container {
    transform: scale(1) translateY(0);
  }

  /* Close button */
  .modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(124, 58, 237, 0.08);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 1.2rem;
    color: #7c3aed;
    transition: all 0.2s;
    z-index: 1;
  }

  .modal-close:hover {
    background: rgba(124, 58, 237, 0.15);
    transform: rotate(90deg);
  }

  /* Header gradient */
  .modal-header {
    background: linear-gradient(135deg, #e91e8c, #7c3aed);
    padding: 36px 32px 32px;
    border-radius: 24px 24px 0 0;
    position: relative;
    overflow: hidden;
  }

  .modal-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.15), transparent 70%);
    pointer-events: none;
  }

  .modal-title {
    /* font-family: 'Syne', sans-serif; */
    font-size: 1.65rem;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
  }

  .modal-subtitle {
    font-size: 0.92rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.6;
    position: relative;
    z-index: 1;
  }

  /* Form body */
  .modal-body {
    padding: 32px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #2a2545;
    margin-bottom: 8px;
  }

  .form-label .required {
    color: #e91e8c;
    margin-left: 2px;
  }

  .form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #e5e7eb;
    border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.92rem;
    color: #2a2545;
    background: #ffffff;
    transition: all 0.2s;
    outline: none;
  }

  .form-input:focus {
    border-color: #7c3aed;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
  }

  .form-input.error {
    border-color: #ef4444;
  }

  textarea.form-input {
    min-height: 100px;
    resize: vertical;
  }

  .form-error {
    font-size: 0.78rem;
    color: #ef4444;
    margin-top: 6px;
    display: none;
  }

  .form-input.error~.form-error {
    display: block;
  }

  /* Submit button */
  .btn-submit {
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(135deg, #e91e8c, #7c3aed);
    border: none;
    border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
    position: relative;
    overflow: hidden;
  }

  .btn-submit:hover {
    box-shadow: 0 6px 24px rgba(124, 58, 237, 0.4);
    transform: translateY(-2px);
  }

  .btn-submit:active {
    transform: translateY(0);
  }

  .btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
  }

  .btn-submit .btn-text {
    position: relative;
    z-index: 1;
  }

  .btn-submit .btn-loader {
    position: absolute;
    inset: 0;
    display: none;
    align-items: center;
    justify-content: center;
  }

  .btn-submit.loading .btn-text {
    opacity: 0;
  }

  .btn-submit.loading .btn-loader {
    display: flex;
  }

  /* Spinner */
  .spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
  }

  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }

  /* Success message */
  .success-message {
    display: none;
    text-align: center;
    padding: 48px 32px;
  }

  .success-message.show {
    display: block;
  }

  .success-icon {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #10b981, #34d399);
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    animation: successPop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }

  @keyframes successPop {
    0% {
      transform: scale(0);
    }

    100% {
      transform: scale(1);
    }
  }

  .success-title {
    /* font-family: 'Syne', sans-serif; */
    font-size: 1.4rem;
    font-weight: 800;
    color: #2a2545;
    margin-bottom: 8px;
  }

  .success-text {
    font-size: 0.92rem;
    color: #6b6490;
    line-height: 1.6;
    margin-bottom: 24px;
  }

  .btn-close-success {
    padding: 12px 32px;
    background: #f3f4f6;
    border: none;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #2a2545;
    cursor: pointer;
    transition: background 0.2s;
  }

  .btn-close-success:hover {
    background: #e5e7eb;
  }

  @media (max-width: 560px) {
    .modal-container {
      max-height: 95vh;
      border-radius: 20px 20px 0 0;
      margin-top: auto;
    }

    .modal-header {
      padding: 28px 24px 24px;
    }

    .modal-title {
      font-size: 1.4rem;
    }

    .modal-body {
      padding: 24px;
    }
  }
</style>

{{-- Modal HTML --}}
<div class="modal-overlay" id="contactModal">
  <div class="modal-container">

    {{-- Close button --}}
    <button class="modal-close" onclick="closeContactModal()">✕</button>

    {{-- Header --}}
    <div class="modal-header">
      <h2 class="modal-title">Get in Touch</h2>
      <p class="modal-subtitle">Share your details and we'll reach out to you shortly.</p>
    </div>

    {{-- Form --}}
    <div class="modal-body" id="formBody">
      <form id="contactForm">
        <input type="hidden" name="source" id="contactSource" value="">

        <div class="form-group">
          <label class="form-label">Name<span class="required">*</span></label>
          <input type="text" name="name" class="form-input" placeholder="John Doe" required>
          <div class="form-error">Please enter your name</div>
        </div>

        <div class="form-group">
          <label class="form-label">Email<span class="required">*</span></label>
          <input type="email" name="email" class="form-input" placeholder="john@company.com" required>
          <div class="form-error">Please enter a valid email</div>
        </div>

        <div class="form-group">
          <label class="form-label">Phone</label>
          <input type="tel" name="phone" class="form-input" placeholder="+91 98765 43210">
        </div>

        <div class="form-group">
          <label class="form-label">Company</label>
          <input type="text" name="company" class="form-input" placeholder="Your Company Name">
        </div>

        <div class="form-group">
          <label class="form-label">Message</label>
          <textarea name="message" class="form-input" placeholder="Tell us how we can help you..." rows="4"></textarea>
        </div>

        <button type="submit" class="btn-submit">
          <span class="btn-text">Send Message</span>
          <span class="btn-loader"><span class="spinner"></span></span>
        </button>
      </form>
    </div>

    {{-- Success Message --}}
    <div class="success-message" id="successMessage">
      <div class="success-icon">✓</div>
      <h3 class="success-title">Message Sent!</h3>
      <p class="success-text">Thank you for reaching out. Our team will get back to you within 24 hours.</p>
      <button class="btn-close-success" onclick="closeContactModal()">Close</button>
    </div>

  </div>
</div>

<script>
  // Open modal
  function openContactModal(source = 'website') {
    document.getElementById('contactSource').value = source;
    document.getElementById('contactModal').classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  // Close modal
  function closeContactModal() {
    document.getElementById('contactModal').classList.remove('show');
    document.body.style.overflow = '';

    // Reset after animation
    setTimeout(() => {
      document.getElementById('contactForm').reset();
      document.getElementById('formBody').style.display = 'block';
      document.getElementById('successMessage').classList.remove('show');
      document.querySelectorAll('.form-input').forEach(input => input.classList.remove('error'));
    }, 300);
  }

  // Close on overlay click
  document.getElementById('contactModal').addEventListener('click', function(e) {
    if (e.target === this) closeContactModal();
  });

  // Close on ESC key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeContactModal();
  });

  // Form submission
  document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = this;
    const btn = form.querySelector('.btn-submit');
    const formData = new FormData(form);

    // Clear previous errors
    form.querySelectorAll('.form-input').forEach(input => input.classList.remove('error'));

    // Disable button
    btn.disabled = true;
    btn.classList.add('loading');

    try {
      const response = await fetch('/contact', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
        },
        body: formData
      });

      const data = await response.json();

      if (data.success) {
        // Show success message
        document.getElementById('formBody').style.display = 'none';
        document.getElementById('successMessage').classList.add('show');
      } else {
        // Show validation errors
        if (data.errors) {
          Object.keys(data.errors).forEach(field => {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
              input.classList.add('error');
              const errorDiv = input.nextElementSibling;
              if (errorDiv && errorDiv.classList.contains('form-error')) {
                errorDiv.textContent = data.errors[field][0];
              }
            }
          });
        }
        btn.disabled = false;
        btn.classList.remove('loading');
      }
    } catch (error) {
      alert('Something went wrong. Please try again.');
      btn.disabled = false;
      btn.classList.remove('loading');
    }
  });
</script>