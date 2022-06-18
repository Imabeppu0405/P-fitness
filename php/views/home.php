<?php
namespace view\home;

function index($fitnesses) {
?>
<div class="d-flex justify-content-center mt-5">
  <h1>フィットネス一覧</h1>
  <button type="button" class="btn btn-primary">フィットネス追加</button>
</div>

<div class="d-flex flex-wrap justify-content-center mt-5">
<?php foreach($fitnesses as $fitness) : ?>
  <div class="card m-2 position-relative" style="width: 18rem;">
    <div class="d-flex justify-content-between m-2">
      <div class="text-danger"><?php echo $fitness->level ?>P</div>
      <button type="button" class="btn btn-outline-dark">
        Edit <span class="bi bi-pencil-square"></span>
      </button>
    </div>
    <div class="card-img mx-auto my-2">
      <img src="img/maccho.png" alt="フィットネスアイコン">
    </div>
    <div class="card-body">
      <h5 class="card-title text-center border-bottom"><?php echo $fitness->name ?></h5>
      <p class="card-text"><?php echo $fitness->description ?></p>
    </div>
    <div class="text-center mb-3">
      <button  class="btn btn-dark">Complete</button>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php
}
?>