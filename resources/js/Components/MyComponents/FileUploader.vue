<template>
    <div class="w-full">
        <input type="file" ref="fileInput" style="display: none" @change="handleFileInputChange" multiple />
        <button type="button" @click="openFileBrowser">
            <p class="flex items-center space-x-2 text-sm text-primary cursor-pointer flex-shrink-0 flex-grow-0">
                <i class="fa-solid fa-plus"></i>
                <span>Adjuntar archivos</span>
                <i class="fa-solid fa-paperclip"></i>
            </p>
        </button>

        <div v-if="selectedFiles.length">
            <ul class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 text-sm mt-2">
                <li v-for="(file, index) in selectedFiles" :key="index" class="flex items-center justify-between px-2">
                    <p class="flex items-center">
                        <i :class="getFileTypeIcon(file.name)"></i>
                        <span class="ml-2">{{ file.name }}</span>
                    </p>
                    <button type="button" @click="removeFile(index)"><i class="fa-solid fa-xmark text-xs"></i></button>
                </li>
            </ul>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            selectedFiles: [],
        };
    },
    emits: ['files-selected'],
    methods: {
        openFileBrowser() {
            // Simula el clic en el input file al hacer clic en el botón personalizado
            this.$refs.fileInput.click();
        },
        handleFileInputChange(event) {
            // Agrega los archivos seleccionados a la lista existente
            const newSelectedFiles = Array.from(event.target.files);
            this.selectedFiles = [...this.selectedFiles, ...newSelectedFiles];
            this.$emit('files-selected', this.selectedFiles);
        },
        removeFile(index) {
            this.selectedFiles.splice(index, 1); // Elimina el archivo de la lista por su índice
            this.$emit('files-selected', this.selectedFiles); // Emitir la lista actualizada después de la eliminación
        },
        getFileTypeIcon(fileName) {
            // Asocia extensiones de archivo a iconos
            const fileExtension = fileName.split('.').pop().toLowerCase();
            switch (fileExtension) {
                case 'pdf':
                    return 'fa-regular fa-file-pdf text-red-700';
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    return 'fa-regular fa-image text-blue-300';
                default:
                    return 'fa-regular fa-file-lines';
            }
        },
    },
};
</script>
  