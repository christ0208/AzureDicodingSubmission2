$('#btn-upload').click(uploadButtonOnClick);

function uploadButtonOnClick(e){
    console.log($('#uploaded-image').prop('files'));

    let formDataObj = new FormData();
    formDataObj.append('image', $('#uploaded-image').prop('files')[0]);

    $.ajax({
        url: '/action/upload-image-to-storage-action.php',
        type: 'POST',
        enctype: 'multipart/form-data',
        data: formDataObj,
        processData: false,
        contentType: false,
        cache: false,
        success: (response) =>
        {
            try {
                respJson = JSON.parse(response);

                if(respJson['message'] === 'Success')
                {
                    getImage(respJson['imageName']);
                }
            } catch (err) {
                console.log(err)
            }
        },
        error: (error) =>
        {
            console.log(error)
        }
    });
}

function getImage(name)
{
    $.ajax({
        url: '/action/download-image-from-storage-action.php?name=' + name,
        type: 'GET',
        success: (response) =>
        {
            respJson = JSON.parse(response);

            if(respJson['image'] !== null)
            {
                $('#uploaded-image-container').attr('src', respJson['image']);
                processImage(name)
            }
        },
        error: (error) =>
        {
            console.log(error)
        }
    })
}