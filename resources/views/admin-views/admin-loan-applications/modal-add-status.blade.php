<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h1 class=" fw-bold fs-5">Add Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row g-0 mx-3">
        <div class="col-12" >
          Loan ID
          <h4 style="color: #0092D1;" class="fw-bold">10</h4>
        </div>
        <div class="col-12">
          <div class="row  g-0">
            <div class="col-6">
              <h6 class="fw-bold">Juan Dela Cruz Jr.</h6>
              BUCS <br>
              04-23-2023
            </div>
            <div class="col-6 ">
              Php 200,000.00
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form action="">
          <div class="mb-3">
            <label for="statusDropdown" class="col-form-label">Select Satatus</label>
            <select id="statusDropdown" class="form-select form-control">
              <option value="" disabled selected>Status</option>
              <option value="Staff">Staff</option>
              <option value="LoanAnalyst">Loan Analyst</option>
              <option value="ExeDirector">Executive Director</option>
              <option value="Check">Check</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="recipient-name" class="col-form-label">Date</label>
            <input type="date" class="form-control" id="recipient-name">
          </div>
          
          <div class="mb-2">
            <label for="message-text" class="col-form-label">Remarks</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bu-orange text-light">Add Status</button>
      </div>
    </div>
  </div>
</div>