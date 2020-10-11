function IniciarModal(modalID){
    const modal = document.getElementById(modalID);
    if(modal){
        console.log(modal);
        modal.classList.add('mostrar');
        modal.addEventListener('click', function(evento){
            if (evento.target.id == modalID || evento.target.className == 'fechar'){
                modal.classList.remove('mostrar');
            }

        })
    }
}

const adm = document.querySelector('.adm');
adm.addEventListener('click',function(){
    IniciarModal('modal-adm');

})

