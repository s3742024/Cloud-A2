<?php

// Disclaimer: This is an university assignment application that 
//             is developed based on the booktshelf tutorial provided by google cloud. 

ob_start() ?>


<br>
<br>
<h3 class="text-center">Summary Report</h3>
<br>
<br>

<div style="margin-bottom:30px">
  <form class="form-inline">
    <b class="ml-2 pl-4"> Select Time </b>
    <label class="ml-5 mr-2" for="email">From</label>
    <input type="date" class="form-control ml-" id="start_time" placeholder="Enter ..." value="<?= $query['start_time'] ?>">
    <label class="ml-3 mr-3" for="pwd">To:</label>
    <input type="date" class="form-control ml-" id="end_time" placeholder="Enter ..." value="<?= $query['end_time'] ?>">
    <button type="submit" class="btn btn-sm btn-outline-success ml-5">Submit</button>
  </form>
</div>

<br>

<div class="container">
  <table class="table table-hover table-bordered">

    <thead>
      <tr>
        <th>Deduction Category</th>
        <th>Expense</th>
      </tr>
    </thead>

    <?php $len = count($list);
    $total = 0;
    foreach ($list as $i => $val) : ?>
      <?php $total += $val['value']; ?>

      <tbody>
        <tr>
          <td><?= $val['name'] ?></td>
          <td><label class=""> $ </label><?= $val['value'] ?></td>
        </tr>
        <?php if ($i == $len - 1) { ?>
          <tr>
            <td><b><label>Total: </label></b></td>
            <td><b><label> $ </label><?= $total ?></b></td>
          </tr>
        <?php } ?>
      </tbody>

    <?php endforeach ?>

  </table>
</div>

<button onclick="window.print()" class="btn btn-success btn-block">Print</button>

<br>
<br>

<?= view('header', ['content' => ob_get_clean()]) ?>