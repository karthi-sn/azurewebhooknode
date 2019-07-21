# azurewebhooknode
azure webhook via hangout chat with node

get the hangout chat room webhook url and save it locally

navigate to azurewebhooknode/application/controllers/API.php --> scrool down --> in  function splitexpress_post()

change the values of
- url
- imagelink
- openurl

and publish in a web server

and get the url of it

go to azure devops --> project --> settings --> ervice hooks --> new --> web hook --> in url --> paste the url end with /index.php/API/splitexpress 


