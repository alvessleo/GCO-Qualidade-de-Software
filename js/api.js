function chamadaAPI(api, dados)
{
    let cabecalho = new Headers();

    cabecalho.append('Accept', 'application/json');
    cabecalho.append('Content-Type', 'application/json');

    return fetch('/api/'.concat(api), {
        method: 'POST',
        mode: 'same-origin',
        credentials: 'include',
        headers: cabecalho,
        body: JSON.stringify(dados)
        
    })
    
}

export { chamadaAPI };