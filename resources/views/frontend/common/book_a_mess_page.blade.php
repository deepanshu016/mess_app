<form action="{{ route('book.a.mess',['mess_id'=>$messDetail->id]) }}" method="POST" class="book_a_mess_final">
    @csrf
    <div class="form-group">
        <label>Mess Name</label>
        <span>{{ $messDetail->mess_name}}</span>
        <input type="hidden" name="mess_id" value="{{ $messDetail->id}}">
    </div>
    <div class="form-group">
        <label>Choose Menu</label>
        <input type="checkbox" name="breakfast" value="breakfast" class="check_checkbox" checked> Breakfast
        <input type="checkbox" name="lunch" value="lunch" class="check_checkbox" checked> Lunch
        <input type="checkbox" name="dinner" value="dinner" class="check_checkbox" checked> Dinner
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Book</button>
    </div>
</form>
