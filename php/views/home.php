<?php
namespace view\home;

function index() {
?>
<h1>home</h1>
<form action="/fitness/create" method="post">
  <div class="mb-4 w-75 mx-auto">
     <label for="name" class="form-label">名前</label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="w-75 mx-auto">
    <label for="description" class="form-label">詳細</label>
    <input type="textarea" class="form-control" name="description" id="description">
  </div>
  <div class="mb-4 w-75 mx-auto">
     <label for="level" class="form-label">レベル</label>
    <input type="text" class="form-control" name="level" id="level">
  </div>
  <div class="text-center mt-5">
    <button type="submit" class="btn btn-primary">登録</button>
  </div>
</form>
<?php
}
?>