document.getElementById('range').addEventListener('input', (e) => {
  document.getElementById('showRange').textContent= e.target.value;
});

const ranges = document.querySelectorAll('.range-input');
for (let i = 0; i < ranges.length; i +=1) {
  document.getElementById('range' + i).addEventListener('input', (e) => {
    document.getElementById('showRange' + i).textContent= e.target.value;
  });
}

if(document.getElementById('addError') != null) {
  const addModal = new bootstrap.Modal(document.getElementById('addFitness'));
   addModal.show();
}

if(document.getElementById('updateError') != null) {
  const addModal = new bootstrap.Modal(document.getElementById('updateError').closest('.modal'));
   addModal.show();
}