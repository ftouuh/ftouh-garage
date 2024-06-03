
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- client --}}


{{-- import client  --}}




{{-- delete client  --}}
    


    <script>

    $(".selectLocale").on('change',function(){
        var locale = $(this).val();

        window.location.href = "/changeLocale/"+locale;
    })
    </script>

    <script>
        $(".btnCloseShow").on('click',function(){
            $("#myModalShowProduct").hide();
        })


    </script>

    

{{-- add Vehicles  --}}


{{-- Show pics vehicles --}}


{{-- edit vehicle  --}}







{{-- delete vehicle  --}}




{{-- add repairs --}}



{{-- // fetch mechanic --}}

    


{{-- delete repair  --}}


{{-- // update status  --}}





{{-- add Invoice  --}}

<script>
    $(document).ready(function() {
        console.log("Document ready");
        var repairInvoiceId;
        // alert("good")
        $('.add-invoice').click(function() {
            $('#addInvoiceModal').modal('show');
            var repairInvoiceId = $(this).data('repairinvoice-id');

            $('#invoicerepair_id').val(repairInvoiceId);

        });
        $('.submitInvoice').click(function() {
        console.log("Submit button clicked");
        var formData = $('#addInvoiceForm').serialize();
            console.log(formData)
        if (repairInvoiceId && !formData.includes('repair_id=')) {
            formData += '&repair_id=' + repairInvoiceId;
        }
        axios({
            method: 'post',
            url: '/invoices/generate',
            data: formData
        })
        .then(function(response) {
            $('.toast-success .toast-message').text('@lang("Invoice added successfully")');
                $('.toast-success').fadeIn().delay(3000).fadeOut();
            $('#addInvoiceModal').modal('hide');

        })
        .catch(function(error) {
            console.error(error);
        });
    });
    });


</script>



{{-- show Invoice --}}
<script>



    $(".show-invoice").on("click", function() {
        var myId = $(this).attr("data-invoice-id");
        var data = { 'id': myId };
        axios.post('/invoices/showModal', data)
            .then(response => {
                $("#invoiceInfoModal").modal('show');
                var invoice = response.data;
                // console.log(invoice.repair.mechanic.name)
                $("#additionalCharges").val(invoice.additionalCharges);
                $("#totalAmount").val(invoice.totalAmount);
                $("#description").val(invoice.repair.description);
                $("#user").val(invoice.repair.user.name);
                // $("#mechanic").val(invoice.repair.mechanic.name);
                $("#vehicleMake").val(invoice.repair.vehicle.make);
                $("#vehicleRegistration").val(invoice.repair.vehicle.registration);
                $("#startDate").val(invoice.repair.startDate);
                $("#endDate").val(invoice.repair.endDate);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>

{{-- delete invoice  --}}
<script>
    $(document).ready(function() {
    // Handle deletion of client
    $('.delete-invoice').click(function() {
        var invoiceId = $(this).data('invoice-id'); // Retrieve the client ID
        $('#deleteId').val(invoiceId); // Populate the deleteId input field with the client ID
        $('#clientIdPlaceholder').text(invoiceId); // Populate the client ID placeholder in the modal body
        $('#confirmDeleteModal').modal('show'); // Show the confirmation modal
    });

    // Handle confirmation of deletion
    $('#confirmDeleteBtn').click(function() {
        var formData = $('#deleteForm').serialize(); // Serialize form data
        // Axios DELETE request
        axios.post('{{ route("admin.destroyInvoice") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $('.toast-success .toast-message').text('@lang("invoice deleted successfully")');
                    $('.toast-success').fadeIn().delay(3000).fadeOut();
                    $("#row").remove(); // Remove the deleted client row from the table
                    $('#confirmDeleteModal').modal('hide')
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    // Detach event handler for delete button after confirmation modal is closed
    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        // $('#confirmDeleteBtn').off('click');
    });
    });
</script>

{{-- print / --}}

<script>
    $(".show-invoice").on("click", function() {
        var myId = $(this).attr("data-invoice-id");
        // alert("my id is "+myId)
        $('#inputInvoiceId').val(myId)
        var data = { 'id': myId };
        axios.post('/generate-pdf', data)
            .then(response => {
                // console.log(response)
            //    alert(response);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>





{{-- pirnt invoice --}}




{{-- add spare parts --}}
<script>
   $(document).ready(function() {
    $('.add-spare-part').click(function() {
        $('#addSparePartModal').modal('show');
        var repairId = $(this).data('repair-id');
        $('#sparePartRepairId').val(repairId);
    });

    $('.submitSparePart').click(function() {
        var formData = $('#addSparePartForm').serialize();
        // alert(formData)
        axios.post('/spare-parts/add', formData)
            .then(function(response) {
                $('.toast-success .toast-message').text('@lang("Spare Part added successfully")');
                $('.toast-success').fadeIn().delay(3000).fadeOut();
                $('#addSparePartModal').modal('hide');
                // Refresh or update spare parts list if needed
            })
            .catch(function(error) {
                console.error(error);
            });
    });
});
</script>   
{{-- delete the spare parts  --}}

<script>
    $(document).ready(function() {
        // Handle deletion of spare part
        $('.delete-spare').click(function() {
            var spareId = $(this).data('spare-id'); // Retrieve the spare part ID
            $('#sdeleteId').val(spareId); // Populate the deleteId input field with the spare part ID
            $('#sconfirmDeleteModal').modal('show'); // Show the confirmation modal
        });

        // Handle confirmation of deletion
        $('#sconfirmDeleteBtn').on('click',function() {
            var formData = $('#sdeleteForm').serialize(); // Serialize form data
            // Axios DELETE request
            axios.post('{{ route("admin.destroySparePart") }}', formData)
                .then(function (response) {
                    if (response.data == "ok") {
                        $('.toast-success .toast-message').text('@lang("Record deleted successfully")');
                        $('.toast-success').fadeIn().delay(3000).fadeOut();
                        $("#row").remove(); // Remove the deleted spare part row from the table
                        $('#sconfirmDeleteModal').modal('hide');
                    }
                })
                .catch(function (error) {
                    console.error("Error occurred:", error);
                    console.error("Response data:", error.response.data);
                });
        });

        // Detach event handler for delete button after confirmation modal is closed
        $('#confirmDeleteModal').on('hidden.bs.modal', function () {
            // $('#confirmDeleteBtn').off('click');
        });
    });
</script>

{{-- // compose email --}}

<script>
        $(document).ready(function() {
        $('.compose-email').click(function() {
            $('#composemodal').modal('show');
        });
    
        $('#sendEmailBtn').click(function() {
            var formData = $('#composeForm').serialize();
            console.log(formData);
            axios.post('/send-email', formData)
                .then(function(response) {
                    $('.toast-success .toast-message').text('@lang("Email sent successfully")');
                        $('.toast-success').fadeIn().delay(3000).fadeOut();
                    $('#composemodal').modal('hide');
                })
                .catch(function(error) {
                    console.error("error" + error);
                });
        });
    });
</script>  




{{-- add appointment --}}


<script>
    $(document).ready(function() {
        console.log("Document ready");
        // Show modal and populate fields when the edit button is clicked
        $('.add-appointment').click(function() {
            $('#addAppointmentModal').modal('show');
        });

        // Handle form submission via AJAX using Axios
        $('.submitAppointment').click(function(event) {
            event.preventDefault();
        // console.log("Submit button clicked");
        var formData = $('#addAppointmentForm').serialize();
            // alert(formData);
        // Axios request
        axios({
            method: 'post',
            url: '/appointments/',
            data: formData
        })
        .then(function(response) {
            $('.toast-success .toast-message').text('@lang("appointment added successfully")');
            $('.toast-success').fadeIn().delay(3000).fadeOut();
            $('#addAppointmentModal').modal('hide');

        })
        .catch(function(error) {
            // Log the error to the console
            console.error(error);

            // Display an error message to the user
            // alert("Error updating user. Please try again later.");
        });
    });
    });
</script>

{{-- // delete appointement --}}




<script>
    $(document).ready(function() {
    // Handle deletion of appointment
    $('.delete-appointment').click(function() {
        var appointmentId = $(this).data('appointment-id');
        $('#deleteAppointmentId').val(appointmentId);
        $('#confirmDeleteModal').modal('show');
    });

    // Handle confirmation of deletion
    $('.confirmDeleteBtnApp').click(function() {
        console.log("dood")
        var formData = $('#deleteForm').serialize(); // Serialize form data
        console.log(formData)
        axios.post('{{ route("destroy.appointments") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $('.toast-success .toast-message').text('@lang("appointment deleted successfully")');
                    $('.toast-success').fadeIn().delay(3000).fadeOut();

                    console.log("okkkk")
                    $("#row").remove(); // Remove the deleted appointment row from the table
                    $('#confirmDeleteModal').modal('hide');
                }
            })
            .catch(function (error) {
                console.error("Error occurred:", error);
                console.error("Response data:", error.response.data);
            });
    });

    // Detach event handler for delete button after confirmation modal is closed
    $('#confirmDeleteModal').on('hidden.bs.modal', function () {
        // $('#confirmDeleteBtn').off('click');
    });
});

</script>

<script>
    $(document).ready(function() {
    // Handle updating appointment status
    $('.update-appointment-status').change(function() {
        var appointmentId = $(this).data('appointment-id');
        var newStatus = $(this).val();

        // Send Axios request to update appointment status
        axios.post('{{ route("update.appointment.status") }}', {
            appointment_id: appointmentId,
            status: newStatus
        })
        .then(function(response) {
            $('.toast-success .toast-message').text('@lang("status updated successfully")');

                    $('.toast-success').fadeIn().delay(3000).fadeOut();

            console.log(response.data.message);
            // Optionally, update the UI to reflect the new status
        })
        .catch(function(error) {
            console.error("Error occurred:", error);
            console.error("Response data:", error.response.data);
            // Handle error response if needed
        });
    });
});

</script>



<script>
 axios.get('/api/notifications')
.then(response => {
    const notifications = response.data.notifications;
    // Get the notifications container
    const notificationsContainer = document.getElementById('notifications-container');

    // // Filter notifications related to completed repairs
    // const completedRepairNotifications = notifications.filter(notification => {
    //     return notification.message.includes('marked as completed');
    // });

    // Check if notifications exist
    if (notifications.length > 0) {
        // Iterate over filtered notifications array and create HTML elements
        notifications.forEach(notification => {
            
            // Create elements
            const notificationItem = document.createElement('a');
            notificationItem.setAttribute('href', '#');
            notificationItem.classList.add('text-reset', 'notification-item');

            const notificationContent = document.createElement('div');
            notificationContent.classList.add('d-flex');

            const avatarDiv = document.createElement('div');
            avatarDiv.classList.add('avatar-xs', 'me-3');

            const avatarTitle = document.createElement('span');
            avatarTitle.classList.add('avatar-title', 'bg-primary', 'rounded-circle', 'font-size-16');
            avatarTitle.innerHTML = '<i class="ri-settings-cart-line"></i>';

            const notificationDetails = document.createElement('div');
            notificationDetails.classList.add('flex-1');

            const notificationUserName = document.createElement('h6');
            notificationUserName.classList.add('mb-1');
            notificationUserName.textContent = notification.sender;

            const notificationMessage = document.createElement('p');
            notificationMessage.classList.add('mb-1');
            notificationMessage.textContent = notification.message;


                const notificationTime = document.createElement('p');
                notificationTime.classList.add('mb-0');

                // Parse the created_at timestamp
                const createdAt = new Date(notification.created_at);
                const month = createdAt.toLocaleString('default', { month: 'long' });
                const hour = createdAt.getHours();
                const minute = createdAt.getMinutes();

                // Set the content of the notification time element
                notificationTime.innerHTML = `<i class="mdi mdi-clock-outline"></i> ${month} ${hour}:${minute}`;
            // Append elements
            avatarDiv.appendChild(avatarTitle);
            notificationContent.appendChild(avatarDiv);
            notificationDetails.appendChild(notificationUserName);
            notificationDetails.appendChild(notificationMessage);
            notificationDetails.appendChild(notificationTime);
            notificationContent.appendChild(notificationDetails);
            notificationItem.appendChild(notificationContent);
            notificationsContainer.appendChild(notificationItem);
        });
        

    } else {
        // No notifications related to completed repairs found
        notificationsContainer.innerHTML = '<p>No notifications found</p>';
    }
})
.catch(error => {
    console.error('Error fetching notifications:', error);
});

</script>




<script>
    // JavaScript code to handle toast messages
    document.addEventListener('DOMContentLoaded', function () {
        // Find all toast elements
        var toasts = document.querySelectorAll('.toast');

        // Loop through each toast element
        toasts.forEach(function (toast) {
            // Add click event listener to close button
            var closeButton = toast.querySelector('.toast-close-button');
            closeButton.addEventListener('click', function () {
                // Hide the toast when close button is clicked
                toast.style.display = 'none';
            });

            // Set timeout to automatically hide the toast after a certain duration
            setTimeout(function () {
                toast.style.display = 'none';
            }, 5000); // Adjust the duration (in milliseconds) as needed
        });
    });
</script>

    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>


    <!-- apexcharts -->
    <!-- jquery.vectormap map -->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
