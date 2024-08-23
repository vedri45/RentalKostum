<!-- RENT -->
<section class="mosh--services-area section_padding_100">
    <div class="container mt-4">
        @include('frontend.rent.data-form')
        @include('frontend.rent.checkout-form')
    </div>
</section>

<script>
    document.getElementById('fileinput').addEventListener('change', function(event) {
        const files = event.target.files;
        if (files && files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(files[0]);
        }
    });

    document.getElementById('nextStep').addEventListener('click', function() {
        const form = document.getElementById('data-form');

        // Perform frontend validation
        if (!form.checkValidity()) {
            alert('Please fill out all required fields.');
            return;
        }

        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hide the current form and show the next form
                    document.getElementById('step1Form').style.display = 'none';
                    document.getElementById('step2Form').style.display = 'block';
                } else {
                    // Handle server-side validation errors
                    alert('Error saving data: ' + data.error_message);
                }
            })
            .catch(error => {
                // Handle network errors
                alert('Network error: ' + error.message);
            });
    });
</script>
<!-- RENT END -->
