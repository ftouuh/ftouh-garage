<div class="modal fade" id="addInvoiceModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel" style="color:white;">{{ __('Add Invoice') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <form id="addInvoiceForm" method="POST" >
                    {{-- action="{{route('admin.generateInvoice')}}" --}}
                    @csrf
                    <div class="mb-3">
                        <label for="additionalCharges" class="form-label">{{ __('Additional Charges') }}</label>
                        <input type="number" class="form-control" id="additionalCharges" name="additionalCharges">
                    </div>
                    <div class="mb-3">
                        <input type="number" disabled class="form-control" id="totalAmount" name="totalAmount" hidden>
                    </div>
                    
                        <input type="hidden" class="form-control" id="invoicerepair_id" name="repair_id" >
                  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn submitInvoice btn-primary" id="submitInvoice">{{ __('Add Invoice') }}</button>
            </div>
        </div>
    </div>
</div>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>