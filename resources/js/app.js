import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Upload your image here',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    //it helps the user to remove the image
    addRemoveLinks: true,
    dictRemoveFile: 'Delete your image', 
    maxFiles: 1,
    uploadMultiple: false,

    //Función para agregar la imagen a Dropzone 
    //si la validación falla pero tenemos 1 imagen
    init:function() {

        //alert("Dropzone creado");
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = 
                document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    },

});


dropzone.on("success", function(file, response){
    //Respuesta que obtengamos del servidor cuando subamos la imagen
    //sera igual al uuid para enviarlo a la base de datos
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on("removedfile", function() {
    document.querySelector('[name="imagen"]').value = '';
});