<div class="card border-0 p-5">
    <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
        <h4 class="mb-0">Transaction Record</h4>
    </div>
    <div class="card-body p-0">
        <div class="table table-flex">
            <div class="thead fw-bold border-bottom border-1 border-light-200">
                <div class="row px-2">
                    <div class="col text-center">#</div>
                    <div class="col text-center">Date</div>
                    <div class="col text-center">Customer Name</div>
                    <div class="col text-center">Type</div>
                    <div class="col text-center">Tag</div>
                    <div class="col text-center">Amount</div>
                    <div class="col text-center">Balance</div>
                </div>
            </div>
            <div class="tbody">
                @if(!$transaction->isEmpty())
                    @foreach($transaction as $key=>$transaction)
                        <div class="row px-2 border-bottom border-1 border-light-200">
                            <div class="col text-center">{{ $key+1}}</div>
                            <div class="col text-center">{{ date('d M Y',strtotime($transaction->transaction_date))}}</div>
                            <div class="col text-center">{{ $transaction->user->email}}</div>
                            <div class="col text-center">{!! ($transaction->transaction_type == 'debit') ? '<h6 class="fw-semibold text-red mb-0"><span class="indicator bg-danger"></span> DEBIT</h6>': '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> CREDIT</h6>' !!}</div>
                            <div class="col text-center">{!! strtoupper($transaction->transaction_tag) !!}</div>
                            <div class="col text-center">INR {!! number_format($transaction->amount,2) !!}</div>
                            <div class="col text-center">INR {!! number_format($transaction->balance,2) !!}</div>
                        </div>
                    @endforeach
                @else
                    <div class="row" style="margin-left: 100px;">
                        No Transaction Recorded Yet !!!!!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
