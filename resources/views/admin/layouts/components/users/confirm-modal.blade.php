<div class="modal fade" id="cconfirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cconfirmDeleteModalLabel" style="color:white;">{{ __('Confirm Delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body" style="color:white;">
                <form id="cdeleteForm" method="post">
                    @csrf
                    <input type="hidden" id="cdeleteId" name="cdeleteId" value="" />
                </form>
                {{ __('Do You Really Want To Delete This User') }}  ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="cconfirmDeleteBtn">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
        $('.delete-client').click(function() {
            var clientId = $(this).data('client-id');
            $('#cdeleteId').val(clientId); 
            $('#clientIdPlaceholder').text(clientId); 
            $('#cconfirmDeleteModal').modal('show'); 
        });

        $('#cconfirmDeleteBtn').on('click',function() {
            var formData = $('#cdeleteForm').serialize();
            axios.post('{{ route("admin.destroy") }}', formData)
                .then(function (response) {
                        if (response.data == "ok") {

                            $("#row").remove(); 
                            $('#cconfirmDeleteModal').modal('hide')
                        }
                })
                .catch(function (error) {
                    console.log(error)
                });
        });
        });
    </script>