<?php
namespace view\reward\show;

function index($rewards) {
?>
<div class="d-flex justify-content-center mt-5">
  <h1>報酬一覧</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">報酬追加</button>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/reward/create" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">報酬登録</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <div class="mb-4 w-75 mx-auto">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" name="name" id="name">
          </div>
          <div class="w-75 mx-auto">
            <label for="price" class="form-label">値段 <span id="showLevel">1000</span></label>
            <input type="range" class="form-range" min="100" max="10000" step="100" name="price" id="level" value="1000">
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
<?php foreach($rewards as $reward) : ?>
  <div class="card m-2 position-relative" style="width: 18rem;">
    <div class="d-flex justify-content-between m-2">
    </div>
    <div class="card-img mx-auto my-2">
      <img src="img/maccho.png" alt="報酬アイコン">
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