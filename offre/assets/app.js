function corresp(id){
    let index = id.slice(-1);
    let ode = document.querySelectorAll('.offre-display-element');
    let map = document.querySelector('#mymap');

    if(map.style.visibility != 'visible'){
        map.style.visibility = 'visible';
    }

    for(i=0;i<ode.length;i++){
        ode[i].style.visibility = 'hidden';
        // maps[i].style.visibility = 'hidden';
    }
    
    mymap.setView(eval('lonlat'+index));
    document.querySelector('#ode'+index).style.visibility = 'visible';
    // document.querySelector('#map'+index).style.visibility = 'visible';

    document.querySelector('.offre-display-container>h1').style.visibility = 'hidden';
}

/* let btn = document.createElement('button')
btn.style = 'position: fixed; left: 0; top: 0; z-index: 9; width: max-content; height: max-content;';
btn.innerHTML = 'Effacer';
btn.onclick = ()=>{
    document.querySelector('#map9').style.display = 'none';
}
document.body.append(btn); */