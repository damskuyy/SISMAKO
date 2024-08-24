<script src="{{ asset('dist/js/tabler.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.min.js') }}"></script>
<script src="https://kit.fontawesome.com/82f9bbc013.js" crossorigin="anonymous"></script>
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js CDN -->
<script src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}" defer></script>
<script src="https://kit.fontawesome.com/82f9bbc013.js" crossorigin="anonymous"></script>
<script src="https://cdn.tailwindcss.com"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let correctPassword = localStorage.getItem('password') || '12345';
        const submitButton = document.getElementById('submitPassword');
        const passwordInput = document.getElementById('passwordInput');
        const passwordError = document.getElementById('passwordError');
        const changePasswordButton = document.getElementById('changePasswordButton');
        let targetUrl = '';

        const changePasswordModalElement = document.getElementById('changePasswordModal');
        const successModalElement = document.getElementById('modal-success');
        const submitChangePasswordButton = document.getElementById('submitChangePassword');
        const currentPasswordInput = document.getElementById('currentPasswordInput');
        const newPasswordInput = document.getElementById('newPasswordInput');
        const changePasswordError = document.getElementById('changePasswordError');

        function showModal(modalElement, backdropOption = true) {
            const modalInstance = new bootstrap.Modal(modalElement, {
                backdrop: backdropOption
            });
            modalInstance.show();

            // Focus on specific fields based on the modal
            modalElement.addEventListener('shown.bs.modal', function() {
                if (modalElement === document.getElementById('passwordModal')) {
                    passwordInput.focus();
                } else if (modalElement === changePasswordModalElement) {
                    currentPasswordInput.focus();
                }
            });
        }

        function hideModal(modalElement) {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
                // Ensure the backdrop is also removed if necessary
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.parentNode.removeChild(backdrop);
                });
            }
        }

        function resetAllModals() {
            const modals = [
                document.getElementById('passwordModal'),
                changePasswordModalElement,
                successModalElement
            ];
            modals.forEach(modal => {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                    // Ensure the backdrop is also removed if necessary
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                        backdrop.parentNode.removeChild(backdrop);
                    });
                }
            });
        }

        document.querySelectorAll('.modals a').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                targetUrl = this.getAttribute('data-url');
                passwordInput.value = '';
                passwordError.classList.add('d-none');
                showModal(document.getElementById('passwordModal'));
            });
        });

        passwordInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                submitButton.click();
            }
        });

        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            const enteredPassword = passwordInput.value.trim();

            if (enteredPassword === correctPassword) {
                hideModal(document.getElementById('passwordModal'));
                window.location.href = targetUrl;
            } else {
                passwordError.classList.remove('d-none');
            }
        });

        changePasswordButton.addEventListener('click', function() {
            hideModal(document.getElementById('passwordModal'));
            currentPasswordInput.value = '';
            newPasswordInput.value = '';
            changePasswordError.classList.add('d-none');
            showModal(changePasswordModalElement);
        });

        submitChangePasswordButton.addEventListener('click', function(event) {
            event.preventDefault();
            const enteredCurrentPassword = currentPasswordInput.value.trim();
            const newPassword = newPasswordInput.value.trim();

            if (enteredCurrentPassword === correctPassword && newPassword) {
                correctPassword = newPassword;
                localStorage.setItem('password', correctPassword);
                resetAllModals();

                showModal(successModalElement, false); // No backdrop for success modal
            } else {
                changePasswordError.classList.remove('d-none');
            }
        });

        // Add event listener for Enter key in Change Password Modal
        newPasswordInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                submitChangePasswordButton.click();
            }
        });

        // Remove disabled attribute
        document.querySelectorAll('button, a, input').forEach(element => {
            element.removeAttribute('disabled');
        });
    });

        function updateChart(chart, data) {
            const ctx = document.getElementById('modalAverageChart').getContext('2d');
            if (chart) {
                chart.destroy(); // Destroy existing chart if it exists
            }
            return new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Populate filter dropdowns with unique values from the table
        function populateFilters() {
            const tableRows = document.querySelectorAll('#dataTable tbody tr');
            const tahunAjaranSet = new Set();
            const kelasSet = new Set();
            const semesterSet = new Set();

            tableRows.forEach(row => {
                tahunAjaranSet.add(row.cells[0].textContent.trim());
                kelasSet.add(row.cells[1].textContent.trim());
                semesterSet.add(row.cells[2].textContent.trim());
            });

            const populateDropdown = (id, values) => {
                const dropdown = document.getElementById(id);
                dropdown.innerHTML = '<option value="all">All</option>'; // Add "All" option
                values.forEach(value => {
                    dropdown.innerHTML += `<option value="${value}">${value}</option>`;
                });
            };

            // Populate Tahun Ajaran dropdown with unique values
            const tahunAjaranDropdownStart = document.getElementById('filterTahunAjaranStart');
            const tahunAjaranDropdownEnd = document.getElementById('filterTahunAjaranEnd');
            tahunAjaranDropdownStart.innerHTML = '<option value="all">All</option>';
            tahunAjaranDropdownEnd.innerHTML = '<option value="all">All</option>';

            [...tahunAjaranSet].forEach(value => {
                tahunAjaranDropdownStart.innerHTML += `<option value="${value}">${value}</option>`;
                tahunAjaranDropdownEnd.innerHTML += `<option value="${value}">${value}</option>`;
            });

            populateDropdown('filterKelas', [...kelasSet]);
            populateDropdown('filterSemester', [...semesterSet]);
        }

        document.addEventListener('DOMContentLoaded', populateFilters);

        // Apply filters and update the chart
        document.getElementById('applyFilterBtn').addEventListener('click', function() {
            // Get selected filter values
            const tahunAjaranStart = parseInt(document.getElementById('filterTahunAjaranStart').value, 10);
            const tahunAjaranEnd = parseInt(document.getElementById('filterTahunAjaranEnd').value, 10);
            const kelas = document.getElementById('filterKelas').value;
            const semester = document.getElementById('filterSemester').value;

            // Extract table data
            const tableRows = document.querySelectorAll('#dataTable tbody tr');
            const chartData = {
                labels: [],
                datasets: [{
                    label: 'Average Total Scores',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            // Filter table data based on selected filters
            tableRows.forEach(row => {
                const tahunAjaran = parseInt(row.cells[0].textContent.trim(), 10);
                const rowData = {
                    tahunAjaran: tahunAjaran,
                    kelas: row.cells[1].textContent.trim(),
                    semester: row.cells[2].textContent.trim(),
                    average: parseFloat(row.cells[24].textContent.trim()) // Rerata Total
                };

                const isMatch = (isNaN(tahunAjaranStart) || tahunAjaran >= tahunAjaranStart) &&
                                (isNaN(tahunAjaranEnd) || tahunAjaran <= tahunAjaranEnd) &&
                                (kelas === 'all' || rowData.kelas === kelas) &&
                                (semester === 'all' || rowData.semester === semester);

                if (isMatch) {
                    chartData.labels.push(`${rowData.tahunAjaran} - ${rowData.kelas} - ${rowData.semester}`);
                    chartData.datasets[0].data.push(rowData.average);
                }
            });

            // Update the chart with the filtered data
            averageChart = updateChart(averageChart, chartData);
            document.getElementById('modalAverageChart').style.display = 'block';
        });

        // Reset filters and hide the chart when the modal is closed
        document.getElementById('chartModal').addEventListener('hidden.bs.modal', function() {
            // Reset filter inputs
            document.getElementById('filterTahunAjaranStart').value = 'all';
            document.getElementById('filterTahunAjaranEnd').value = 'all';
            document.getElementById('filterKelas').value = 'all';
            document.getElementById('filterSemester').value = 'all';

            // Clear and hide the chart
            const chartCanvas = document.getElementById('modalAverageChart');
            chartCanvas.style.display = 'none';

            // Destroy the chart instance
            if (averageChart) {
                averageChart.destroy();
                averageChart = null;
            }
        });
</script>
