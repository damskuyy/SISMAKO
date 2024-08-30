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
            successModalElement,
            // Add all your modal elements here
            document.getElementById('modalUpdate1'),
            document.getElementById('modalUpdate2'),
            document.getElementById('modalUpdate3'),
            document.getElementById('modalUpdate4'),
            document.getElementById('modalUpdate5'),
            document.getElementById('modalUpdate6'),
            document.getElementById('modalView1'),
            document.getElementById('modalView2'),
            document.getElementById('modalView3'),
            document.getElementById('modalView4'),
            document.getElementById('modalView5'),
            document.getElementById('modalView6')
        ];
        modals.forEach(modal => {
            hideModal(modal);
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

        $(document).ready(function() {
        // Initialize input mask
        $("#time-input").inputmask("99:99");

        // Initialize DataTable (apply this to your table element if needed)
        // $('#your-table-id').DataTable();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var radioButtons = document.querySelectorAll('.radio-inbox');
        var submitButton = document.getElementById('submitButton');
        var btnView = document.getElementById('btnView');
        var submitTp = document.getElementById('tp');
        var submitJs = document.getElementById('js');



        function checkSelection() {
            var tpValue = submitTp.value;
            var jsValue = submitJs.value;
            var radioChecked = Array.from(radioButtons).some(function(radio) {
                return radio.checked;
            });

            submitButton.disabled = !(tpValue !== "" && jsValue !== "" && radioChecked);

            if (radioChecked && (document.getElementById('radioInbox1').checked || document.getElementById(
                    'radioInbox2').checked)) {
                submitJs.disabled = false;
            } else {
                submitJs.disabled = true;
            }
        }

        submitTp.addEventListener('change', checkSelection);
        submitJs.addEventListener('change', checkSelection);

        radioButtons.forEach(function(radioButton) {

            radioButton.addEventListener('change', function() {
                if (this.checked) {
                    // Ambil data-target-view dan data-target-report dari radio button yang dipilih
                    var dataTargetView = this.getAttribute('data-target-view');
                    var dataTargetReport = this.getAttribute('data-target-report');

                    // Set data-bs-target untuk btnView dan submitButton
                    btnView.setAttribute('data-bs-target', dataTargetView);
                    submitButton.setAttribute('data-bs-target', dataTargetReport);
                }
            });
        });
    });

    // suratlainnya
    function handleSelectChange(selectId, inputId) {
        const selectElement = document.getElementById(selectId);
        const inputElement = document.getElementById(inputId);

        selectElement.addEventListener('change', () => {
            inputElement.disabled = selectElement.value !== 'Lainnya';
            selectElement.disabled = selectElement.value === 'Lainnya';
        });
    }

    handleSelectChange('js-modal-1', 'lainnya-field-1');
    handleSelectChange('js-modal-2', 'lainnya-field-2');

    // datepicker
    document.addEventListener("DOMContentLoaded", function() {
        var datepickers = document.querySelectorAll('[id^="datepicker"]');
        datepickers.forEach(function(datepicker) {
            new Litepicker({
                element: datepicker,
                buttonText: {
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 6l6 6l-6 6" /></svg>`,
                },
            });
        });
    });

    // tp&js value set
    var mainTp = document.getElementById('tp');

    mainTp.addEventListener('change', function() {
        var modalTps = document.querySelectorAll('[id^="tp-modal-"]');
        modalTps.forEach(function(modalTp) {
            modalTp.value = mainTp.value;
        });
    });

    var mainJs = document.getElementById('js');

    mainJs.addEventListener('change', function() {
        var modalJs = document.querySelectorAll('[id^="js-modal-"]');
        modalJs.forEach(function(modalJs) {
            modalJs.value = mainJs.value;
        });
    });

    // modal radio set
    document.addEventListener('DOMContentLoaded', function() {
        function setupRadioButtons() {
            var radioButtons = document.querySelectorAll('.radio-inbox');
            var siswaInput = document.querySelector('input[name="siswa"]');
            var guruInput = document.querySelector('input[name="guru"]');

            radioButtons.forEach(function(radioButton) {
                radioButton.addEventListener('change', function() {
                    if (this.value === 'siswa' && this.checked) {
                        siswaInput.removeAttribute('disabled');
                        guruInput.setAttribute('disabled', 'true');
                    } else if (this.value === 'guru' && this.checked) {
                        guruInput.removeAttribute('disabled');
                        siswaInput.setAttribute('disabled', 'true');
                    }
                });
            });
        }

        // Panggil fungsi untuk pertama kali
        setupRadioButtons();

        // Jalankan script setelah modal ditampilkan
        var modal = document.getElementById('modalUpdate'); // Ganti dengan ID modal Anda
        if (modal) {
            modal.addEventListener('shown.bs.modal', function() {
                setupRadioButtons();
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const radioSiswa = document.querySelector('.radio-inbox7');
        const radioGuru = document.querySelector('.radio-inbox8');
        const inputSiswa = document.querySelector('input[name="siswa"]');
        const inputGuru = document.querySelector('input[name="guru"]');

        function toggleInputs() {
            if (radioSiswa.checked) {
                inputSiswa.disabled = false;
                inputGuru.disabled = true;
            } else if (radioGuru.checked) {
                inputSiswa.disabled = true;
                inputGuru.disabled = false;
            } else {
                inputSiswa.disabled = true;
                inputGuru.disabled = true;
            }
        }

        radioSiswa.addEventListener('change', toggleInputs);
        radioGuru.addEventListener('change', toggleInputs);

        // Run on page load
        toggleInputs();
    });


    $(function() {
        $("#datepicker-icon-1").datepicker({
            dateFormat: 'yy-mm-dd' // Format tanggal sesuai kebutuhan
        });
        $("#datepicker-icon-2").datepicker({
            dateFormat: 'yy-mm-dd' // Format tanggal sesuai kebutuhan
        });
    });

    // datepickerfilter
    // document.getElementById('pdfForm').addEventListener('submit', function() {
    //     document.getElementById('hiddenStartDate').value = document.getElementById('datepicker-icon-1').value;
    //     document.getElementById('hiddenEndDate').value = document.getElementById('datepicker-icon-2').value;
    // });

    document.getElementById('filterButton').addEventListener('click', function() {
        // Menyalin nilai dari input tanggal ke input tersembunyi
        document.getElementById('hiddenStartDate').value = document.getElementById('datepicker-icon-1').value;
        document.getElementById('hiddenEndDate').value = document.getElementById('datepicker-icon-2').value;
    });
</script>
