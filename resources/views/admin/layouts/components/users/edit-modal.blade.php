@if(isset($client))
<div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClientModalLabel" style="color:white;">{{ __('Edit User') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <form id="editClientForm" method="post" action="{{ route('admin.update', $client->id) }}">
                    @csrf
                    @method('put')
                    <!-- Hidden input field to store client ID -->
                    <input type="hidden" id="editClientId" name="client_id" value="{{ $client->id }}">
                    <!-- Form fields -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <textarea class="form-control" id="address" name="address">{{ $client->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label" >{{ __('Phone Number') }}</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $client->phoneNumber }}">
                    </div>
                    <!-- Other form fields here -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
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
        $('.edit-client').click(function() {
            var clientId = $(this).data('client-id');
            var clientName = $(this).data('client-name');
            var clientEmail = $(this).data('client-email');
            var clientAddress = $(this).data('client-address');
            var clientPhone = $(this).data('client-phone');
            console.log(clientId);

            // Populate modal fields with client data
            $('#editClientId').val(clientId);
            $('#name').val(clientName);
            $('#email').val(clientEmail);
            $('#address').val(clientAddress);
            $('#phoneNumber').val(clientPhone);

            // Show the modal
            $('#editClientModal').modal('show');
        });
        $('#editClientForm').submit(function(event) {
            event.preventDefault();

        var clientId = $('#editClientId').val();
            var formData = $(this).serialize();

            axios({
                method: 'post',
                url: '/users/' + clientId,
                data: formData
            })
        });
    });
</script>


@endif
