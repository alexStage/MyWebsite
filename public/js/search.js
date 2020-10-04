const list = document.getElementById('folder-list');

list.addEventListener('click', function(e){
    e.preventDefault();
    const token =document.querySelector('meta[name="csrf-token"]').textContent;
});