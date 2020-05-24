<?php

// Disclaimer: This is an university assignment application that 
//             is developed based on the booktshelf tutorial provided by google cloud. 

ob_start() ?>


<br>
<br>
<h3 class="text-center"><?= $action ?> Receipt</h3>
<br>
  <p class="text-center">Note: D1-D5 are all work-related expenses</p>

<form method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="deduction_category">Deduction Category</label>
    <select class="form-control" id="deduction_category" name="deduction_category" required>
      <option value="D1 Car Expenses" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D1 Car Expenses</option>
      <option value="D2 Travel Expenses" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D2 Travel Expenses</option>
      <option value="D3 Clothing & Laundry Expenses" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D3 Clothing & Laundry Expenses</option>
      <option value="D4 Self-education Expenses" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D4 Self-education Expenses</option>
      <option value="D5 Other Work-related Expenses" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D5 Other Work-related Expenses</option>
      <option value="D6 Low-value Pool Deduction" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D6 Low-value Pool Deduction</option>
      <option value="D7 Interest Deductions" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D7 Interest Deductions</option>
      <option value="D8 Dividend Deductions" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D8 Dividend Deductions</option>
      <option value="D9 Gifts or Donations" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D9 Gifts or Donations</option>
      <option value="D10 Tax Affair Managing Cost" <?php echo $receipt ? ($receipt->get('deduction_category') == '' ? 'selected' : '') : '' ?>>D10 Tax Affair Managing Cost</option>
    </select>
  </div>

  <div class="form-group">
    <label for="business_name">Business Name</label>
    <input type="text" name="business_name" id="business_name" value="<?= $receipt ? $receipt->get('business_name') : '' ?>" class="form-control" />
  </div>

  <div class="form-group">
    <label for="product_service">Product/Service</label>
    <input type="text" name="product_service" id="product_service" value="<?= $receipt ? $receipt->get('product_service') : '' ?>" class="form-control" />
  </div>

  <div class="form-group">
    <label for="purchased_date">Purchased Date</label>
    <input type="date" name="purchased_date" id="purchased_date" value="<?= $receipt ? $receipt->get('purchased_date') : '' ?>" class="form-control" required />
  </div>

  <div class="form-group">
    <label for="receipt_type">Receipt Type</label>
    <select class="form-control" id="receipt_type" name="receipt_type" required>
      <option value="Paper" <?php echo $receipt ? ($receipt->get('receipt_type') == 'Paper' ? 'selected' : '') : '' ?>>Paper</option>
      <option value="Electronic" <?php echo $receipt ? ($receipt->get('receipt_type') == 'Electronic' ? 'selected' : '') : '' ?>>Electronic</option>
      <option value="None" <?php echo $receipt ? ($receipt->get('receipt_type') == 'None' ? 'selected' : '') : '' ?>>None</option>
    </select>
  </div>

  <div class="form-group">
    <label for="expense">Expense</label>
    <input type="number" name="expense" id="expense" value="<?= $receipt ? $receipt->get('expense') : '' ?>" class="form-control" required />
  </div>

  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" id="image" class="form-control" />
  </div>

  <div class="form-group hidden">
    <label for="image_url">Image URL</label>
    <input type="url" name="image_url" id="image_url" value="<?= $receipt ? $receipt->get('image_url') : '' ?>" class="form-control" />
  </div>

  <button id="submit" type="submit" class="btn btn-success btn-block">Save</button>
</form>

<br>
<br>

<?= view('header', ['content' => ob_get_clean()]) ?>