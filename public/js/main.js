document.getElementById('range').addEventListener('input', (e) => {
  document.getElementById('showRange').textContent= e.target.value;
});

const ranges = document.querySelectorAll('.range-input');
for (let i = 0; i < ranges.length; i +=1) {
  document.getElementById('range' + i).addEventListener('input', (e) => {
    document.getElementById('showRange' + i).textContent= e.target.value;
  });
}