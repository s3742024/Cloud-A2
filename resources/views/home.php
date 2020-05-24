<?php

// Disclaimer: This is an university assignment application that 
//             is developed based on the booktshelf tutorial provided by google cloud. 

ob_start() ?>


<br>
<br>
<div class="container">

  <nav>
    <div class="nav nav-tabs" id="home_tab" role="tablist">
      <a class="nav-item nav-link active text-dark" id="receipt_list_tab" data-toggle="tab" href="#receipt_list" role="tab" aria-controls="receipt_list" aria-selected="">Receipts</a>
      <a class="nav-item nav-link text-dark" id="accountant_tab" data-toggle="tab" href="#accountant" role="tab" aria-controls="accountant" aria-selected="">Accountant</a>
      <a class="nav-item nav-link text-dark" id="ato_tab" data-toggle="tab" href="#ato" role="tab" aria-controls="ato" aria-selected="">ATO</a>
    </div>
  </nav>

  <div class="tab-content" id="receipt_list_content">

    <div class="tab-pane fade show active py-4" id="receipt_list" role="tabpanel" aria-labelledby="receipt_list_tab">
      <h3 class="text-center">Receipt List</h3>

      <div class="row">
        <div class="col-4">
          <a href="/receipts/add" class="btn btn-lg">
            <svg class="bi bi-plus-square" width="1.1em" height="1.1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd" />
            </svg>
          </a>
        </div>
        <div class="col-8">
          <p class="text-right">
            <a href="/receipts/summary" class="btn btn-lg">
              <svg class="bi bi-graph-up" width="1.1em" height="1.1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z" />
                <path fill-rule="evenodd" d="M14.39 4.312L10.041 9.75 7 6.707l-3.646 3.647-.708-.708L7 5.293 9.959 8.25l3.65-4.563.781.624z" clip-rule="evenodd" />
                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 01.5-.5h4a.5.5 0 01.5.5v4a.5.5 0 01-1 0V4h-3.5a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
              </svg>
            </a>
          </p>
        </div>
       </div>

      <div class="container table-responsive">
        <table class="table table-hover">

          <thead>
            <tr>
              <th>Deduction Category</th>
              <th>Business Name</th>
              <th>Product/Service</th>
              <th>Purchased Date</th>
              <th>Receipt Type</th>
              <th>Expense</th>
              <th>Edit</th>
              <th>Bin</th>
            </tr>
          </thead>

          <?php foreach ($receipts as $i => $receipt) : ?>
            <div class="media">
              <div class="media-body">

                <tbody>
                  <tr>
                    <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('deduction_category') ?></a></td>
                    <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('business_name') ?></a></td>
                    <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('product_service') ?></a></td>
                    <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('purchased_date') ?></a></td>
                    <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('receipt_type') ?></a></td>
                    <td><a href="/receipts/<?= $receipt->id() ?>"> <?= $receipt->get('expense') ?></a></td>

                    <td>
                      <a href="/receipts/<?= $receipt->id() ?>/edit">
                        <svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd" />
                        </svg>
                      </a>
                    </td>

                    <td>
                      <form method="post" action="/receipts/<?= $receipt->id() ?>/delete" id="deleteForm">
                        <button id="submit" type="submit" class=" btn-link">
                          <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd" />
                          </svg>
                        </button>
                      </form>
                    </td>

                  </tr>
                </tbody>
              </div>
            </div>
          <?php endforeach ?>

          <?php if (!isset($receipt)) : ?>
            <p class="text-center text-danger">Opps~ there is no receipt at the moment</p>
          <?php elseif ($i + 1 == $pageSize) : ?>
            <nav>
              <ul class="pager">
                <li><a href="?page_token=<?= $receipt->id() ?>">More</a></li>
              </ul>
            </nav>
          <?php endif ?>
        </table>
      </div>
    </div>

    <br>

    <div class="tab-pane fade py-4" id="accountant" role="tabpanel" aria-labelledby="accountant_tab">
      <div class="container">

        <br>
        <p><b>Company</b>: Marc Gilbert & Associates</p>
        <p><b>Accountant</b>: Marc Gilbert</p>
        <p><b>Phone</b>: (03) 9776 5100</p>
        <p><b>Address</b>: <a href="https://www.google.com/maps/place/Accountant,+219+Beach+St,+Frankston+VIC+3199/@-38.1474951,145.14273,17z/data=!3m1!4b1!4m5!3m4!1s0x6ad60b2ef126d255:0xa96c4957acaf7480!8m2!3d-38.1474951!4d145.1449187" target="_blank"> 219 Beach St, Frankston VIC 3199 Australia.</a></p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3137.6859403647404!2d145.14273001532837!3d-38.14749507969337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad60b2ef126d255%3A0xa96c4957acaf7480!2sAccountant%2C%20219%20Beach%20St%2C%20Frankston%20VIC%203199!5e0!3m2!1sen!2sau!4v1589989188267!5m2!1sen!2sau" width="100%"  height="580" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>      </div>
    

    
    </div>

    <br>

    <div class="tab-pane fade py-4" id="ato" role="tabpanel" aria-labelledby="ato_tab">
      <div class="container">

        <p><b>Self-help</b>: +61 13 28 65</p>
        <p><b>Customer Service</b>: +61 13 28 61</p>
        <p><b>Website</b>: <a href="https://www.ato.gov.au/">https://www.ato.gov.au/</a></p>
        <p><b>Tax Return Instructions</b>: <a  href="https://www.ato.gov.au/uploadedFiles/Content/IND/downloads/Individual-tax-return-instructions-2019.pdf">check here</a></p>   
        <br>
        
        <embed src="https://www.ato.gov.au/uploadedFiles/Content/IND/downloads/Individual-tax-return-instructions-2019.pdf" type="application/pdf" width="100%" height="580">
     </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

  </div>

    <br>
    <br>

  <?= view('header', ['content' => ob_get_clean()]) ?>