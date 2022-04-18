<div class="modal fade" id="exampleModal{{$feeInvoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('feesInvoices.destroy',$feeInvoice->id)}}" method="POST">
        {{ method_field('Delete') }}
        @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>{{__('Warning')}}:{{__('Are you sure you want to delete the invoice?')}}</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>

                        <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                    </div>
                </div>
            </div>
    </form>
</div>
