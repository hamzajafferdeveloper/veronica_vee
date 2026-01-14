<!-- Request Project Modal -->
<div class="modal fade" id="requestProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-send-fill text-primary me-1"></i>
                    {{ __('buttons.request_project') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="projectRequestForm">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            {{ __('ui.note_to_recruiter') }} <span class="text-muted">{{ __('ui.optional') }}</span>
                        </label>
                        <textarea name="note" class="form-control resize-none" rows="4" dir="rtl"
                            placeholder="{{ __('ui.note_placeholder') }}"></textarea>
                    </div>

                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                        {{ __('buttons.cancel') }}
                    </button>

                    <button type="submit" class="btn btn-primary rounded-pill px-3">
                        <i class="bi bi-send-check me-1"></i>
                        {{ __('buttons.send_request') }}
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
