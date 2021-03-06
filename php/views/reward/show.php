<?php
  use libs\Msg;
  // 成功時のMessage表示
  if (is_null($reward_errors)) Msg::flush();
  $rewards = escape($rewards);
  $user = escape($user);
  $reward_errors = escape($reward_errors);
?>
<div class="d-flex justify-content-center mt-5 w-50 mx-auto">
  <h1 class="mx-3">報酬一覧</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReward">追加</button>
</div>
<p class="h5 text-center m-3">
<span id="displayMoney">現在の所持金：<?php echo $user->money ?>円　</span>
  <select name="sortType" id="selectSortType">
  <?php foreach($reward_sort_array as $key => $sortType) : ?>
    <option value="<?php echo $sortType ?>">並び順：<?php echo $key ?></option>
  <?php endforeach; ?>
  </select>
</p>

<?php if (empty($rewards)) : ?>
  <p class="text-center">現在報酬は登録されていません。</p>
<?php endif; ?>

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
          <?php if ($reward_errors->is_create) : ?>
            <?php $create_reward = $reward_errors ?>
            <div id="createError">
              <?php Msg::flush(); ?>
            </div>
          <?php endif; ?>
          <div class="mb-4 w-75 mx-auto">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $create_reward->name ?>">
            <div class="form-text">10文字以下</div>
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

<div id="indexCont" class="d-flex flex-wrap justify-content-center mt-5">
<?php foreach($rewards as $key => $reward) : ?>
  <div class="card m-2 position-relative sort-element" style="width: 18rem;">
    <!-- ソート用の値 -->
    <input type="hidden" class="reward_price" value="<?php echo $reward->price ?>">
    <input type="hidden" class="reward_name" value="<?php echo $reward->name ?>">
    <input type="hidden" class="reward_created" value="<?php echo $reward->id ?>">

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
    <div class="text-center mb-3">
      <button type="button" value="<?php echo $reward->price ?>" class="btn btn-dark subtract-button"><?php echo $reward->price ?>円</button>
    </div>

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
              <?php if (!$reward_errors->is_create and $reward_errors->id == $reward->id) : ?>
                <?php $reward = $reward_errors ?>
                <div id="updateError">
                  <?php Msg::flush(); ?>
                </div>
              <?php endif; ?>
              <div class="mb-4 w-75 mx-auto">
                <label for="name<?php echo $key ?>" class="form-label">名前</label>
                <input type="text" class="form-control" name="name" id="name<?php echo $key ?>" value="<?php echo $reward->name ?>">
                <div class="form-text">10文字以下</div>
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