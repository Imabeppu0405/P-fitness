<?php
namespace view\home;

function index($fitnesses, $user) {
?>
<div class="d-flex justify-content-center mt-5">
  <h1>フィットネス一覧</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">フィットネス追加</button>
  <h2>現在の所持金：<?php echo $user->money ?>円</h2>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/fitness/create" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">フィットネス登録</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <div class="mb-4 w-75 mx-auto">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" name="name" id="name">
          </div>
          <div class="mb-4 w-75 mx-auto">
            <label for="description" class="form-label">詳細</label>
            <input type="textarea" class="form-control" name="description" id="description">
          </div>
          <div class="w-75 mx-auto">
            <label for="level" class="form-label">レベル <span id="showLevel">10</span></label>
            <input type="range" class="form-range" min="1" max="100" step="1" name="level" id="level" value="10">
          </div>
          <div class="text-center mt-5">
            
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">キャンセル</button>
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
    </div>
  </div>
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
    <form action="<?php echo CURRENT_URI ?>" method="post">
      <input type="hidden" name="level" value="<?php echo $fitness->level ?>">
      <div class="text-center mb-3">
        <button type="submit" class="btn btn-dark">Complete</button>
      </div>
    </form>
  </div>
<?php endforeach; ?>
</div>
<?php
}
?>