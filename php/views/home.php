<?php
namespace view\home;

function index($fitnesses, $user) {
  $categories = [
    ['腕', 'arm'], 
    ['腹', 'abdmen'],
    ['脚', 'leg'], 
    ['その他', 'others']
  ];
?>
<div class="d-flex justify-content-center mt-5">
  <h1>フィットネス一覧</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFitness">フィットネス追加</button>
  <h2>現在の所持金：<?php echo $user->money ?>円</h2>
</div>

<!-- Modal -->
<div class="modal fade" id="addFitness" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addFitnessLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/fitness/create" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="addFitnessLabel">フィットネス登録</h5>
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
          <div class="mb-4 w-75 mx-auto">
            <label for="range" class="form-label">レベル <span id="showRange">10</span></label>
            <input type="range" class="form-range" min="1" max="100" step="1" name="level" id="range" value="10">
          </div>
          <div class="w-75 mx-auto">
            <label for="arm" class="form-label">鍛える箇所</label>
            <div>
              <?php foreach($categories as $key => $category) : ?>
              <label for="<?php echo $category[1] ?>">
                <?php echo $category[0] ?>
                <input type="radio" name="category" id="<?php echo $category[1] ?>" value="<?php echo $key ?>">
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
    <form action="<?php echo CURRENT_URI ?>" method="post">
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
            
              <div class="mb-4 w-75 mx-auto">
                <label for="name<?php echo $key ?>" class="form-label">名前</label>
                <input type="text" class="form-control" name="name" id="name<?php echo $key ?>" value="<?php echo $fitness->name ?>">
              </div>
              <div class="mb-4 w-75 mx-auto">
                <label for="description<?php echo $key ?>" class="form-label">詳細</label>
                <input type="textarea" class="form-control" name="description" id="description<?php echo $key ?>" value="<?php echo $fitness->description ?>">
              </div>
              <div class="w-75 mx-auto">
                <label for="range<?php echo $key ?>" class="form-label">レベル <span id="showRange<?php echo $key ?>"><?php echo $fitness->level ?></span></label>
                <input type="range" class="form-range range-input" min="1" max="100" step="1" name="level" id="range<?php echo $key ?>" value="<?php echo $fitness->level ?>">
              </div>
              <div class="w-75 mx-auto">
                <label for="arm" class="form-label">鍛える箇所</label>
                <div>
                  <?php foreach($categories as $categry_key => $category) : ?>
                  <label for="<?php echo $category[1] ?>">
                    <?php echo $category[0] ?>
                    <input type="radio" name="category" id="<?php echo $category[1] . $key ?>" value="<?php echo $categry_key ?>">
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
<?php
}
?>