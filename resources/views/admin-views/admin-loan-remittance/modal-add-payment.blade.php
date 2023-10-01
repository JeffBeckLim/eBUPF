<div class="modal fade" id="addPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold fs-5" id="exampleModalLabel" style="color: #0D3546;">Confirm Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mx-5 my-3">
                <div class="row fs-6">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="loan_id_modal" class="fw-bold text-danger">Loan ID : </label>
                          </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <span id="loan_id_modal" class="text-danger fw-bold"></span>
                          </div>
                    </div>
                </div>
                <div class="row fs-6 mt-1">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="or_number_modal" class="fw-bold">OR Number : </label>
                          </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <span id="or_number_modal" class=""></span>
                          </div>
                    </div>
                </div>
                <div class="row fs-6 mt-1">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="payment_date_modal" class="fw-bold">Date : </label>
                          </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <span id="payment_date_modal" class=""></span>
                          </div>
                    </div>
                </div>

                <div class="mt-3 bg-white rounded-3 border bg-white px-2 shadow-sm" style="padding: 10px 0 10px 20px;">
                    <div class="fs-6 fw-bold  text-center" style="color: #07212b;">
                        Monthly Amortization
                    </div>
                    <div class="row fs-6 mt-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="principal_modal" class="fw-bold">Principal : </label>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                ₱<span id="principal_modal" class=""></span>
                              </div>
                        </div>
                    </div>
                    <div class="row fs-6 mt-1">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="interest_modal" class="fw-bold">Interest : </label>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                ₱<span id="interest_modal" class=""></span>
                              </div>
                        </div>
                    </div>
                </div>

            </div>



          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn bu-orange text-light">Confirm</button>
      </div>
    </div>
  </div>
</div>
