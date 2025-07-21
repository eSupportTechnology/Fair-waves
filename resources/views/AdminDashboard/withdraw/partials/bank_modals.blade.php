@foreach ($withdrawals as $withdrawal)
        @if ($withdrawal->bankDetail)
            <!-- Bank Detail Modal -->
            <div class="modal fade" id="bankModal{{ $withdrawal->id }}" tabindex="-1"
                aria-labelledby="bankModalLabel{{ $withdrawal->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="bankModalLabel{{ $withdrawal->id }}">
                                Bank Details - {{ $withdrawal->dealer->name ?? 'N/A' }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="border rounded p-3 shadow-sm">
                                        <h6 class="fw-bold mb-2">Bank Info</h6>
                                        <p class="mb-1"><strong>Bank Name:</strong>
                                            {{ $withdrawal->bankDetail->bank_name }}</p>
                                        <p class="mb-1"><strong>Branch:</strong>
                                            {{ $withdrawal->bankDetail->bank_branch }}</p>
                                        <p class="mb-1"><strong>Account Name:</strong>
                                            {{ $withdrawal->bankDetail->account_name }}</p>
                                        <p class="mb-1"><strong>Account Number:</strong>
                                            {{ $withdrawal->bankDetail->account_number }}</p>
                                        {{-- <p class="mb-1"><strong>Account Type:</strong>
                                                        {{ $withdrawal->bankDetail->account_type }}</p> --}}
                                        <p class="mb-0"><strong>Status:</strong>
                                            <span
                                                class="badge
                                            @if ($withdrawal->bankDetail->bank_status == 'approved') bg-success
                                            @elseif($withdrawal->bankDetail->bank_status == 'rejected') bg-danger
                                            @else bg-warning text-dark @endif">
                                                {{ ucfirst($withdrawal->bankDetail->bank_status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 shadow-sm">
                                        <h6 class="fw-bold mb-3">Bank Card Images</h6>
                                        <div class="mb-3">
                                            <p class="mb-1"><strong>Front:</strong></p>
                                            @if ($withdrawal->bankDetail->bank_front_image)
                                                <img src="{{ asset('storage/' . $withdrawal->bankDetail->bank_front_image) }}"
                                                    class="img-fluid rounded shadow-sm border" alt="Front Image">
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </div>
                                        {{-- <div>
                                            <p class="mb-1"><strong>Back:</strong></p>
                                            @if ($withdrawal->bankDetail->bank_back_image)
                                                <img src="{{ asset('storage/' . $withdrawal->bankDetail->bank_back_image) }}"
                                                    class="img-fluid rounded shadow-sm border" alt="Back Image">
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- modal-body -->
                    </div>
                </div>
            </div>
        @endif
    @endforeach
