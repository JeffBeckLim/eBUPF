<div class="modal fade" id="categoryModal{{$loan->loan->id}}" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="categoryModalLabel">Categorize Loan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('create.category',$loan->loan->id)}}" method="POST">
            @csrf
            <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="is_active1" value=""{{$loan->loan->loan_category_id == '' ? 'checked' : ''}}>
                <label class="form-check-label" for="is_active1" >
                    None
                </label>
              </div>
            @foreach ($loan_categories as $category)
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="is_active1" value="{{$category->id}}"{{$loan->loan->loan_category_id == $category->id ? 'checked' : ''}}>
                <label class="form-check-label" for="is_active1" >
                  {{$category->loan_category_name}}
                </label>
              </div>
            @endforeach

             
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bu-orange text-light">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>