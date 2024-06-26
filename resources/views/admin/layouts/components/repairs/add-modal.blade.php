<div class="modal fade" id="addRepairModal" tabindex="-1" aria-labelledby="addRepairModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRepairModalLabel" style="color:white;">{{ __('Add New Repair') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <form id="addRepairForm" method="post" action="{{ route('admin.storeRepair') }}">
                    @csrf
                    <input type="hidden" name="mechanic_id" id="mechanic_id_hidden">
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">{{ __('Start Date') }}</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">{{ __('End Date (Optional)') }}</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                    <div class="mb-3">
                        <label for="mechanicNotes" class="form-label">{{ __('Mechanic Notes (Optional)') }}</label>
                        <textarea class="form-control" id="mechanicNotes" name="mechanicNotes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="clientNotes" class="form-label">{{ __('Client Notes') }}</label>
                        <textarea class="form-control" id="clientNotes" name="clientNotes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="test_id" value="{{Auth::user()->id}}" name="user_id" hidden>
                        <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="mechanic_id" class="form-label">{{ __('Mechanic (Optional)') }}</label>
                        <select class="form-select" id="mechanic_id" name="mechanic_id">
                            <option value="">{{ __('-- Select Mechanic --') }}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn submitRepair btn-primary">{{ __('Add Repair') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
$(document).ready(function() {
    console.log("Document ready");

    $('.add-repair').click(function() {
        $('#addRepairModal').modal('show');
        var userId = $(this).data('vehicle-iduser');
        console.log(userId);
        $('#test_id').val(userId);
        var vehicleId = $(this).data('vehicle-id');
        $('#vehicle_id').val(vehicleId);
    });

    $('.submitRepair').submit(function(event) {
        event.preventDefault();
        console.log("Submit button clicked");
        var userId = $('#addRepairForm').data('test_id');
        var formData = $('#addRepairForm').serialize();
        var mechanicId = $('#mechanic_id').val();
        if (mechanicId && !formData.includes('mechanic_id=')) {
            formData += '&mechanic_id=' + mechanicId;
        }
        if (typeof userId !== 'undefined' && !formData.includes('user_id')) {
            formData += '&user_id=' + userId;
        }
        console.log(formData);
        alert(formData);
        axios.post('/repairs/store', formData)
            .then(function(response) {
                $('.toast-success .toast-message').text('@lang("Repair added successfully")');
                $('.toast-success').fadeIn().delay(3000).fadeOut();
            })
            .catch(function(error) {
                $('.toast-danger .toast-message').text(error);
                $('.toast-danger').fadeIn().delay(3000).fadeOut();
            });
    });

    $('#addRepairModal').on('shown.bs.modal', function() {
        $.ajax({
            url: "{{ route('admin.fetchMechanics') }}",
            dataType: 'json',
            success: function(data) {
                var mechanicSelect = $('#mechanic_id');
                mechanicSelect.empty();
                mechanicSelect.append($('<option>', { value: '' }).text('-- Select Mechanic --'));
                $.each(data.mechanics, function(index, mechanic) {
                    mechanicSelect.append($('<option>', { value: mechanic.id }).text(mechanic.name));
                });
            }
        });
    });
});
</script>
