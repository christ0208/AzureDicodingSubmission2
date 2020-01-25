function processImage(name)
{
    $.ajax({
        url: '/action/analyze-image-action.php?name=' + name,
        type: 'GET',
        success: (response) =>
        {
            respJson = JSON.parse(response)
            $('#responseTextArea').text(respJson['description']['captions'][0]['text'])
        },
        error: (error) =>
        {
            console.log(error);
        }
    });
}