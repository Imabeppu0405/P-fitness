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

const fitnesSortArray = ['fitness_name', 'fitness_level', 'fitness_created', 'fitness_category'];

const sortButtons = document.getElementsByClassName('sort_button');
const selectSortType = document.getElementById('selectSortType');

selectSortType.addEventListener('change', () => {
  const fitnessies = Array.from(document.querySelectorAll('.fitness'));
  const fitnessCont = document.getElementById('fitness-index-cont');

  const [sortType, order] = selectSortType.value.split('-');
  const sortTypeArray = document.getElementsByClassName(sortType);

  const sortTypes = [];
  for(let i = 0; i < fitnessies.length; i++) {
    let type = sortTypeArray[i].value;
    if(sortType != 'fitness_name') {
      type = Number(type)
    }
    sortTypes.push(type);
  }

  quickSort(0, fitnessies.length - 1, fitnessies, sortTypes);

  // 降順の場合は並びを逆にする
  if(Number(order)) {
    fitnessies.reverse();
  }

  for(let i = 0; i < fitnessies.length; i++) {
    fitnessCont.appendChild(fitnessies[i]);
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