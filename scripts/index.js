const formUpdate = document.querySelector('.formUpdate');
const btnUpdate = document.querySelector('#btn-update');

btnUpdate.addEventListener('click', (e) => {
  e.preventDefault();
  formUpdate.style.display = 'unset';
});
