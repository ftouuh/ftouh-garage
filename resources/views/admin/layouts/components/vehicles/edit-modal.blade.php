@if(isset($vehicle))

<div class="modal fade" id="editVehicleModal" tabindex="-1" role="dialog" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editVehicleModalLabel" style="color:white;">@lang('Edit Vehicle')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}" style="filter: invert(1);"></button>
        </div>
        <div class="modal-body">
         
          <form id="editVehicleForm" method="put" action="{{ route('admin.updateVehicle',$vehicle->id ) }}" enctype="multipart/form-data">
              @csrf
              @method('put')
              
              <div class="mb-3">
                <label for="vehicleMake">@lang('Make')</label>
                <input type="text" class="form-control" id="vehicleMake" name="make" required>
              </div>
              <div class="mb-3">
                <label for="vehicleModel">@lang('Model')</label>
                <input type="text" class="form-control" id="vehicleModel" name="model" required>
              </div>
              <div class="mb-3">
                <label for="vehicleFuelType">@lang('Fuel Type')</label>
                <input type="text" class="form-control" id="vehicleFuelType" name="fuelType" required>
              </div>
              <div class="mb-3">
                <label for="vehicleRegistration">@lang('Registration')</label>
                <input type="text" class="form-control" id="vehicleRegistration" name="registration" >
              </div>
              
              </div>
              @if (Auth::user()->role === "client")
                <div class="mb-3">
                  <input type="text" class="form-control" id="vehicleUserId" value="{{Auth::user()->id}}" name="user_id" hidden >
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="vehicleId" name="id" hidden>
                </div>
              @else
                <div class="mb-3">
                  <input type="text" class="form-control" id="vehicleUserId" name="user_id" hidden>
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="vehicleId" name="id" hidden>
                </div>
              @endif

              

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>

              </div>
            </form>
        
        </div>
      </div>
    </div>
  </div>
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
    $(document).ready(function() {
        console.log("Document vehicle ready");

        // Show modal and populate fields when the edit button is clicked
        $(document).on('click', '.edit-vehicle', function() {
            var vehicleMake = $(this).data('vehicle-make');
            var vehicleModel = $(this).data('vehicle-model');
            var vehicleFuelType = $(this).data('vehicle-fueltype');
            var vehicleRegistration = $(this).data('vehicle-registration');
            var vehiclePhotos = $(this).data('vehicle-photos');
            var vehicleUserId = $(this).data('vehicle-userid');
            var vehicleId = $(this).data('vehicles-id');

            // Populate modal fields with vehicle data
            $('#vehicleMake').val(vehicleMake);
            $('#vehicleModel').val(vehicleModel);
            $('#vehicleFuelType').val(vehicleFuelType);
            $('#vehicleRegistration').val(vehicleRegistration);
            $('#vehiclePhotos').val(vehiclePhotos);
            $('#vehicleUserId').val(vehicleUserId);
            $('#vehicleId').val(vehicleId);
            // Show the modal
            $('#editVehicleModal').modal('show');
        });

        // Handle form submission via AJAX using Axios
        // Handle form submission via AJAX using Axios
        $('#editVehicleForm').submit(function(event) {
            event.preventDefault();
            console.log("Submit button clicked");

            // Fetch the vehicleId from the hidden input field
            var vehicleId = $('#vehicleId').val(); // Assuming you have an input field with id="vehicleId" containing the vehicle ID

            var formData = new FormData($('#editVehicleForm')[0]);

            var vehiclePhotos = $('#photos')[0].files; // Make sure this matches the ID of your file input field
            for (var i = 0; i < vehiclePhotos.length; i++) {
                formData.append('photos', vehiclePhotos[i]);
            }

            console.log(formData);
            axios.post('/vehicles/' + vehicleId, formData);
            location.reload();
        });


    });
</script>
@endif
