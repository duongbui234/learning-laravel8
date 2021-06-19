const actualBtn = document.getElementById('actual-btn');

const fileChosen = document.getElementById('file-chosen');

actualBtn.addEventListener('change', function(){
    console.log(this.files.length)
    if(this.files.length > 1 ) {
        fileChosen.textContent = `${this.files.length} files`;
        return ;
    }
  fileChosen.textContent = this.files[0].name
})
