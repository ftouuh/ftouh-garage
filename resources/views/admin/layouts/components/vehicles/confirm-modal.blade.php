<div class="modal fade" id="vconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vconfirmDeleteModalLabel" style="color:white;">@lang('Confirm Delete')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <form id="vdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="vdeleteId" name="vdeleteId" value="" />
                </form>
                @lang('Are you sure you want to delete This Vehicle ? ') 
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Cancel')</button>
                <button type="button" class="btn btn-danger" id="vconfirmDeleteBtn">@lang('Delete')</button>
            </div>
        </div>
    </div>
</div>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
    $(document).ready(function() {
    // Handle deletion of client
    $('.delete-vehicle').click(function() {
        var vehicleId = $(this).data('vehicle-id'); // Retrieve the client ID
        $('#vdeleteId').val(vehicleId); // Populate the deleteId input field with the client ID
        $('#vclientIdPlaceholder').text(vehicleId); // Populate the client ID placeholder in the modal body
        $('#vconfirmDeleteModal').modal('show'); // Show the confirmation modal
    });

    // Handle confirmation of deletion
    $('#vconfirmDeleteBtn').on('click',function() {
        var formData = $('#vdeleteForm').serialize(); // Serialize form data
        // Axios DELETE request
        axios.post('{{ route("admin.destroyVehicle") }}', formData)
            .then(function (response) {
                if (response.data == "ok") {
                    $('.toast-success .toast-message').text('@lang("Vehicle deleted successfully")');
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