
class AppModel
{
    constructor()
    {

    }

    sendRegisterData( data )
    {
        console.log(data);
        return fetch('../../../../api/register.php', { method: 'post', body: JSON.stringify( data )}).then(response => response.json());
    }

    sendLoginData( data )
    {
        // return fetch('', { method: 'post', body: JSON.stringify( data )}).then(response => response.json());
        // Consultar con backend para ver el path del archivo del backend. 
    }
}

export { AppModel }