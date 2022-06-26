<?php
namespace view\reward\show;

use app\core\Message\Msg;

function index($rewards, $user, $reward_errors) {
  // 成功時のMessage表示
  if(is_null($reward_errors)) Msg::flush();
?>
<div class="d-flex justify-content-center mt-5 position-relative w-50 mx-auto">
  <h1 class="mx-3">報酬一覧</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReward">追加</button>
  <div class="position-absolute top-0 end-0">
    <p class="h5">現在の所持金：<?php echo $user->money ?>円</p>
  </div>
</div>

<!-- 新規作成Modal -->
<div class="modal fade" id="createReward" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createRewardLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/reward/create" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="createRewardLabel">報酬登録</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if($reward_errors->is_create) : ?>
            <?php $create_reward = $reward_errors ?>
            <div id="createError">
              <?php Msg::flush(); ?>
            </div>
          <?php endif; ?>
          <div class="mb-4 w-75 mx-auto">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $create_reward->name ?>">
          </div>
          <div class="w-75 mx-auto">
            <label for="range" class="form-label">値段 <span id="showRange"><?php echo $create_reward->price ?? '1000' ?></span></label>
            <input type="range" class="form-range" min="100" max="10000" step="100" name="price" id="range" value="<?php echo $create_reward->price ?? '1000' ?>">
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
<?php foreach($rewards as $key => $reward) : ?>
  <div class="card m-2 position-relative" style="width: 18rem;">
    <div class="d-flex justify-content-end m-2">
      <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#updateReward<?php echo $key ?>">
         <span class="bi bi-pencil-square"></span>
      </button>
      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteReward<?php echo $key ?>">
        <span class="bi bi-trash"></span>
      </button>
    </div>
    <div class="card-body">
      <h5 class="card-title text-center border-bottom"><?php echo $reward->name ?></h5>
    </div>
    <form action="<?php echo CURRENT_URI ?>" method="post">
      <input type="hidden" name="price" value="<?php echo $reward->price ?>">
      <div class="text-center mb-3">
        <button type="submit" class="btn btn-dark"><?php echo $reward->price ?>円</button>
      </div>
    </form>

    <!-- 更新用モーダル -->
    <div class="modal fade" id="updateReward<?php echo $key ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateRewardLabel<?php echo $key ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/reward/update" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="updateRewardLabel<?php echo $key ?>">報酬更新</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php if(!$reward_errors->is_create and $reward_errors->id == $reward->id) : ?>
                <?php $reward = $reward_errors ?>
                <div id="updateError">
                  <?php Msg::flush(); ?>
                </div>
              <?php endif; ?>
              <div class="mb-4 w-75 mx-auto">
                <label for="name<?php echo $key ?>" class="form-label">名前</label>
                <input type="text" class="form-control" name="name" id="name<?php echo $key ?>" value="<?php echo $reward->name ?>">
              </div>
              <div class="w-75 mx-auto">
                <label for="range<?php echo $key ?>" class="form-label">レベル <span id="showRange<?php echo $key ?>"><?php echo $reward->price ?></span></label>
                <input type="range" class="form-range range-input" min="100" max="10000" step="100" name="price" id="range<?php echo $key ?>" value="<?php echo $reward->price ?>">
              </div>
              <input type="hidden" name="id" value="<?php echo $reward->id ?>">
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-primary">更新</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- 削除確認モーダル -->
    <div class="modal fade" id="deleteReward<?php echo $key ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteRewardLabel<?php echo $key ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteRewardLabel<?php echo $key ?>">削除確認</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              削除してもよろしいですか？
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
              <form action="/reward/delete" method="post">
                <input type="hidden" name="id" value="<?php echo $reward->id ?>">
                <button type="submit" class="btn btn-danger">削除</button>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php
}
?>