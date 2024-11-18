document.addEventListener('DOMContentLoaded', function () {
    const statElements = document.querySelectorAll('.stat'); // Obtiene todos los .stat
    const statImages = document.querySelectorAll('.statImage'); // Obtiene todas las .statImage

    // Función para calcular el progreso
    function calculateProgress(currentXp, requiredXp) {
        return (currentXp / requiredXp) * 100;
    }

    // Función para actualizar las barras de progreso
    function updateProgressBar() {
        const stats = ['strength', 'intelligence', 'constitution', 'charisma'];
        stats.forEach(stat => {
            const current = parseInt(document.getElementById(`${stat}-current`).innerText);
            const required = parseInt(document.getElementById(`${stat}-required`).innerText);
            const progress = calculateProgress(current, required);

            document.getElementById(`${stat}-progress`).style.width = progress + '%';
        });
    }

    // Función para asignar imágenes según el tipo de estadística
    function setStatImages() {
        statElements.forEach((statElement, index) => {
            const stat = statElement.innerText;
            const imageElement = statImages[index];

            switch (stat) {
                case 'Strength':
                    imageElement.src = '/images/strengthSTAT.png';
                    break;
                case 'Intelligence':
                    imageElement.src = '/images/intelligenceSTAT.png';
                    break;
                case 'Constitution':
                    imageElement.src = '/images/constitutionSTAT.png';
                    break;
                case 'Charisma':
                    imageElement.src = '/images/charismaSTAT.png';
                    break;
            }
        });
    }

    // Llama a las funciones necesarias
    setStatImages();
    updateProgressBar();
});
