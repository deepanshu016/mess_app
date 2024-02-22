<div class="card border-0 p-5">
    <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
        <h4 class="mb-0">Attendance Record</h4>
    </div>
    <div class="card-body p-0">
        <div class="table table-flex">
            <div class="thead fw-bold border-bottom border-1 border-light-200">
                <div class="row px-2">
                    <div class="col">#</div>
                    <div class="col">Date</div>
                    <div class="col">Breakfast</div>
                    <div class="col">Lunch</div>
                    <div class="col">Dinner</div>
                    <div class="col">Amount Per Day</div>
                </div>
            </div>
            <div class="tbody">
                @if(!$attendance->isEmpty())
                    @php
                        $totalMonthPayment = 0;
                    @endphp
                    @foreach($attendance as $key=>$attendance)
                        <div class="row px-2 border-bottom border-1 border-light-200">
                            <div class="col">{{ $key+1}}</div>
                            <div class="col">{{ date('d M Y',strtotime($attendance->date))}}</div>
                            <div class="col">
                                {!! ($attendance->breakfast) ? '<i class="bi bi-check-lg text-success"></i>' : '<i class="bi bi-x-lg text-danger"></i>' !!}
                            </div>
                            <div class="col">
                                {!! ($attendance->lunch) ? '<i class="bi bi-check-lg text-success"></i>' : '<i class="bi bi-x-lg text-danger"></i>' !!}
                            </div>
                            <div class="col">
                                {!! ($attendance->dinner) ? '<i class="bi bi-check-lg text-success"></i>' : '<i class="bi bi-x-lg text-danger"></i>' !!}
                            </div>
                            <div class="col">
                                INR {!! getTotalPerDay($attendance->user_id,$attendance->mess_id,$attendance->id) !!}
                            </div>
                        </div>
                        @php
                            $totalMonthPayment += getTotalPerDay($attendance->user_id,$attendance->mess_id,$attendance->id);
                        @endphp
                    @endforeach
                    <div class="row px-2 border-bottom border-1 border-light-200">
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col fw-bold">Total Spend</div>
                        <div class="col fw-bold">
                            INR {!! $totalMonthPayment !!}
                        </div>
                    </div>
                @else
                    <div class="row" style="margin-left: 100px;">
                        No Attendance Recorded Yet !!!!!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
