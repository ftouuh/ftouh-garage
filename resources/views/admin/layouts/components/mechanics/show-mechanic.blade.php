<div class="modal fade" id="mechanicInfoModal" tabindex="-1" aria-labelledby="mechanicInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mechanicInfoModalLabel" style="color:white;">{{ __('Mechanic Information') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="mechanicInfoName" class="form-label">{{ __('Name:') }}</label>
                        <input type="text" class="form-control" id="mechanicInfoName" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="mechanicInfoRole" class="form-label">{{ __('Role:') }}</label>
                        <input type="text" class="form-control" id="mechanicInfoRole" readonly>
                    </div>
                </div>

                <hr>
                <h5>{{ __('Assigned Repairs') }}</h5>
                <div id="assignedRepairs" class="mt-3">
                </div>

                <hr>
                <h5>{{ __('Tasks and Responsibilities') }}</h5>
                <div id="tasksResponsibilities" class="mt-3">
                </div>

                <hr>
                <h5>{{ __('Spare Parts Usage') }}</h5>
                <div id="sparePartsUsage" class="mt-3">
                </div>

                <hr>
                <h5>{{ __('Performance Metrics') }}</h5>
                <div id="performanceMetrics" class="mt-3">
                </div>

                <hr>
                <h5>{{ __('Additional Features') }}</h5>
                <div id="additionalFeatures" class="mt-3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>