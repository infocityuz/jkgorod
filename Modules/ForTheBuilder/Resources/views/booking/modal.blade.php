<div class="modal fade" id="modal-default-extend">
    <div class="modal-dialog" style="max-width: 700px">
        <div class="modal-content" style="padding: 0 24px">
            <div class="modal-header">
                <h4 class="modal-title color-green"><b>{{ __('locale.extend_booking') }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" id="booking-close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" method="POST" action="{{ route('forthebuilder.booking.extendBooking') }}">
                @csrf
                <input type="hidden" id="booking_add_id" name="booking_id">
                <button class="btn btn-success" type="submit">{{ __('locale.Add 5 days to the advance') }}</button>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-default-finish">
    <div class="modal-dialog" style="max-width: 700px">
        <div class="modal-content" style="padding: 0 24px">
            <div class="modal-header">
                <h4 class="modal-title color-yellow"><b>{{ __('locale.Finish_booking') }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" id="booking-close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" method="POST" action="{{ route('forthebuilder.booking.finishBooking') }}">
                @csrf
                <input type="hidden" id="booking_finish_id" name="booking_id">
                <button class="btn btn-danger" type="submit">{{ __('locale.Finish advance') }}</button>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>