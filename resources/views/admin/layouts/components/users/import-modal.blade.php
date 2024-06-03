

<div class="modal fade" id="importUsersModal" tabindex="-1" aria-labelledby="importUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importUsersModalLabel" style="color:white;">{{ __('Import Users') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <form id="importUsersForm" method="post" action="{{ route('import.users') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">{{ __('Select Excel File') }}</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
                        <div class="form-text" style="color:white;">
                            {{ __('Supported file formats: .xlsx, .xls (older Excel versions)') }}
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Import Users') }}</button>
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
        console.log("Document ready");
        $('.import-clients').click(function() {
            $('#importUsersModal').modal('show');
        });

    });



</script>