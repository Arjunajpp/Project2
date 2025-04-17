<!-- Footer -->
<footer class="bg-white py-4 mt-auto shadow-sm">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div>
                    &copy; <?= date('Y') ?> E-Sarpras | Sistem Inventaris Sarana Prasarana Dinas Pendidikan
                </div>
                <div>
                    <a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a>
                    &middot;
                    <a href="#" class="text-muted text-decoration-none">Syarat &amp; Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js for displaying dynamic charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- jQuery UI for animations -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Moment.js for date handling -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    
    <!-- Common functions used across the application -->
    <script>
        // Formatting functions
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }
        
        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }
        
        function formatDate(dateString) {
            return moment(dateString).format('DD MMM YYYY');
        }
        
        // Toast notification system
        function showToast(message, type = 'success') {
            // Create toast container if not exists
            if ($('.toast-container').length === 0) {
                $('body').append('<div class="toast-container"></div>');
            }
            
            // Generate random ID
            const toastId = 'toast-' + Math.floor(Math.random() * 1000000);
            
            // Set icon based on type
            let icon = 'check-circle';
            let bgClass = 'bg-success';
            
            switch(type) {
                case 'error':
                    icon = 'times-circle';
                    bgClass = 'bg-danger';
                    break;
                case 'warning':
                    icon = 'exclamation-triangle';
                    bgClass = 'bg-warning';
                    break;
                case 'info':
                    icon = 'info-circle';
                    bgClass = 'bg-info';
                    break;
            }
            
            // Create toast HTML
            const toast = `
                <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                    <div class="toast-header ${bgClass} text-white">
                        <i class="fas fa-${icon} me-2"></i>
                        <strong class="me-auto">Notifikasi</strong>
                        <small>baru saja</small>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;
            
            // Append toast to container
            $('.toast-container').append(toast);
            
            // Initialize and show toast
            const toastElement = new bootstrap.Toast(document.getElementById(toastId));
            toastElement.show();
            
            // Remove toast after it's hidden
            $(`#${toastId}`).on('hidden.bs.toast', function() {
                $(this).remove();
            });
        }
        
        // Confirm dialog
        function confirmAction(message, callback) {
            if (confirm(message)) {
                callback();
            }
        }
        
        // Ajax form submission with validation
        function submitFormAjax(formSelector, successCallback, errorCallback) {
            const form = $(formSelector);
            
            form.on('submit', function(e) {
                e.preventDefault();
                
                // Basic validation
                let isValid = true;
                form.find('[required]').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                if (!isValid) {
                    showToast('Harap isi semua field yang wajib diisi.', 'error');
                    return;
                }
                
                // Submit form
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        if (typeof successCallback === 'function') {
                            successCallback(response);
                        } else {
                            showToast('Data berhasil disimpan.');
                        }
                    },
                    error: function(xhr) {
                        if (typeof errorCallback === 'function') {
                            errorCallback(xhr);
                        } else {
                            showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
                        }
                    }
                });
            });
        }
        
        // Data table helper
        function initDataTable(selector, options = {}) {
            if (typeof $.fn.DataTable !== 'undefined') {
                const defaultOptions = {
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        zeroRecords: "Tidak ada data yang ditemukan",
                        info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                        infoEmpty: "Tidak ada data tersedia",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    },
                    responsive: true
                };
                
                return $(selector).DataTable({...defaultOptions, ...options});
            } else {
                console.error('DataTables library is not loaded.');
                return null;
            }
        }
        
        // On document ready
        $(document).ready(function() {
            // Enable tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
            
            // Enable popovers
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
            
            // Flash messages
            <?php if (session()->getFlashdata('success')): ?>
                showToast('<?= session()->getFlashdata('success') ?>', 'success');
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('error')): ?>
                showToast('<?= session()->getFlashdata('error') ?>', 'error');
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('warning')): ?>
                showToast('<?= session()->getFlashdata('warning') ?>', 'warning');
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('info')): ?>
                showToast('<?= session()->getFlashdata('info') ?>', 'info');
            <?php endif; ?>
        });
    </script>
</body>
</html>