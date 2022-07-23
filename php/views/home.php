<?php
  use libs\Msg;
  if(is_null($fitness_errors)) Msg::flush();
  $fitnesses = escape($fitnesses);
  $user = escape($user);
  $fitness_errors = escape($fitness_errors);
?>
<div class="d-flex justify-content-center mt-5 mx-auto w-50">
  <h1 class="mx-3">フィットネス一覧</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFitness">追加</button>
</div>
<p class="h5 text-center m-3">現在の所持金：<?php echo $user->money ?>円</p>

<?php if (empty($fitnesses)) : ?>
  <p class="text-center">現在フィットネスは登録されていません。</p>
<?php endif; ?>

<!-- 新規作成Modal -->
<div class="modal fade" id="createFitness" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createFitnessLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/fitness/create" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="createFitnessLabel">フィットネス登録</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if ($fitness_errors->is_create) : ?>
            <?php $create_fitness = $fitness_errors ?>
            <div id="createError">
              <?php Msg::flush(); ?>
            </div>
          <?php endif; ?>
          <div class="mb-4 w-75 mx-auto">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $create_fitness->name ?>">
            <div class="form-text">10文字以下</div>
          </div>
          <div class="mb-4 w-75 mx-auto">
            <label for="range" class="form-label">レベル <span id="showRange"><?php echo $create_fitness->level ?? '10' ?></span></label>
            <input type="range" class="form-range" min="1" max="100" step="1" name="level" id="range" value="<?php echo $create_fitness->level ?? '10' ?>">
          </div>
          <div class="w-75 mx-auto">
            <label for="arm" class="form-label">鍛える箇所</label>
            <div>
              <?php foreach($categories as $key => $category) : ?>
              <label for="<?php echo $category[1] ?>" class="m-1">
                <input type="radio" name="category" id="<?php echo $category[1] ?>" value="<?php echo $key ?>" <?php if ($key == $create_fitness->category ?? 0) echo 'checked' ?>>
                <?php echo $category[0] ?>
              </label>
              <?php endforeach; ?>
            </div>
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

<div id="fitness-index-cont" class="d-flex flex-wrap justify-content-center mt-5">
<?php foreach($fitnesses as $key => $fitness) : ?>
  <div class="card m-2 position-relative" style="width: 18rem;">
    <div class="d-flex justify-content-between m-2">
      <div class="card-img-cont <?php echo $categories[$fitness->category][1] ?>">
        <div class="card-img my-2 mx-auto">
          <img src="img/<?php echo $categories[$fitness->category][1] ?>.png" alt="フィットネスアイコン">
        </div>
      </div>
      <div>
        <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#updateFitness<?php echo $key ?>">
          <span class="bi bi-pencil-square"></span>
        </button>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteFitness<?php echo $key ?>">
          <span class="bi bi-trash"></span>
        </button>
      </div>
    </div>
    <div class="card-body">
      <h5 class="card-title h2 text-center border-bottom"><?php echo $fitness->name ?></h5>
      <p class="card-text h5 text-center <?php echo $categories[$fitness->category][1] ?>"><?php echo $fitness->level ?>p</p>
    </div>
    <form action="<?php the_url('/money/add') ?>" method="post">
      <input type="hidden" name="level" value="<?php echo $fitness->level ?>">
      <div class="text-center mb-3">
        <button type="submit" class="btn btn-dark">Complete</button>
      </div>
    </form>

    <!-- 更新用モーダル -->
    <div class="modal fade" id="updateFitness<?php echo $key ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateFitnessLabel<?php echo $key ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/fitness/update" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="updateFitnessLabel<?php echo $key ?>">フィットネス更新</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php if (!$fitness_errors->is_create and $fitness_errors->id == $fitness->id) : ?>
                <?php $fitness = $fitness_errors; ?>
                <div id="updateError">
                  <?php Msg::flush(); ?>
                </div>
              <?php endif; ?>
              <div class="mb-4 w-75 mx-auto">
                <label for="name<?php echo $key ?>" class="form-label">名前</label>
                <input type="text" class="form-control" name="name" id="name<?php echo $key ?>" value="<?php echo $fitness->name ?>">
                <div class="form-text">10文字以下</div>
              </div>
              <div class="w-75 mx-auto">
                <label for="range<?php echo $key ?>" class="form-label">レベル <span id="showRange<?php echo $key ?>"><?php echo $fitness->level ?></span></label>
                <input type="range" class="form-range range-input" min="1" max="100" step="1" name="level" id="range<?php echo $key ?>" value="<?php echo  $fitness->level ?>">
              </div>
              <div class="w-75 mx-auto">
                <label for="arm" class="form-label">鍛える箇所</label>
                <div>
                  <?php foreach($categories as $categry_key => $category) : ?>
                  <label for="<?php echo $category[1] ?>" class="m-1">
                    <input type="radio" name="category" id="<?php echo $category[1] . $key ?>" value="<?php echo $categry_key ?>" <?php if ($categry_key ==  $fitness->category) echo 'checked' ?>>
                    <?php echo $category[0] ?>
                  </label>
                  <?php endforeach; ?>
                </div>
              </div>
              <input type="hidden" name="id" value="<?php echo $fitness->id ?>">
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-primary">更新</button>
            </div>
          </form>
        </div>
      </div>
    </div>

     <!-- 更新用モーダル -->
     <div class="modal fade" id="deleteFitness<?php echo $key ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFitnessLabel<?php echo $key ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteFitnessLabel<?php echo $key ?>">削除確認</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            削除してよろしいですか？
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
            <form action="/fitness/delete" method="post">
              <input type="hidden" name="id" value="<?php echo $fitness->id ?>" >
              <button type="submit" class="btn btn-danger">削除</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>