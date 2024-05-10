<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteForm" method="post">
                    @csrf
                    <input type="hidden" id="deleteAppointmentId" name="deleteId" value="" />
                </form>
                Are you sure you want to delete appointment with ID: <span id="appointmentIdPlaceholder"></span> ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger confirmDeleteBtnApp" id="confirmDeleteBtnApp">Delete</button>
            </div>
        </div>
    </div>
</div>