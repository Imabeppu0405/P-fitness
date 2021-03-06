document.getElementById('range').addEventListener('input', (e) => {
  document.getElementById('showRange').textContent= e.target.value;
});

const ranges = document.querySelectorAll('.range-input');
for (let i = 0; i < ranges.length; i +=1) {
  document.getElementById('range' + i).addEventListener('input', (e) => {
    document.getElementById('showRange' + i).textContent= e.target.value;
  });
}

if (document.getElementById('createError') != null) {
  const createModal = new bootstrap.Modal(document.getElementById('createError').closest('.modal'));
   createModal.show();
}

if (document.getElementById('updateError') != null) {
  const updateModal = new bootstrap.Modal(document.getElementById('updateError').closest('.modal'));
   updateModal.show();
}

const selectSortType = document.getElementById('selectSortType');

selectSortType.addEventListener('change', () => {
  const sortElements = Array.from(document.querySelectorAll('.sort-element'));
  const indexCont = document.getElementById('indexCont');

  const [sortType, order] = selectSortType.value.split('-');
  const sortTypeArray = document.getElementsByClassName(sortType);

  const sortTypes = [];
  for(let i = 0; i < sortElements.length; i++) {
    let type = sortTypeArray[i].value;
    if(!(sortType == 'fitness_name' || sortType == 'reward_name')) {
      type = Number(type)
    }
    sortTypes.push(type);
  }

  quickSort(0, sortElements.length - 1, sortElements, sortTypes);

  // 降順の場合は並びを逆にする
  if(Number(order)) {
    sortElements.reverse();
  }

  for(let i = 0; i < sortElements.length; i++) {
    indexCont.appendChild(sortElements[i]);
  }
})

// ソート関数
function quickSort(start, end, sortArray, sortTypes) {
  const pivot = sortTypes[Math.floor((start + end) / 2)];
  let left = start;
  let right = end;

  while(true) {
    while(sortTypes[left] < pivot) {
      left++;
    }
    while(pivot < sortTypes[right]) {
      right--;
    }
    if(right <= left) {
      break;
    }

    if (sortTypes[left] != sortTypes[right]) {
      let tmp = sortTypes[left];
      sortTypes[left] = sortTypes[right];
      sortTypes[right] = tmp;

      tmp = sortArray[left];
      sortArray[left] = sortArray[right];
      sortArray[right] = tmp;
    }

    left++; 
    right--;
  }

  if(start < left - 1) {
    quickSort(start, left - 1, sortArray, sortTypes);
  }

  if(right + 1 < end) {
    quickSort(right + 1, end, sortArray, sortTypes);
  }
}

const addButtons = document.getElementsByClassName('add-button');
const displayMoney = document.getElementById('displayMoney');
for(let i = 0; i < addButtons.length; i++) {
  addButtons[i].addEventListener('click', e => {
    const level = e.target.value;

    updateMoney(level, '/money/add');
  })
};

const subtractButtons = document.getElementsByClassName('subtract-button');
for(let i = 0; i < subtractButtons.length; i++) {
  subtractButtons[i].addEventListener('click', e => {
    const price = e.target.value;

    updateMoney(price, '/money/subtract');
  })
};

const updateMoney = ((money, url) => {
  const formData = new FormData;
  formData.append('money', money);
  fetch(url, {
    method: 'POST',
    body: formData
  }).then(response => response.json()
  ).then(nowMoney => {
    displayMoney.textContent = '現在の所持金：' + nowMoney + '円　';
  })
});