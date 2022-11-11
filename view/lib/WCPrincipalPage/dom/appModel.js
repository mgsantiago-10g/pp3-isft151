
class AppModel
{
    constructor()
    {

    }

    sendRegisterData( data )
    {
        return fetch('../../../../api/register.php', { method: 'post', body: JSON.stringify( data )}).then(response => response.json());
        console.log(data);
    }

    sendLoginData( data )
    {
        // return fetch('', { method: 'post', body: JSON.stringify( data )}).then(response => response.json());
        // Consultar con backend para ver el path del archivo del backend. 
    }
}

export { AppModel }