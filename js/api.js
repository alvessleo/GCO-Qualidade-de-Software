function chamadaAPI(api, dados = null)
{
    let cabecalho = new Headers();

    cabecalho.append('Accept', 'application/json');
    cabecalho.append('Content-Type', 'application/json');

    return new Promise((resolve, reject) => { 
        fetch('/api/'.concat(api), {
            method: 'POST',
            mode: 'same-origin',
            credentials: 'include',
            headers: cabecalho,
            body: JSON.stringify(dados)
        
        }).then(resp => { 
            if (resp.headers.get('content-Type') == 'application/json')
            {
                resp.json().then(json => {
                    resolve({'status': resp.status, 'json': json});
                });
            }
            else
            {
                resp.text().then(text => {
                    resolve({'status': resp.status, 'text': text});
                });
            }

        }).catch(rej => {
            resolve({'status': 0});
        });

    });
    
}

function dadosSessao()
{
    return new Promise((resolve, reject) => { 
        chamadaAPI('auth/estado.php').then(res => {
            if (res.status == 200 && 'json' in res)
				resolve(res.json);
            else
                resolve(null);

        });

    });

}

function logout()
{
    chamadaAPI('auth/logout.php');
    setTimeout(() => {
        location.reload();
    }, 250);
}

export { chamadaAPI, dadosSessao, logout };