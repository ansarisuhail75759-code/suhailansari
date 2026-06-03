/**
 * Volt & Velocity (V&V) - Client Side Script
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Navbar Scroll Effect
    const navbar = document.querySelector('.navbar-custom');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // 2. Scroll Reveal Animation
    const revealElements = document.querySelectorAll('.reveal');
    const revealOnScroll = () => {
        revealElements.forEach(el => {
            const rect = el.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            if (rect.top < windowHeight * 0.85) {
                el.classList.add('active');
            }
        });
    };
    // Run on init and scroll
    revealOnScroll();
    window.addEventListener('scroll', revealOnScroll);

    // 3. Dynamic Car Filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    const carItems = document.querySelectorAll('.car-item-col');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Remove active from all buttons
            filterButtons.forEach(b => b.classList.remove('btn-neon'));
            filterButtons.forEach(b => b.classList.add('btn-outline-neon'));
            
            // Add active to current
            btn.classList.remove('btn-outline-neon');
            btn.classList.add('btn-neon');

            const filterValue = btn.getAttribute('data-filter');

            carItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    // Re-trigger animation
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // 4. Contact Form Validation and Simulation
    const bookingForm = document.getElementById('bookingForm');
    const formResponse = document.getElementById('formResponse');

    if (bookingForm) {
        // Auto-select car model if selected from inventory
        const selectModel = document.getElementById('carModel');
        const bookButtons = document.querySelectorAll('.btn-book-now');
        
        bookButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const modelValue = btn.getAttribute('data-model');
                if (selectModel && modelValue) {
                    selectModel.value = modelValue;
                    // Scroll to form
                    document.getElementById('test-drive').scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        bookingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const name = document.getElementById('clientName').value.trim();
            const email = document.getElementById('clientEmail').value.trim();
            const phone = document.getElementById('clientPhone').value.trim();
            const carModel = selectModel ? selectModel.value : '';
            const bookingDate = document.getElementById('bookingDate').value;

            if (!name || !email || !phone || !carModel || !bookingDate) {
                showFeedback('Please fill in all details to book your session.', 'danger');
                return;
            }

            // Construct FormData for PHP submission
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('carModel', carModel);
            formData.append('bookingDate', bookingDate);

            const submitBtn = bookingForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Securing Slot...';

            fetch('submit_booking.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                
                if (data.success) {
                    bookingForm.reset();
                    showFeedback(`
                        <div class="text-center p-3">
                            <i class="bi bi-patch-check-fill text-success fs-1 mb-3"></i>
                            <h4 class="text-white mb-2">Test Drive Confirmed!</h4>
                            <p class="text-muted mb-3">Congratulations <strong>${data.booking.name}</strong>, your private showcase session with the <strong>${data.booking.car}</strong> has been secured.</p>
                            <hr class="border-glass my-3">
                            <div class="row text-start justify-content-center">
                                <div class="col-sm-5"><span class="text-muted">Date:</span> <br><strong>${data.booking.date}</strong></div>
                                <div class="col-sm-5"><span class="text-muted">Lounge Location:</span> <br><strong>V&V Premium Experience Center</strong></div>
                            </div>
                            <p class="text-muted mt-3 mb-0" style="font-size:0.85rem;">A confirmation pass has been sent to <strong>${data.booking.email}</strong>.</p>
                        </div>
                    `, 'success');
                } else {
                    showFeedback(data.message || 'An error occurred. Please try again.', 'danger');
                }
            })
            .catch(error => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                showFeedback(error.message || 'Server connection failed. Please check network.', 'danger');
            });
        });
    }

    function showFeedback(message, type) {
        if (!formResponse) return;
        
        formResponse.innerHTML = message;
        formResponse.className = `alert mt-4 ${type === 'success' ? 'alert-success border-success bg-dark' : 'alert-danger border-danger bg-dark'}`;
        formResponse.style.display = 'block';
        formResponse.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
});
