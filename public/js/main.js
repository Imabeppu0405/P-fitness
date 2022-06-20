document.getElementById('level').addEventListener('input', (e) => {
  document.getElementById('showLevel').textContent= e.target.value;
});

const levels = document.querySelectorAll('.update-level');
for (let i = 0; i < levels.length; i +=1) {
  document.getElementById('level' + i).addEventListener('input', (e) => {
    document.getElementById('showLevel' + i).textContent= e.target.value;
  });
}