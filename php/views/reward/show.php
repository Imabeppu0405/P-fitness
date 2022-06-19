<?php
namespace view\reward\show;

function index($rewards) {
?>
<div class="d-flex justify-content-center mt-5">
  <h1>報酬一覧</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">報酬追加</button>
</div>

<div class="d-flex flex-wrap justify-content-center mt-5">
<?php foreach($rewards as $reward) : ?>
  <div class="card m-2 position-relative" style="width: 18rem;">
    <div class="d-flex justify-content-between m-2">
    </div>
    <div class="card-img mx-auto my-2">
      <img src="img/maccho.png" alt="フィットネスアイコン">
    </div>
    <div class="card-body">
      <h5 class="card-title text-center border-bottom"><?php echo $reward->name ?></h5>
    </div>
    <div class="text-center mb-3">
      <button  class="btn btn-dark"><?php echo $reward->price ?></button>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php
}
?>