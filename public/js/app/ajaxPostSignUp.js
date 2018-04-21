


function ajaxPost(url, data, callback,isJson) {
    var req = new XMLHttpRequest();
    req.open("POST", url);
    req.addEventListener("load", function () {
        if (req.status >= 200 && req.status < 400) {
            // Appelle la fonction callback en lui passant la réponse de la requête
            callback(req.responseText);
        } else {
            req.addEventListener("error", function () {
                var errors = JSON.parse(req.responseText)
                var errorsKey = Object.keys(errors)
                for (var i = 0; i < errorsKey.length; i++) {
                    var key = errorsKey[i]
                    var error= errors[key]
                    var input = document.querySelector('[name='+ key + ']')
                    var span = document.createElement('span')
                    span.className = 'help-block'
                    span.innerHTML = error
                    input.parentNode.classList.add('invalid-feedback')
                    input.parentNode.appendChild(span)
                }
            });
        }
    });
    req.addEventListener("error", function () {
        console.error("Erreur réseau avec l'URL " + url);
    });
    if (isJson) {

        // Définit le contenu de la requête comme étant du JSON

        req.setRequestHeader("Content-Type", "application/json");

        // Transforme la donnée du format JSON vers le format texte avant l'envoi

        data = JSON.stringify(data);

    }
    req.send(data);
}